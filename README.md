<p align="center"><a href="https://directadmin.com"><img src="https://directadmin.com/img/logo/logo_directadmin.svg" alt="Directadmin" width="440px"/></a> &nbsp;&nbsp; <sup>+</sup>  &nbsp; <a href="https://rspamd.com"><img src="https://rspamd.com/img/rspamd_logo_black.png" alt="Rspamd" width="220px"/></a></p>

## NAME

Rspamd web interface plugin for DirectAdmin Panel

## DESCRIPTION

The plugin provides administrators an access from DirectAdmin (the hosting panel) to a simple control interface for Rspamd spam filtering system.

The Rspamd Web-UI provides basic functions for setting metric actions, scores, viewing statistic and learning.

The plugin does not use or modify original files of Rspamd Web-UI. It proxies requests from users to Rspamd Web-UI and replies from the Web-UI to users.
As a reverse proxy the plugin modifies links to keep navigation working within DirectAdmin.

## PLUGIN VERSION

- Version: 0.1.1
- Last modified: Tue May 14 12:30:43 +07 2019
- Update URL: https://files.poralix.com/get/freesoftware/rspamd.tar.gz
- Version URL: https://files.poralix.com/version/freesoftware/rspamd
- Tested with version of Rspamd: 1.9.2, 1.9.3 (stable) and 1.9.4 (experimental)

## CHANGELOG

- May 14, 2019: Updated for Rspamd 1.9.3 (stable) and 1.9.4 (experimental)

## INSTALLATION

See the [INSTALL.md](INSTALL.md) file for installation instructions

## USAGE

Connect to DirectAdmin as administrator and go to `Rspamd Web Interface` under `Extra Features`

## AUTHOR

Plugin for Directadmin is written by **Alex Grebenschikov**

Rspamd with the web interface is written by **Vsevolod Stakhov**

Directadmin is owned and written by **JBMC Software**

## LICENSE

This project is licensed under the Apache 2.0 License - see the [LICENSE.md](LICENSE.md) file for details

## NOTICES

See the [NOTICE.md](NOTICE.md) file for details

## REFERENCES

- Rspamd Home site: <https://rspamd.com>
- Plugin Development: <https://github.com/poralix/rspamd>
- Custom Plugin Development and Server Support: <https://www.poralix.com>
- DirectAdmin Home site: <https://directadmin.com>
