# Installing Open Paging Server using Docker

Open Paging Server can be installed using Docker Compose. Please be aware that this is currently in beta. This is recommended if you have a single host running multiple programs.

## Step 1: Install Docker  (if you have not already)

### Official

[Install Docker Desktop](https://docs.docker.com/desktop/setup/install/)

[Install Docker Engine](https://docs.docker.com/engine/)

### docker.io (Unofficial: Debian/Ubuntu Community)

```
sudo apt update
sudo apt install -y docker.io docker-compose-v2
```

## Step 2: Setup MySQL/MariaDB

Install MariaDB (or MySQL) on your server. 

Debian based distros:
> sudo apt install mariadb-server -y

And create a new database & user:

```
CREATE DATABASE openpagingserver;

CREATE USER 'openpagingserver'@'localhost' IDENTIFIED BY 'ChangeThisPassword';

GRANT ALL PRIVILEGES ON openpagingserver.* TO 'openpagingserver'@'localhost';

FLUSH PRIVILEGES;
```

Change the password so that it's unqine. Make sure you have your password for later.

## Step 3: Clone Docker Compose Repository

If you have Git installed, you can run:

```
cd /opt # Or any other directory
git clone https://www.github.com/OpenPagingServer/openpagingserver-dockercompose
```

## Step 4: Create .env

From within the repository, run:

```
cp .env.example .env
```

And edit .env to match your configuration

Paste your MySQL database password in `DB_PASS`.  If you are using a different database name, user, or host, you can edit those as well.

Set `DEBUG` to true to expose tracebacks to the web UI and to create log files

If you are using an external reverse proxy, you can allow one or more of them in `WEB_REVERSE_PROXY_ALLOWED` and `API_REVERSE_PROXY_ALLOWED`.

`WEB_HOST` defines which address the web interface runs on. For example, set this to `127.0.0.1` if using a local reverse proxy.

You can change your `HTTP_PORT`, `HTTPS_PORT`, and `SIP_PORT` here as well if they overlap with another service or using a reverse proxy. If your installing Open Paging Server alongside FreePBX or Asterisk, you'll want to change these ports so that they don't overlap with your primary VoIP service. When Open Paging Server is installed in Docker, ports can only be defined in `.env` and cannot be changed from the web interface, like on native installs.

`DEMO_MODE` blocks user generated content from being uploaded and settings from being modified. This should not be enabled on production servers.

```
DEBUG=false
DEMO_MODE=false
WEB_REVERSE_PROXY_ALLOWED=127.0.0.1
API_REVERSE_PROXY_ALLOWED=127.0.0.1
WEB_HOST=0.0.0.0
HTTP_PORT=80
HTTPS_PORT=443
SIP_PORT=5060

# MySQL/MariaDB Config
DB_HOST=127.0.0.1
DB_USER=openpagingserver
DB_PASS=
DB_NAME=openpagingserver
```

## Step 5: Bring the container up

Run the following command to bring the container up:

```
docker compose up -d
```

Download and initialization of Open Paging Server will take 5-10 minutes depending on your internet speed. Once it's finished, you can access the web interface to finish setup.

As mentioned before, this is still in beta. Please feel free to let us know about any feedback you may have.