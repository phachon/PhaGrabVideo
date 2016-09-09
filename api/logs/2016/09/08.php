<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2016-09-08 14:34:35 --- CRITICAL: Exception [ 0 ]: Cannot use object of type Model_Url as array ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 14:34:35 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 14:36:39 --- CRITICAL: Exception [ 0 ]: Call to undefined method Database_Result_Cached::asArray() ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 14:36:39 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 14:41:07 --- CRITICAL: Exception [ 0 ]: Cannot use object of type Model_Url as array ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 14:41:07 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 15:25:26 --- CRITICAL: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'misc' at 'MODPATH\misc' ~ SYSPATH\classes\Kohana\Core.php [ 578 ] in D:\gitHubProjects\PhaGrabVideo\api\bootstrap.php:142
2016-09-08 15:25:26 --- DEBUG: #0 D:\gitHubProjects\PhaGrabVideo\api\bootstrap.php(142): Kohana_Core::modules(Array)
#1 D:\gitHubProjects\PhaGrabVideo\public\api.php(105): require('D:\\gitHubProjec...')
#2 {main} in D:\gitHubProjects\PhaGrabVideo\api\bootstrap.php:142
2016-09-08 15:38:32 --- CRITICAL: Exception [ 0 ]: Call to a member function as_array() on array ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 15:38:32 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 15:39:38 --- CRITICAL: Exception [ 0 ]: Cannot use object of type Model_Url as array ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 15:39:38 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 15:54:21 --- CRITICAL: ErrorException [ 2 ]: array_map() expects parameter 1 to be a valid callback, function 'toArray' not found or invalid function name ~ D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php [ 22 ] in file:line
2016-09-08 15:54:21 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'array_map() exp...', 'D:\\gitHubProjec...', 22, Array)
#1 D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php(22): array_map('toArray', Array)
#2 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(34): Model_Base->toArray(Object(Model_Url))
#3 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(91): Controller_Url->action_getUrls()
#4 [internal function]: Controller_Base->execute()
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#6 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#8 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#9 {main} in file:line
2016-09-08 15:56:16 --- CRITICAL: ErrorException [ 2 ]: array_map() expects parameter 1 to be a valid callback, function 'toArray' not found or invalid function name ~ D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php [ 22 ] in file:line
2016-09-08 15:56:16 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'array_map() exp...', 'D:\\gitHubProjec...', 22, Array)
#1 D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php(22): array_map('toArray', Array)
#2 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(35): Model_Base->toArray(Object(Model_Url))
#3 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(91): Controller_Url->action_getUrls()
#4 [internal function]: Controller_Base->execute()
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#6 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#8 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#9 {main} in file:line
2016-09-08 15:56:50 --- CRITICAL: Exception [ 0 ]: Cannot access protected property Database_Result_Cached::$_result ~ SYSPATH\classes\Kohana\Kohana\Exception.php [ 87 ] in file:line
2016-09-08 15:56:50 --- DEBUG: #0 [internal function]: Kohana_Kohana_Exception::handler(Object(Error))
#1 {main} in file:line
2016-09-08 16:03:56 --- CRITICAL: ErrorException [ 2 ]: array_map() expects parameter 1 to be a valid callback, function 'toArray' not found or invalid function name ~ D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php [ 22 ] in file:line
2016-09-08 16:03:56 --- DEBUG: #0 [internal function]: Kohana_Core::error_handler(2, 'array_map() exp...', 'D:\\gitHubProjec...', 22, Array)
#1 D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php(22): array_map('toArray', Array)
#2 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(35): Model_Base->toArray(Object(Model_Url))
#3 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(91): Controller_Url->action_getUrls()
#4 [internal function]: Controller_Base->execute()
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#6 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#8 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#9 {main} in file:line
2016-09-08 16:05:19 --- CRITICAL: ErrorException [ 2 ]: Missing argument 1 for Model_Base::toArray(), called in D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php on line 22 and defined ~ D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php [ 19 ] in D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php:19
2016-09-08 16:05:19 --- DEBUG: #0 D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php(19): Kohana_Core::error_handler(2, 'Missing argumen...', 'D:\\gitHubProjec...', 19, Array)
#1 D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php(22): Model_Base->toArray()
#2 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Url.php(35): Model_Base->toArray(Object(Model_Url))
#3 D:\gitHubProjects\PhaGrabVideo\api\classes\Controller\Base.php(91): Controller_Url->action_getUrls()
#4 [internal function]: Controller_Base->execute()
#5 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client\Internal.php(97): ReflectionMethod->invoke(Object(Controller_Url))
#6 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request\Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 D:\gitHubProjects\PhaGrabVideo\kohana\system\classes\Kohana\Request.php(985): Kohana_Request_Client->execute(Object(Request))
#8 D:\gitHubProjects\PhaGrabVideo\public\api.php(121): Kohana_Request->execute()
#9 {main} in D:\gitHubProjects\PhaGrabVideo\kohana\extends\common\classes\Model\Base.php:19