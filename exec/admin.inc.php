<?php
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.2
#   ==============================================================================
#          Last modified: Wed Jan 14 06:38:59 PM +07 2026
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2026 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

ignore_user_abort(true);
set_time_limit(0);
error_reporting(0);

if (!defined('IN_DA_PLUGIN') || (IN_DA_PLUGIN !==true)){die("You're not allowed to view this page!");}

require_once(__DIR__ . '/settings.inc.php');
require_once(PLUGIN_EXEC_DIR . '/class.inc.php');
require_once(PLUGIN_EXEC_DIR . '/functions.inc.php');
if  (is_file(PLUGIN_EXEC_DIR . '/settings.local.inc.php')) require_once(PLUGIN_EXEC_DIR . '/settings.local.inc.php');

parseInput();
if (defined('REQUEST_URL') && REQUEST_URL)
{
    $requestUrl = REQUEST_URL;
}
else
{
    $requestUrl = (isset($_GET['u']) && $_GET['u']) ? urldecode($_GET['u']) : false;
}
$resourceUrl = (isset($_GET['r']) && $_GET['r']) ? urldecode($_GET['r']) : false;
$requestReferer = (isset($_SERVER['SSL']) && $_SERVER['SSL']) ? 'https://' : 'http://';
$requestReferer .= $_SERVER['SERVER_NAME'] . ':' . intval($_SERVER['SERVER_PORT']) . PLUGIN_BASE_URL;

$plugin = new proxyRequest();
$url = prepareRequest($requestUrl, $resourceUrl);
$plugin->setUrl($url);

if (defined('RSPAMD_SOCKET') && RSPAMD_SOCKET)
{
    $plugin->setUseSocket(RSPAMD_SOCKET);
}
else
{
    $plugin->setRemoteAddr('127.0.0.1');
}
$plugin->setRequestMethod($_SERVER['REQUEST_METHOD']);
$plugin->setRequestReferer($requestReferer);
$plugin->setUserAgent($_SERVER['SERVER_SOFTWARE'].' / '. $_SERVER['DA_VERSION']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (defined('SAVE_CONTENT_TYPE') && (SAVE_CONTENT_TYPE == 'JSON'))
    {
        $postData = json_encode(json_decode($_SERVER['POST']));
        $plugin->setPostData($postData);
    }
    elseif (defined('SAVE_CONTENT_TYPE') && (SAVE_CONTENT_TYPE == 'RAW'))
    {
        $plugin->setPostData($_SERVER['POST']);
    }
    else
    {
        $plugin->setPostData($_POST);
    }
}

if ($plugin->makeRequest() && $plugin->getResponseHeaders())
{
    $bodyOutput = filterContent($plugin->getResponseBody());
    //$bodyOutput = json_encode($_SERVER);

    if (defined('ADMIN_RAW_CONTENT') && ADMIN_RAW_CONTENT)
    {
        if ($responseHeaders=parseHeaders($plugin->getResponseHeaders()))
        {
            print(filterHeaders($responseHeaders, strlen($bodyOutput)));
        }
        else
        {
            printHeaders(false, strlen($bodyOutput));
        }
    }
    print($bodyOutput);
}
else
{
    if (defined('ADMIN_RAW_CONTENT') && ADMIN_RAW_CONTENT)
    {
        printHeaders();
        print json_encode(array("error" => "An error occurred!"));
    }
}

