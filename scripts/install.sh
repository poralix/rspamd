#!/bin/bash
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.2
#   ==============================================================================
#          Last modified: Fri May 22 13:02:38 +07 2020
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

DIR="/usr/local/directadmin/plugins/rspamd";

chown -R diradmin:diradmin "${DIR}";
id _rspamd >/dev/null 2>&1; RVAL=$?;

if [ "${RVAL}" == "0" ]; then
{
    chown -R diradmin:_rspamd "${DIR}";
    chmod 750 "${DIR}/admin/"*.raw;
    chmod 750 "${DIR}/admin/"*.html;
    chmod 644 "${DIR}/exec/"*.php;
    chmod 750 "${DIR}/data/";
    chmod 750 "${DIR}/exec/";
    chmod 750 "${DIR}/";

    perl -pi -e "s/^active=no/active=yes/" "${DIR}/plugin.conf";
    perl -pi -e "s/^installed=no/installed=yes/" "${DIR}/plugin.conf";
    perl -pi -e "s/.*'RSPAMD_SOCKET'.*//" "${DIR}/exec/settings.inc.php";

    if [ -S "/var/run/rspamd/rspamd_controller.sock" ]; then
        echo "if (!defined('RSPAMD_SOCKET')) define('RSPAMD_SOCKET','/var/run/rspamd/rspamd_controller.sock');" >> "${DIR}/exec/settings.inc.php";
    fi;

    echo "Plugin installed";
}
else
{
    perl -pi -e "s/^active=.*/active=no/" "${DIR}/plugin.conf";
    perl -pi -e "s/^installed=.*/installed=no/" "${DIR}/plugin.conf";
    echo "No Rspamd is found to be installed!<br>First install Rspamd and then re-install the plugin!<br>";
}
fi;

exit 0;
