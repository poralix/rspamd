<p align="center"><a href="https://directadmin.com"><img src="https://directadmin.com/img/logo/logo_directadmin.svg" alt="Directadmin" width="440px"/></a> &nbsp;&nbsp; <sup>+</sup>  &nbsp; <a href="https://rspamd.com"><img src="https://rspamd.com/img/rspamd_logo_black.png" alt="Rspamd" width="220px"/></a></p>

## NAME

Rspamd web interface plugin for DirectAdmin Panel

## DESCRIPTION

The plugin provides administrators an access from DirectAdmin (the hosting panel) to a simple control interface for Rspamd (spam filtering system).

The Rspamd Web-UI provides basic functions for setting metric actions, scores, viewing statistic and learning.

The plugin does not use or modify original files of Rspamd Web-UI. It proxies requests from users to Rspamd Web-UI and replies from the Web-UI to users.
As a reverse proxy the plugin modifies links to keep navigation working within DirectAdmin.

## PLUGIN VERSION

- Version: 0.2.8
- Last modified: Wed Jan 14 05:51:36 PM +07 2026
- Update URL: https://files.poralix.com/get/freesoftware/rspamd.tar.gz
- Version URL: https://files.poralix.com/version/freesoftware/rspamd
- Tested with version of Rspamd: rspamd-3.14.3

## CHANGELOG

- Jan 14, 2026: Updated for rspamd-3.14.3, fixed bug with fuzzy hashes upload
- Oct 11, 2025: Updated for rspamd-3.13.2
- May 05, 2024: Updated for rspamd-3.9.0-57
- Feb 22, 2023: Updated for rspamd-3.5-12
- Sep 20, 2020: Updated for Rspamd 2.6-25.git37f19ff44.x86_64
- May 21, 2020: Updated to support Rspamd web-interface via UNIX-socket
- Oct 08, 2019: Updated for Rspamd 2.0-43.git6ea2346e8.x86_64
- May 14, 2019: Updated for Rspamd 1.9.3 (stable) and 1.9.4 (experimental)

## INSTALLATION

See the [INSTALL.md](INSTALL.md) file for installation instructions

## USAGE

Connect to DirectAdmin as administrator and go to `Rspamd Web Interface` under `Extra Features`

## AUTHORS

- Plugin for Directadmin is written by **Alex Grebenschikov**
- Rspamd with the web interface is written by **Vsevolod Stakhov**
- Directadmin is owned and written by **JBMC Software**

## LICENSE

This project is licensed under the Apache 2.0 License - see the [LICENSE.md](LICENSE.md) file for details

## NOTICES

See the [NOTICE.md](NOTICE.md) file for details

## REFERENCES

- Rspamd Home site: <https://rspamd.com>
- Plugin Development: <https://github.com/poralix/rspamd>
- Custom Plugin Development and Server Support: <https://www.poralix.com>
- DirectAdmin Home site: <https://directadmin.com>
