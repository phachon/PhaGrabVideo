<?php
/**
 * GVS 视频上传类
 * @author: phachon@163.com
 * Time: 10:31
 * Video::instance()
 *      ->title($title)
 *      ->fileName($fileName)
 *		->tags($tags)
 *		->description($description)
 *		->accountId($accountId)
 *		->videoFile($videoFile)
 *		->createVideo()
 *		->upload();
 */
class Video {

	/**
	 * appname 标示视频来源
	 */
	const APPNAME = 'grab';

	/**
	 * 包字节
	 */
	const PACKET = 20971520;

	/**
	 * video file
	 * @var string
	 */
	protected $_videoFile = '';

	/**
	 * 抓站系统 grab video id
	 * @var int
	 */
	protected $_grabVideoId = 0;

	/**
	 * 抓站系统 url_id
	 * @var int
	 */
	protected $_urlId = 0;

	/**
	 * 标题
	 * @var string
	 */
	protected $_title = '';

	/**
	 * 文件名
	 * @var string
	 */
	protected $_fileName = '';

	/**
	 * 标签
	 * @var string
	 */
	protected $_tags = '';

	/**
	 * 描述
	 * @var string
	 */
	protected $_description = '';

	/**
	 * 文件大小
	 * @var int
	 */
	protected $_fileSize = 0;

	/**
	 * video_id
	 * @var int
	 */
	protected $_videoId = 0;

	/**
	 * token
	 * @var string
	 */
	protected $_token = '';

	/**
	 * gvs 系统账号
	 * @var int
	 */
	protected $_accountId = 454;

	/**
	 * 遮标位置
	 * 1-左上
	 * 2-右上
	 * 3-左下
	 * 4-右下
	 * 多个位置用','隔开
	 * @var int
	 */
	protected $_position = '1';

	/**
	 * 是否发布 0未发布 1发布
	 * @var int
	 */
	protected $_isPublished = 1;

	/**
	 * 审核状态 -1不通过 0待审核 1通过
	 * @var int
	 */
	protected $_approveStatus = 1;

	/**
	 * 上传机地址
	 * @var string
	 */
	protected $_uploadUrl = '';

	/**
	 * 上传机地址
	 * @var string
	 */
	protected $_stateUrl = '';

	protected static $_instance = null;

	public static function instance() {
		if(self::$_instance === null) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function grabVideoId($grabVideoId) {
		$this->_grabVideoId = $grabVideoId;
		return $this;
	}

	public function urlId($urlId) {
		$this->_urlId = $urlId;
		return $this;
	}

	public function title($title) {
		$this->_title = $title;
		return $this;
	}

	public function fileName($fileName) {
		$this->_fileName = $fileName;
		return $this;
	}

	public function position($position) {
		$this->_position = $position;
		return $this;
	}

	public function tags($tags) {
		$this->_tags = $tags;
		return $this;
	}

	public function description($description) {
		$this->_description = $description;
		return $this;
	}

	public function accountId($accountId) {
		$this->_accountId = $accountId;
		return $this;
	}

	public function videoFile($videoFile) {
		$this->_videoFile = $videoFile;
		$this->_fileSize = filesize($this->_videoFile);
		return $this;
	}

	/**
	 * 创建视频
	 * @return $this
	 * @throws Kohana_Exception
	 * @throws Video_Exception
	 */
	public function createVideo() {
		$data = array('appname' => self::APPNAME);
		$getVideoIdUrl = Kohana::$config->load('uri.video.getVideoId');

		$handler = curl_init();
		curl_setopt($handler, CURLOPT_URL, $getVideoIdUrl);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handler, CURLOPT_POST, TRUE);
		curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = curl_exec($handler);
		curl_close($handler);

		$response = json_decode($response, TRUE);
		if($response['message'] != '') {
			throw new Video_Exception($response['message']);
		}
		if(!isset($response['data']['video_id']) || !isset($response['data']['token'])) {
			throw new Video_Exception('获取 video_id 失败: '.$response);
		}

		$this->_videoId = $response['data']['video_id'];
		$this->_token = $response['data']['token'];

		$data = array (
			'appname' => self::APPNAME,
			'video_id' => $this->_videoId,
			'token' => $this->_token,
			'title' => $this->_title,
			'file_name' => $this->_fileName,
			'tags' => $this->_tags,
			'description' => $this->_description,
			'account_id' => $this->_accountId,
			'file_size' => $this->_fileSize,
			'position' => $this->_position,
			'is_published' => $this->_isPublished,
		);

		$createVideoUrl = Kohana::$config->load('uri.video.createVideo');

		$handler = curl_init();
		curl_setopt($handler, CURLOPT_URL, $createVideoUrl);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handler, CURLOPT_POST, TRUE);
		curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($data));
		$response = curl_exec($handler);
		curl_close($handler);

		$response = json_decode($response, TRUE);
		if($response['message'] != '') {
			throw new Video_Exception($response['message']);
		}
		if(!isset($response['data']['upload_url']) || !isset($response['data']['state_url'])) {
			throw new Video_Exception('创建视频失败:'.json_encode($response['data']));
		}

		$this->_uploadUrl = $response['data']['upload_url'];
		$this->_stateUrl = $response['data']['state_url'];

		return $this;
	}

	public function upload() {

		$byteTotal = $this->_fileSize;
		$packetTotal = ceil($byteTotal / self::PACKET);
		$fileContent = fopen($this->_videoFile, 'r');

		for($i = 0; $i < $packetTotal; $i++) {
			$startByte = $i * self::PACKET;
			$endByte = ($i + 1) * self::PACKET > $byteTotal ? $byteTotal : ($i + 1) * self::PACKET;

			$headers = [
				"X-Session-ID: ".$this->_videoId,
				"X-Position: ".$this->_position,
				"Content-Type: application/octet-stream",
				"Content-Disposition: attachment; name=\"video\"; filename=\"". rawurlencode($this->_title) ."\"",
				"X-Content-Range: bytes ". $startByte ."-". ($endByte - 1) ."/". $this->_fileSize,
			];

			$url = $this->_uploadUrl;

			//分段读取
			$packetFileContent = fread($fileContent, self::PACKET);

			$handler = curl_init();
			curl_setopt($handler, CURLOPT_URL, $url);
			curl_setopt($handler, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($handler, CURLOPT_POST, TRUE);
			curl_setopt($handler, CURLOPT_POSTFIELDS, $packetFileContent);

			$response = curl_exec($handler);
			curl_close($handler);
		}

		fclose($fileContent);

		return $this;
	}

	public function getUploadUrl() {
		return $this->_uploadUrl;
	}

	public function getVideoFile() {
		return $this->_videoFile;
	}

	public function getTitle() {
		return $this->_title;
	}

	public function getFileSize() {
		return $this->_fileSize;
	}

	public function getVideoId() {
		return $this->_videoId;
	}

	public function getVideoInfo() {
		return [
			'title' => $this->_title,
			'url_id' => $this->_urlId,
			'video_id' => $this->_videoId,
			'file_name' => $this->_fileName,
			'video_file' => $this->_videoFile,
			'file_size' => $this->_fileSize,
			'upload_url' => $this->_uploadUrl,
			'position' => $this->_position,
		];
	}
}
