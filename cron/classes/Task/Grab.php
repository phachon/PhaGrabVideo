<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 定时抓取url
 * @author panchao
 */
class Task_Grab extends Minion_Task {

    protected $_options = array(
        'foo' => 'bar',
        'bar' => NULL,
    );

    protected $_youget = '';
 
    /**
     * execute
     * @param array $params
     */
    protected function _execute(array $params) {

        $urls = Business::factory('Url')->getDefaultUrls();

        if(!$urls->count()) {
            return;
        }
        $this->_youget = Kohana::$config->load('cmd.you_get');

        foreach ($urls as $url) {
            self::_analysis($url);
        }
    }

    /**
     * 分析下载视频
     * @param $url
     * @return boolean
     * @throws Exception
     */
    protected function _analysis(Model_Url $url) {

        $cmd = "{$this->_youget} --url --json {$url->getUrl()}";
        Log_Video::info()->urlId($url->getUrlId())
            ->message('抓取URL开始')->extra($cmd)
            ->write();
        try {
            exec($cmd, $return, $status);
        } catch (Exception $e) {
            Log_Video::error()->urlId($url->getUrlId())
                ->message('解析URL失败')->extra($e->getMessage())
                ->write();
            Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_FAILED, $url->getUrlId());
            return FALSE;
        }
        
        //去除空格
        array_walk($return, function (&$value) {
            $value = trim($value);
        });

        $data =  implode('', $return);
        $encode = mb_detect_encoding($data, array('UTF-8', 'GBK', 'CP936'));
        //Todo utf8
        if($encode != 'UTF-8') {
            $data =  Misc::toUTF8($data);
        }
        $videoInfo = json_decode($data, true);

        $fileName = 'video-grab-'.uniqid();
        $fileDir = VIDEODIR;
        if(!is_dir($fileDir)) {
            mkdir($fileDir, 0777, TRUE);
        }
        $downLoadCmd = "{$this->_youget} --output-filename {$fileName}.flv --output-dir {$fileDir} {$url->getUrl()}";

        //开始下载
        try {
            exec($downLoadCmd, $return, $status);
        } catch (Exception $e) {
            Log_Video::error()->urlId($url->getUrlId())
                ->message('抓取URL失败')->extra($e->getMessage())
                ->write();
            Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_FAILED, $url->getUrlId());
            return FALSE;
        }

        $values = [
            'title' => $videoInfo['title'],
            'url' => $videoInfo['url'],
            'url_id' => $url->getUrlId(),
            'file_name' => $fileName,
        ];

        Log_Video::info()->urlId($url->getUrlId())
            ->message('抓取URL成功')->extra(json_encode($values))
            ->write();
        //插入视频表
        try {
            $result = Business::factory('Video')->create($values);
        } catch (Exception $e) {
            Log_Video::error()
                ->urlId($url->getUrlId())
                ->message('抓取成功插入视频表失败')->extra($e->getMessage())
                ->write();
            Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_FAILED, $url->getUrlId());
            return FALSE;
        }

        //修改url表抓取成功
        try {
            Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_SUCCESS, $url->getUrlId());
        } catch (Exception $e) {
            Log_Video::error()
                ->urlId($url->getUrlId())
                ->message('修改url表为抓取成功失败')->extra($e->getMessage())
                ->write();
            Business::factory('Url')->updateStatusByUrlId(Model_Url::STATUS_FAILED, $url->getUrlId());
            return FALSE;
        }

        Log_Video::info()
            ->urlId($url->getUrlId())->grabVideoId($result[0])
            ->message('抓取URL完成')
            ->write();
    }
}