#!/bin/bash
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.1.2
#   ==============================================================================
#          Last modified: Tue May 14 12:30:43 +07 2019
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

DIR="/usr/local/directadmin/plugins/rspamd";

"${DIR}/scripts/uninstall.sh" > /dev/null 2>&1;
"${DIR}/scripts/install.sh" > /dev/null 2>&1;

echo "Plugin updated";

exit 0;
