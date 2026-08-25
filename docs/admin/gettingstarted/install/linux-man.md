# Manually installing on Linux

This guide will show you how to manually install Open Paging Server on Linux outside the install script. This can be done for extra control over the installation process or for if you cannot run the script for a certain reason.

## Install Linux Dependencies  

The following packages are needed by Open Paging Server for basic functionally

- `python3`
- `python3-venv`
- `python3-pip`
- `python3-dev`
- `build-essential`
- `pkg-config`
- `mariadb-server`
- `mariadb-client`
- `ffmpeg`
- `fontconfig`
- `fonts-dejavu-core`
- `git`
- `curl`
- `ca-certificates`
- `tar`

On a system that uses Advanced Package Tool (such as Debian, Kali, Ubuntu, Minit), you can use:

```
apt update 
apt install -y \ python3 python3-venv python3-pip python3-dev \ build-essential pkg-config \ mariadb-server mariadb-client \ ffmpeg fontconfig fonts-dejavu-core \ git curl ca-certificates tar
```

On a system that uses Pacman (such as Arch, Manjaro), you can use:

```
sudo pacman -Syu

sudo pacman -S --needed \
  python \
  python-virtualenv \
  python-pip \
  base-devel \
  pkgconf \
  mariadb \
  ffmpeg \
  fontconfig \
  ttf-dejavu \
  git \
  curl \
  ca-certificates \
  tar
```

## Download Open Paging Server
Open Paging Server can be downloaded via the releases tab on Github. Download and extract to /opt/OpenPagingServer

## Creating Python virtual environment
It's recommended to run any Python app in a virtual environment. To create and enter a virtual environment, run

```
cd /opt/OpenPagingServer
python3 -m venv .venv
source .venv/bin/activate
```
## Installing Python Dependenices
The following packages are needed by Open Paging Server for basic functionally

- Flask
- Flask-CORS
- PyMySQL
- Waitress
- python-dotenv
- Requests
- Pillow
- NumPy
- lxml
- aiohttp
- websockets
- cryptography
- passlib
- argon2-cffi

From within the venv we just made, run

```
python3 -m pip install \
  flask \
  flask-cors \
  pymysql \
  waitress \
  python-dotenv \
  requests \
  pillow \
  numpy \
  lxml \
  aiohttp \
  websockets \
  cryptography \
  passlib \
  argon2-cffi

```

## Creating Open Paging Server directories

```
mkdir /var/lib/openpagingserver
mkdir /var/lib/openpagingserver/assets
mkdir /var/lib/openpagingserver/endpointmodules
mkdir /var/lib/openpagingserver/runtime
mkdir /var/log/openpagingserver
mkdir /var/spool/openpagingserver
mkdir /etc/openpagingserver/trustedca
```

If you are not running Open Paging Server as root, ensure the openpagingserver user has access and ownership to all of the above directories as we will discuss later.

## Creating database
This and the next 2 steps can be handled by /opt/OpenPagingServer/scripts/database_initialization.py

## Creating .env and .oobe
If you manually created the database rather than running database_initialization.py, you will need to create .env and .oobe

.env should contain the following:

```
DB_HOST='127.0.0.1'
DB_USER='YOURDBUSERHERE'
DB_PASS='YOURDBPASSHERE'
DB_NAME='YOURDBNAMEHERE'
DEBUG=false
WEB_REVERSE_PROXY_ALLOWED=127.0.0.1
API_REVERSE_PROXY_ALLOWED=127.0.0.1
DEMO_MODE=false
```

You can edit the parameters to fit your needs

You will also need to create .oobe for the initial setup process to commence. Or you can run scripts/newuser.py to bypass the setup process. The first user is always the head system administrator.

## Installing Open Paging Server Project CA's
All external code loaded by Open Paging Server must be signed by a trusted certificate authority. This includes plugins, endpoint modules, etc. A

All first-party modules and trusted third-party modules are signed by the Open Paging Server Project CA. Which can be downloaded from https://install.openpagingserver.org/rootca.crt to /etc/openpagingserver/trustedca

## Creating Linux users
Open Paging Server can be ran as root, however, do this understanding the risks involved. Since any code running under Open Paging Server will also run under root. While the risk should be lower due to the signing requirement for third-party code, there's no reason OPS needs to run as root.

If running outside root, ensure the openpagingserver user has privileged port access and that it has permissions for all directories created by OPS.

## Adding and starting systemd service 
You can use systemd to launch Open Paging Server when the server boots. Create /etc/systemd/system/openpagingserver.service with

```ini
[Unit]
Description=Open-source VoIP public address & mass notification system
After=network.target

[Service]
Type=simple
ExecStart=/opt/OpenPagingServer/index.py
WorkingDirectory=/opt/OpenPagingServer
Restart=always
RestartSec=5
User=openpagingserver
Environment=PYTHONUNBUFFERED=1

[Install]
WantedBy=multi-user.target
```

Change user to the user you are running Open Paging Server under (e.g. openpagingserver, root)

To load the new service and start Open Paging Server, run

``
systemctl daemon-reload
systemctl enable --now openpagingserver
``

## Access web interface to begin using Open Paging Server
Run `ip a` to obtain the server IP address and go to http://IP on another computer.

If installed correctly, you should see the Open Paging Server web interface and be able to run the OOBE or login with the user you created.
