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

chown -R diradmin:diradmin "${DIR}";
chmod 700 "${DIR}/admin/"*.raw;
chmod 700 "${DIR}/admin/"*.html;
chmod 700 "${DIR}/data/";
chmod 700 "${DIR}/exec/";

perl -pi -e "s/^active=no/active=yes/" "${DIR}/plugin.conf";
perl -pi -e "s/^installed=no/installed=yes/" "${DIR}/plugin.conf";

echo "Plugin installed";

exit 0;
