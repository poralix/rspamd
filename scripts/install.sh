#!/bin/bash
######################################################################################
#
#   Rspamd web interface plugin for Directadmin $ 0.1.2
#   ==============================================================================
#          Last modified: Thu Oct 10 11:54:54 +07 2019
#   ==============================================================================
#         Written by Alex S Grebenschikov (support@poralix.com)
#         Copyright 2019 by Alex S Grebenschikov (support@poralix.com)
#   ==============================================================================
#
######################################################################################

DIR="/usr/local/directadmin/plugins/rspamd";

chown -R diradmin:diradmin "${DIR}";
chmod 711 "${DIR}";
chmod 755 "${DIR}/hooks/";
chmod 644 "${DIR}/hooks/admin_img.html";
chmod 644 "${DIR}/hooks/admin_txt.html";
chmod 710 "${DIR}/admin/"*.raw;
chmod 710 "${DIR}/admin/"*.html;
chmod 710 "${DIR}/data/";
chmod 710 "${DIR}/exec/";

perl -pi -e "s/^active=no/active=yes/" "${DIR}/plugin.conf";
perl -pi -e "s/^installed=no/installed=yes/" "${DIR}/plugin.conf";

echo "Plugin installed";

exit 0;
