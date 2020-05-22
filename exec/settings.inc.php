<?php
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.2
#   ==============================================================================
#          Last modified: Thu May 21 20:33:07 +07 2020
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

define('PLUGIN_DIR',       '/usr/local/directadmin/plugins/rspamd');
define('PLUGIN_EXEC_DIR',  '/usr/local/directadmin/plugins/rspamd/exec');
define('PLUGIN_CSS_DIR',   '/usr/local/directadmin/plugins/rspamd/data/css');
define('PLUGIN_JS_DIR',    '/usr/local/directadmin/plugins/rspamd/data/js');
define('PLUGIN_FONT_DIR',  '/usr/local/directadmin/plugins/rspamd/data/fonts');

define('PLUGIN_BASE_URL',  '/CMD_PLUGINS_ADMIN/rspamd/');
define('PLUGIN_HOME_URL',  '/CMD_PLUGINS_ADMIN/rspamd/index.raw');
define('PLUGIN_CSS_URL',   '/CMD_PLUGINS_ADMIN/rspamd/css.raw');
define('PLUGIN_JS_URL',    '/CMD_PLUGINS_ADMIN/rspamd/js.raw');
define('PLUGIN_IMG_URL',   '/CMD_PLUGINS_ADMIN/rspamd/img.raw');
define('PLUGIN_FONT_URL',  '/CMD_PLUGINS_ADMIN/rspamd/fonts.raw');
define('PLUGIN_JSON_URL',  '/CMD_PLUGINS_ADMIN/rspamd/json.raw');

define('RSPAMD_HOME_URL',  'http://127.0.0.1:11334');
if (!defined('RSPAMD_SOCKET')) define('RSPAMD_SOCKET','/var/run/rspamd/rspamd_controller.sock');
