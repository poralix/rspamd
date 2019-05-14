<?php
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.1.1
#   ==============================================================================
#          Last modified: Tue May 14 12:30:43 +07 2019
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

class proxyHTTP
{
    private $Url;
    private $userAgent;
    private $remoteAddr;
    private $requestMethod;
    private $requestHeaders;
    private $requestReferer;
    private $postData;
    private $responseBody;
    private $responseHeaders;
    private $responseInfo;

    public function setUrl($str)
    {
        $this->Url=$str;
    }

    public function setUserAgent($str)
    {
        $this->userAgent=$str;
    }

    public function setRemoteAddr($str)
    {
        $this->remoteAddr=$str;
    }

    public function setRequestMethod($str)
    {
        $this->requestMethod=(strtoupper($str) == "POST") ? "POST" : "GET";
    }

    public function setRequestHeaders($arr)
    {
        $this->requestHeaders=$arr;
    }

    public function setRequestReferer($str)
    {
        $this->requestReferer=$str;
    }

    public function setPostData($arr)
    {
        $this->postData=$arr;
    }

    public function setResponseHeaders($str)
    {
        $this->responseHeaders=$str;
    }

    public function setResponseBody($str)
    {
        $this->responseBody=$str;
    }

    public function setResponseInfo($str)
    {
        $this->responseInfo=$str;
    }


    public function getUrl()
    {
        return $this->Url;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    public function getRequestReferer()
    {
        return $this->requestReferer;
    }

    public function getPostData()
    {
        return $this->postData;
    }

    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

    public function getResponseInfo()
    {
        return $this->responseInfo;
    }

    public function makeRequest()
    {
        $responseInfo='';
        $headerSize='';

        $this->setResponseHeaders(false);
        $this->setResponseBody(false);
        $this->setResponseInfo(false);

        $userAgent = $this->getUserAgent();
        $requestMethod = $this->getRequestMethod();
        $remoteAddr = $this->getRemoteAddr();
        $postData = $this->getPostData();
        $url = $this->getUrl();
        $requestHeaders = $this->getRequestHeaders();
        $requestReferer = $this->getRequestReferer();

        if (($ch=curl_init()) && $url)
        {
            $curlRequestHeaders = array();
            if ($requestHeaders && is_array($requestHeaders))
            {
                foreach ($requestHeaders as $name => $value) {
                    $curlRequestHeaders[] = $name . ': ' . $value;
                }
            }
            if ($remoteAddr) $curlRequestHeaders[] = 'X-Forwarded-For: ' . $remoteAddr;
            if ($requestMethod == 'POST')
            {
                curl_setopt($ch, CURLOPT_POST, true);
                if (defined('SAVE_CONTENT_TYPE') && (SAVE_CONTENT_TYPE == 'JSON' || SAVE_CONTENT_TYPE == 'RAW'))
                {
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($postData))
                        );
                }
                else
                {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
                }
            }
            if ($requestReferer) curl_setopt($ch, CURLOPT_REFERER, $requestReferer);
            if ($curlRequestHeaders) curl_setopt($ch, CURLOPT_HTTPHEADER, $curlRequestHeaders);
            if ($userAgent) curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($response = curl_exec($ch))
            {
                $responseInfo = curl_getinfo($ch);
                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                curl_close($ch);
                $responseHeaders = substr($response, 0, $headerSize);
                $responseBody = substr($response, $headerSize);
                $this->setResponseHeaders($responseHeaders);
                $this->setResponseBody($responseBody);
                $this->setResponseInfo($responseInfo);
                return true;
            }
            curl_close($ch);
        }
        return false;
    }
}
