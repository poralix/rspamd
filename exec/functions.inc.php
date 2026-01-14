<?php
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.2
#   ==============================================================================
#          Last modified: Wed Jan 14 05:51:36 PM +07 2026
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019-2026 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

$_POST = array();
$_GET = array();

# Parse input data
function parseInput()
{
    global $_POST, $_GET;
    if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')
                && isset($_SERVER['POST']) && $_SERVER['REQUEST_METHOD'])
    {
        parse_str($_SERVER['POST'], $_POST);
    }
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'])
    {
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }
    if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
    {
        $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
        while (list($key, $val) = each($process))
        {
            foreach ($val as $k => $v)
            {
                unset($process[$key][$k]);
                if (is_array($v))
                {
                    $process[$key][stripslashes($k)] = $v;
                    $process[] = &$process[$key][stripslashes($k)];
                }
                else
                {
                    $process[$key][stripslashes($k)] = stripslashes($v);
                }
            }
        }
        unset($process);
    }
    return true;
}

function filterContent($str)
{
    $preBody = '<script src="'.PLUGIN_BASE_URL .'images/js/plugin.js"></script><br><center>Rspamd and web interface is writen by Vsevolod Stakhov.<br>DirectAdmin plugin is written by Alex Grebenschikov.<br>Outsourced Linux Support: <a href="https://www.poralix.com/?" target="_blank">www.poralix.com</a>.</center><br>';
    $rspamdQuery = array(
        'rspamd.query("actions",'       => 'rspamd.query("'.PLUGIN_BASE_URL .'actions.raw",',
        'rspamd.query("auth",'          => 'rspamd.query("auth.raw",',
        'rspamd.query("checkv2",'       => 'rspamd.query("checkv2.raw",',
        'rspamd.query("errors",'        => 'rspamd.query("errors.raw",',
        'rspamd.query("getmap",'        => 'rspamd.query("'.PLUGIN_BASE_URL .'getmap.raw?map="+item.map,',
        'rspamd.query("graph",'         => 'rspamd.query("graph.raw",',
        'rspamd.query("history",'       => 'rspamd.query("history.raw",',
        'rspamd.query("historyreset",'  => 'rspamd.query("historyreset.raw",',
        'rspamd.query("maps",'          => 'rspamd.query("'.PLUGIN_BASE_URL .'maps.raw",',
        'rspamd.query("saveactions",'   => 'rspamd.query("saveactions.raw",',
        'rspamd.query("scan",'          => 'rspamd.query("'.PLUGIN_BASE_URL .'scan.raw",',
        'rspamd.query("symbols",'       => 'rspamd.query("'.PLUGIN_BASE_URL .'symbols.raw",',

        'common.query("actions",'            => 'common.query("'.PLUGIN_BASE_URL .'actions.raw",',
        'common.query("auth",'               => 'common.query("auth.raw",',
        'common.query("bayes/classifiers",'  => 'common.query("classifiers.raw",',
        'common.query("checkv2",'            => 'common.query("checkv2.raw",',
        'common.query("errors",'             => 'common.query("errors.raw",',
        'common.query("getmap",'             => 'common.query("'.PLUGIN_BASE_URL .'getmap.raw?map="+item.map,',
        'common.query("graph",'              => 'common.query("graph.raw",',
        'common.query(`history?'             => 'common.query(`history.raw?',
        'common.query("history",'            => 'common.query("history.raw",',
        'common.query("historyreset",'       => 'common.query("historyreset.raw",',
        'common.query("maps",'               => 'common.query("'.PLUGIN_BASE_URL .'maps.raw",',
        'common.query("saveactions",'        => 'common.query("saveactions.raw",',
        'common.query("scan",'               => 'common.query("'.PLUGIN_BASE_URL .'scan.raw",',
        'common.query("symbols",'            => 'common.query("'.PLUGIN_BASE_URL .'symbols.raw",',

        'common.query("plugins/selectors/check_selector?selector="' => 'common.query("check_selector.raw?selector="',
        'common.query("plugins/selectors/check_message?selector="' => 'common.query("check_message.raw?selector="',
        'common.query("plugins/fuzzy/hashes?flag="' => 'common.query("fuzzy_hashes.raw?flag="',

    );

    foreach ($rspamdQuery as $replace => $to)
    {
        $str = str_replace($replace, $to, $str);
    }

    $search = array(
        'url: window.location.href',
        'url: window.location.origin + window.location.pathname',
        'ui.query("auth",',
        'sourceMappingURL=bootstrap.min.css.map',
        'ui.connect();',
        '</body>',
        '"./css/',
        '"../img/',
        '"./img/',
        '"./js/',
        'url(../fonts/',
        'url("../fonts/',
        'baseUrl: "js/lib"',
        'app: "../app"',
        '"favicon-32x32.png?',
        '"favicon-16x16.png?',
        '"apple-touch-icon.png?',
        '"safari-pinned-tab.svg?',
        '"favicon.ico?',
        '"stat"',
        '"neighbours"',
        '\"savemap\"',
        '$("#modalDialog").modal("hide");',
        '"./savesymbols"',
        'url = "learnham";',
        'url = "learnspam";',
        'url = "fuzzyadd";',
        'url = "checkv2";',
        'uploadText(data, source, headers);',
        'data-upload="learnham"',
        'data-upload="learnspam"',
        'data-upload="fuzzyadd"',
        '"checkv2"',
        'rspamd.query("plugins/',
        'common.query("plugins/',
    );
    $replace = array(
        'url: "'.PLUGIN_BASE_URL .'"',
        'url: "'.PLUGIN_BASE_URL .'"',
        'ui.query("auth.raw",',
        'sourceMappingURL=bootstrap.min.css.map.raw',
        'top.location.href="/";',
        "$preBody\n</body>",
        '"' .    PLUGIN_CSS_URL  . '?r=',
        '"' .    PLUGIN_IMG_URL  . '?r=',
        '"' .    PLUGIN_IMG_URL  . '?r=',
        '"' .    PLUGIN_JS_URL   . '?r=',
        'url(' . PLUGIN_FONT_URL . '?r=',
        'url("' . PLUGIN_FONT_URL . '?r=',
        'baseUrl:  "' . PLUGIN_JS_URL . '?r=lib"',
        'app: "../app"',
        '"'. PLUGIN_HOME_URL . '?r=favicon-32x32.png&',
        '"'. PLUGIN_HOME_URL . '?r=favicon-16x16.png&',
        '"'. PLUGIN_HOME_URL . '?r=apple-touch-icon.png&',
        '"'. PLUGIN_HOME_URL . '?r=safari-pinned-tab.svg&',
        '"'. PLUGIN_HOME_URL . '?r=favicon.ico&',
        '"stat.raw"',
        '"'. PLUGIN_BASE_URL .'neighbours.raw"',
        '\"savemap.raw?map="+item.map+"\"',
        '$("#modalBody form").html("");$("#modalDialog").modal("hide");',
        '"savesymbols.raw"',
        'url = "learnham.raw";',
        'url = "learnspam.raw";',
        'url = "fuzzyadd.raw?flag="+$("#fuzzyFlagText").val()+"&weight="+$("#fuzzyWeightText").val();',
        'url = "checkv2.raw";',
        'uploadText(data, source+"?flag="+$("#fuzzyFlagText").val()+"&weight="+$("#fuzzyWeightText").val(), headers);',
        'data-upload="learnham.raw"',
        'data-upload="learnspam.raw"',
        'data-upload="fuzzyadd.raw"',
        '"checkv2.raw"',
        'rspamd.query("plugins.raw?r=',
        'common.query("plugins.raw?r=',
    );
    $str=str_replace($search, $replace, $str);
    return $str;
}

function prepareRequest($requestUrl, $resourceUrl=false)
{
    global $plugin;
    $PRE_URL = (defined('RSPAMD_SOCKET') && RSPAMD_SOCKET) ? '' : RSPAMD_HOME_URL;

    $faviconQuery = array(
        'favicon-32x32.png',
        'favicon-16x16.png',
        'apple-touch-icon.png',
        'safari-pinned-tab.svg',
        'favicon.ico',
        'drop-area.svg',
    );

    $rspamdQuery = array(
        'actions',
        'auth',
        'checkv2',
        'errors',
        'getmap',
        'graph',
        'history',
        'historyreset',
        'maps',
        'saveactions',
        'scan',
        'symbols',
    );

    $jsonRequests = array(
        'fuzzyadd',
        'learnham',
        'learnspam',
        'neighbours',
        'stat',
        'savemap',
        'savesymbols',
    );

    $url = sprintf('%s/%s',$PRE_URL,'');
    $contentType = 'HTML';

    if (defined('ADMIN_RAW_CONTENT') && ADMIN_RAW_CONTENT)
    {
        if (($requestUrl == 'css') && $resourceUrl)
        {
            $contentType = 'CSS';
            $url = sprintf('%s/css/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'js') && $resourceUrl)
        {
            $contentType = 'JS';
            $url = sprintf('%s/js/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'img') && (strpos($resourceUrl, '.png') !== false))
        {
            $contentType = 'PNG';
            $url = sprintf('%s/img/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'img') && (strpos($resourceUrl, '.svg') !== false))
        {
            $contentType = 'SVG';
            $url = sprintf('%s/img/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'fonts') && (strpos($resourceUrl, '.woff') !== false))
        {
            $contentType = 'WOFF';
            $url = sprintf('%s/fonts/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'fonts') && (strpos($resourceUrl, '.woff2') !== false))
        {
            $contentType = 'WOFF2';
            $url = sprintf('%s/fonts/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'fonts') && (strpos($resourceUrl, '.ttf') !== false))
        {
            $contentType = 'TFF';
            $url = sprintf('%s/fonts/%s',$PRE_URL,$resourceUrl);
        }
        elseif (($requestUrl == 'plugins') && $resourceUrl)
        {
            $contentType = 'JS';
            $url = sprintf('%s/plugins/%s',$PRE_URL,$resourceUrl);
        }
        elseif (in_array($resourceUrl, $faviconQuery))
        {
            $contentType = strtoupper(substr($requestUrl,-3));
            $url = sprintf('%s/%s',$PRE_URL,$resourceUrl);
        }
        elseif ($requestUrl == 'graph')
        {
            $contentType = 'JSON';
            $type = (isset($_GET['type']) && $_GET['type']) ? $_GET['type'] : '';
            $url = sprintf('%s/%s',$PRE_URL,$requestUrl.'?type='. $type);
        }
        elseif ($requestUrl == 'history')
        {
            $contentType = 'JSON';
            $from = isset($_GET['from']) ? intval($_GET['from']) : 0;
            $to = isset($_GET['to']) ? intval($_GET['to']) : 999;
            $url = sprintf('%s/%s?from=%d&to=%d',$PRE_URL,$requestUrl,$from,$to);
        }
        elseif ($requestUrl == 'getmap')
        {
            $contentType = 'TEXT';
            $map = (isset($_GET['map']) && intval($_GET['map'])) ? intval($_GET['map']) : false;
            if ($map) $plugin->setRequestHeaders(array('map'=>$map));
            $url = sprintf('%s/%s',$PRE_URL,$requestUrl);
        }
        elseif ($requestUrl == 'savemap')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $map = (isset($_GET['map']) && intval($_GET['map'])) ? intval($_GET['map']) : false;
            if ($map) $plugin->setRequestHeaders(array('map'=>$map));
            $url = sprintf('%s/%s',$PRE_URL,$requestUrl);
        }
        elseif ($requestUrl == 'fuzzyadd')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $flag = (isset($_GET['flag']) && intval($_GET['flag'])) ? intval($_GET['flag']) : false;
            $weight = (isset($_GET['weight']) && intval($_GET['weight'])) ? intval($_GET['weight']) : false;
            if ($flag && $weight) $plugin->setRequestHeaders(array('flag'=>$flag,'weight'=>$weight));
            $url = sprintf('%s/%s',$PRE_URL,$requestUrl);
        }
        elseif (in_array($requestUrl, $jsonRequests) || in_array($requestUrl, $rspamdQuery))
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $url = sprintf('%s/%s',$PRE_URL,$requestUrl);
        }
        elseif ($requestUrl == 'bootstrap.min.css.map')
        {
            $contentType = 'JSON';
            if (is_file(PLUGIN_CSS_DIR .'/bootstrap.min.css.map'))
            {
                printHeaders($contentType);
                readfile(PLUGIN_CSS_DIR .'/bootstrap.min.css.map');
                exit;
            }
        }
        elseif ($requestUrl == 'plugins/selectors/check_selector')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $selector = (isset($_GET['selector']) && $_GET['selector']) ? $_GET['selector'] : '';
            $url = sprintf('%s/plugins/selectors/check_selector?selector=%s',$PRE_URL,$selector);
        }
        elseif ($requestUrl == 'plugins/selectors/check_message')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $selector = (isset($_GET['selector']) && $_GET['selector']) ? $_GET['selector'] : '';
            $url = sprintf('%s/plugins/selectors/check_message?selector=%s',$PRE_URL,$selector);
        }
        elseif ($requestUrl == 'plugins/fuzzy/hashes')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $flag = (isset($_GET['flag']) && $_GET['flag']) ? $_GET['flag'] : '';
            $url = sprintf('%s/plugins/fuzzy/hashes?flag=%d',$PRE_URL,$flag);
        }
        elseif ($requestUrl == 'bayes/classifiers')
        {
            $contentType = 'JSON';
            define('SAVE_CONTENT_TYPE', 'RAW');
            $url = sprintf('%s/%s',$PRE_URL,'bayes/classifiers');
        }
        else
        {
            $url = sprintf('%s/%s',$PRE_URL,'');
        }
    }
    define('CONTENT_TYPE', $contentType."");
    return $url;
}

function filterHeaders($headers, $contentLength=false)
{
    $output = sprintf("HTTP/1.1 %s %s", $headers["status"], $headers["status_text"])."\n";
    $output .= "Cache-Control: no-cache, must-revalidate\n";
    unset($headers["status"]);
    unset($headers["status_text"]);
    foreach ($headers as $key => $val)
    {
        if (in_array($key, array('user-agent','content-length','cache-control','content-encoding'))) continue;
        $output .= sprintf("%s: %s", ucfirst($key), $val)."\n";
    }
    if ($contentLength) $output .= "Content-Length: ". $contentLength ."\n";
    return $output."\n";
}

function printHeaders($headers=false, $contentLength=false)
{
    print("HTTP/1.1 200 OK\n");
    print("Cache-Control: no-cache, must-revalidate\n");
    if ($contentLength) print("Content-Length: ". $contentLength ."\n");
    $contentType = (defined('CONTENT_TYPE') && CONTENT_TYPE) ? CONTENT_TYPE : false;
    switch($contentType)
    {
        case "CSS":
            print("Content-Type: text/css\n\n");
            break;
        case "JS":
            print("Content-Type: application/javascript\n\n");
            break;
        case "PNG":
            print("Content-Type: image/png\n\n");
            break;
        case "ICO":
            print("Content-Type: image/x-icon\n\n");
            break;
        case "WOFF":
            print("Content-Type: application/x-font-woff\n\n");
            break;
        case "WOFF2":
            print("Content-Type: font/woff2\n\n");
            break;
        case "TTF":
            print("Content-Type: application/x-font-ttf\n\n");
            break;
        case "JSON":
            print("Content-Type: application/json\n\n");
            break;
        case "TEXT":
            print("Content-Type: text/plain\n\n");
            break;
        default:
            print("Content-Type: text/html\n\n");
            break;
    }
}

function parseHeaders($headers, $header = null)
{
    $output = array();

    if (!is_array($headers)) $headers=explode("\n", $headers);

    if ('HTTP' === substr($headers[0], 0, 4))
    {
        $output['protocol'] = trim(substr($headers[0], 0, 8));
        $output['status'] = intval(substr($headers[0], 9, 3));
        $output['status_text'] = trim(substr($headers[0],13));
        unset($headers[0]);
    }

    foreach ($headers as $v)
    {
        if (!$v || strlen($v)<3) continue;
        if ($h = preg_split('/:\s*/', $v)) $output[strtolower($h[0])] = (isset($h[1]) && $h[1]) ? trim($h[1]) : '';
    }

    if (null !== $header)
    {
        if (isset($output[strtolower($header)]))
        {
            return $output[strtolower($header)];
        }
        return;
    }

    return $output;
}
