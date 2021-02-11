# How to run this project
> This project require docker-compose

### Configure API and rabbitmq server url

Modify the [`prod.env.js`](https://github.com/PongCupz/cardgame/blob/main/my-app/config/prod.env.js) file present in this repository

```diff
module.exports = {
  NODE_ENV: '"production"',
-   ROOT_API: '"http://localhost:8080"',
-   ROOT_WS: '"ws://localhost:15675/ws"'
+   ROOT_API: '"http://{{servername}}:8080"',
+   ROOT_WS: '"ws://{{servername}}:15675/ws"'
}
```
* Using `docker-compose` command:

```console
$ docker-compose up -d
```
* Connect to server form port :80

# Project structure

- API using slim framwork PHP [http://localhost:8080](http://localhost:8080) source code in folder `api`
- Database using mysql [http://localhost:8088](http://localhost:8088)
- MQTT Protocol using Rabbitmq [http://localhost:15672](http://localhost:15672) (default user guest:guest)
- Front UI using vuejs [http://localhost](http://localhost) source code in folder `my-app`
- Load balance using nginx

# Configure database

Modify the [`docker-compose.yml`](https://github.com/PongCupz/cardgame/blob/main/docker-compose.yml) file

```console
    environment:
      - MYSQL_ROOT_PASSWORD=123132123
      - MYSQL_DATABASE=game
      - MYSQL_USER=game
      - MYSQL_PASSWORD=password
```
Modify the [`settings.php`](https://github.com/PongCupz/cardgame/blob/main/api/src/settings.php) file

```console
    'db' => [
      'driver' => 'mysql',
      'host' => 'db',
      'database' => 'game',
      'username' => 'game',
      'password' => 'password',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ],
```

# API Document

- Swagger API include in project after build project see [http://localhost:8082](http://localhost:8082)