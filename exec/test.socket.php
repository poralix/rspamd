#!/usr/local/bin/php
<?php
error_reporting(E_ALL);

$in = "GET /img/rspamd_logo_navbar.png HTTP/1.0

";

$result = '';
$SOCK_F="/var/run/rspamd/rspamd_controller.sock";
$socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
socket_connect($socket, $SOCK_F, null);
$ts = microtime(true);
socket_send($socket, $in, strlen($in), 0);
while ($out = socket_read($socket, 2048)) {
        $result .= $out;
}
socket_close($socket);
//var_dump($result);
$headerText = substr($result, 0, strpos($result, "\r\n\r\n"));
var_dump($headerText);
