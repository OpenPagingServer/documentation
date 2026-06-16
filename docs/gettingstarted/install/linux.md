# Installing Open Paging Server on Linux

For now, this is the only supported way of installing Open Paging Server. An automated install script can be ran by running `` curl -fsSL https://install.openpagingserver.org | bash `` as the root user.


This script is currently only designed for Debian. Python 3 will be installed if not already. MariaDB will be installed if not already, and a database will be created. Nginx and PHP will /etc/nginx-old. A future version of the install script will be able to handle this properly. Open Paging Server will be downloaded to /opt/OpenPagingServer, a venv will be created insids will also be downloaded.
A fully featured install script will be written before 1.0.0 is released.

The source code is at https://github.com/OpenPagingServer/Installer 

To inspect it before running you can run:

```
curl -fsSL https://install.openpagingserver.org -o install-openpagingserver.sh
nano install-openpagingserver.sh
bash install-openpagingserver.sh
```


