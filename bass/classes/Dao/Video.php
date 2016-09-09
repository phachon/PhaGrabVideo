<?php
/**
 * 视频 dao
 * @author: phachon@163.com
 * Time: 2016-08-16 16:06
 */
class Dao_Video extends Dao {

	protected $_db = 'grab';

	protected $_tableName = 'video';

	protected $_primaryKey = 'grab_video_id';

	const STATUS_UPLOAD_FAILED = 2;     //上传失败
	const STATUS_UPLOAD_SUCCESS = 1;    //上传成功
	const STATUS_UPLOAD_DEFAULT = 0;    //待上传
	const STATUS_DELETE = -1;           //删除


	/**
	 * insert a video
	 * @param array $values
	 * @return integer
	 * @throws Kohana_Exception
	 */
	public function insert($values) {
		return DB::insert($this->_tableName)
			->columns(array_keys($values))
			->values(array_values($values))
			->execute($this->_db);
	}

	/**
	 * 根据关键字来获取视频总数
	 * @param array $keywords
	 * @return array
	 */
	public function countVideosByKeywords(array $keywords) {
		$select = DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE);
		if(isset($keywords['url']) && $keywords['url'] != '') {
			$select->and_where('url', 'LIKE', '%'.$keywords['url'].'%');
		}
		if(isset($keywords['video_id']) && $keywords['video_id']) {
			$select->and_where('video_id', '=', $keywords['video_id']);
		}
		return $select->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 根据关键字来分页获取视频总数
	 * @param array $keywords
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getVideosByKeywordsAndLimit($keywords, $offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->order_by($this->_primaryKey, 'DESC');
		if(isset($keywords['url']) && $keywords['url'] != '') {
			$select->and_where('url', 'LIKE', '%'.$keywords['url'].'%');
		}
		if(isset($keywords['video_id']) && $keywords['video_id']) {
			$select->and_where('video_id', '=', $keywords['video_id']);
		}
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Video')
			->execute($this->_db);
	}

	/**
	 * 获取视频总数
	 * @return array
	 */
	public function countVideos() {
		return DB::select(DB::expr('count(*) AS recordCount'))
			->from($this->_tableName)
			->execute($this->_db)
			->get('recordCount');
	}

	/**
	 * 分页获取获取视频
	 * @param integer $offset
	 * @param integer $number
	 * @return array
	 */
	public function getVideosByLimit($offset, $number) {

		$select = DB::select('*')
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->order_by($this->_primaryKey, 'DESC');
		if($offset) {
			$select->offset($offset);
		}
		if($number) {
			$select->limit($number);
		}

		return $select->as_object('Model_Video')
			->execute($this->_db);
	}

	/**
	 * 根据 garb_video_id 来查找视频
	 * @param integer $grabVideoId
	 * @return mixed
	 */
	public function getVideoByGrabVideoId($grabVideoId) {
		return DB::select('*')
			->from($this->_tableName)
			->where($this->_primaryKey, '=', $grabVideoId)
			->and_where('status', '!=', self::STATUS_DELETE)
			->as_object('Model_Video')
			->execute($this->_db);
	}

	/**
	 * 获取所有的视频
	 * @return array
	 */
	public function getVideos() {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '!=', self::STATUS_DELETE)
			->as_object('Model_Video')
			->execute();
	}

	/**
	 * 获取待上传的视频
	 * @return array
	 */
	public function getDefaultVideos() {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', self::STATUS_UPLOAD_DEFAULT)
			->as_object('Model_Video')
			->execute();
	}

	/**
	 * 根据状态来查找视频
	 * @param integer $status
	 * @return array
	 */
	public function getVideosByStatus($status) {
		return DB::select('*')
			->from($this->_tableName)
			->where('status', '=', $status)
			->and_where('status', '!=', self::STATUS_DELETE)
			->as_object('Model_Video')
			->execute();
	}

	/**
	 * 根据 grab_video_id 来修改视频状态
	 * @param array $values
	 * @param integer $grabVideoId
	 * @return integer
	 */
	public function updateByGrabVideoId($values, $grabVideoId) {
		return DB::update($this->_tableName)
			->set($values)
			->where($this->_primaryKey, '=', $grabVideoId)
			->execute($this->_db);
	}
}