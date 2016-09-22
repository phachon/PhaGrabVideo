<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-09-22 15:27:25 --- CRITICAL: Exception [ 0 ]: Call to undefined method Business_Account::getAccountByToken() ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-22 15:27:25 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-22 15:31:54 --- CRITICAL: Exception [ 0 ]: Call to undefined method Dao_Account::getAccountByToken() ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-22 15:31:54 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-22 15:41:56 --- CRITICAL: Exception [ 0 ]: syntax error, unexpected 'exit' (T_EXIT) ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-22 15:41:56 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(ParseError))
#1 {main} in file:line
2016-09-22 16:43:21 --- CRITICAL: ErrorException [ 2 ]: Missing argument 2 for Business_Url::getUrlsByAccountIdAndStatus(), called in D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php on line 29 and defined ~ D:\gitHubProjects\PhaGrabVideo\bass\classes\Business\Url.php [ 143 ] in D:\gitHubProjects\PhaGrabVideo\bass\classes\Business\Url.php:143
2016-09-22 16:43:21 --- DEBUG: #0 D:\gitHubProjects\PhaGrabVideo\bass\classes\Business\Url.php(143): Kohana_Core::error_handler(2, 'Missing argumen...', 'D:\\gitHubProjec...', 143, Array)
#1 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(29): Business_Url->getUrlsByAccountIdAndStatus('0')
#2 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(140): Controller_Url->action_getUrls()
#3 [internal function]: Controller_Base->execute()
#4 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#7 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#8 {main} in D:\gitHubProjects\PhaGrabVideo\bass\classes\Business\Url.php:143
2016-09-22 16:55:51 --- CRITICAL: ErrorException [ 8 ]: Undefined property: Model_Url::$getAccountId ~ APPPATH\classes\Controller\Url.php [ 55 ] in D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php:55
2016-09-22 16:55:51 --- DEBUG: #0 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(55): Kohana_Core::error_handler(8, 'Undefined prope...', 'D:\\gitHubProjec...', 55, Array)
#1 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(140): Controller_Url->action_downloadSuccess()
#2 [internal function]: Controller_Base->execute()
#3 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#4 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#6 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#7 {main} in D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php:55