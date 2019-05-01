#!/bin/bash
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.1.0
#   ==============================================================================
#          Last modified: Sat Apr 27 22:28:33 +07 2019
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
