#!/bin/bash
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

DIR="/usr/local/directadmin/plugins/rspamd";

perl -pi -e "s/^active=yes/active=no/" "${DIR}/plugin.conf";
perl -pi -e "s/^installed=yes/installed=no/" "${DIR}/plugin.conf";

echo "Plugin uninstalled";

exit 0;
