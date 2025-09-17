# Blogging with Nginx, SQLite3, PHP8 and Typecho


by Marcus Zou | 20 Feb 2025



## Intro

This guide will show you how to quickly and easily integrate Nginx, SQLite3, and PHP using Docker Compose. 

Without further ado, let’s work it out.

#### # Tech Stack

* __Linux__: Debian/Ubuntu is preferred
* __Nginx__: The web server, proxy server, load balancer
* __SQLite3__: A single file based, light-weight database
* __PHP__: 8.2-FPM (FastCGI Process Manager)

#### # Prerequisites

- Linux: Debian or Ubuntu preferred, WSL2 distro works well
- Docker Engine/Desktop installed

- Run the command below to ensure that Docker Compose is installed and functioning correctly.

  ```shell
  docker -- version
  ## Docker version 27.5.1, build 9f9e405
  docker compose version
  ## Docker Compose version v2.32.4
  ```

  

## Quick-Start

1. Git clone my repo: https://github.com/marcuszou/lemp-typecho.git.

   ```shell
   git clone https://github.com/marcuszou/lemp-sqlite3.git
   ```

2. Fine tune the `docker-compose.yml` as needed.

   ```shell
   sudo chown -R $USER:$USER ./lemp-sqlite3
   cd lemp-sqlite3
   nano docker-compose.yml
   ```

3. Fire up the docker containers. 

   ```shell
   docker compose up -d
   ```

   Docker will pull down the relevant images and start the containers, which will take some time.

4. Access the website via http://localhost:8080 for the Web, 

5. Access the SQLite Browser at http://localhost:5800.



## Outro

Detailed Steps can be found at [This Guide](./Guide-to-Dockerize-Nginx-SQLite3-PHP8.md).



## License

MIT
