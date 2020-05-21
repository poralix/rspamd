#!/bin/bash

REQUEST_URI="/rspamd/" \
QUERY_STRING="/rspamd/" \
REQUEST_METHOD="GET" \
SERVER_PROTOCOL="HTTP/1.1" \
GATEWAY_INTERFACE="CGI/1.1" \
/usr/bin/cgi-fcgi -bind -connect /var/run/rspamd/rspamd_controller.sock
echo $?
