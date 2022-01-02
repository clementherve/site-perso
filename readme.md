# Personal website


>   ### Todo:
>   - [ ] fix weird bugs on admin panel (not saving tags first try + some remanent errors)
>
>   - [ ] make repo public (make sure no private things are leaked -> github variables)
>
>   - [ ] create automatic deployment of github repo to the server
>   - [ ] create regular backups of db to private github (cron)


### Features

- Create, display and update articles in a breeze
- Lightweight, fast and secure
- Automatic backups of your articles
- Fetch projects from GitHub
- About page + CV integration
- No headache administration panel: see what articles are published / draft
- Privacy focused: 0 tracking
- Based on Postgrèsql but easily compatible with other systems



### Installation

Install packages with composer:
```
  composer install
```

Install Postgrèsql PHP module:
```bash
sudo apt install php7.4-pgsql
# apt search | grep pgsql
```

Update or create a nginx config file for your website:
```
location  / {
  rewrite ^(.*)$ /index.php?route=$1 last;
}
```
Restart your server with `sudo systemctl restart nginx.service` or `sudo nginx -s reload`.


Modify your `docker-compose.yml` as follow:
```yml
version: '3'
services:
  blog:
    image: 'postgres:14'
    ports:
      - 5432:5432
    volumes:
      - "./data/pgdata:/var/lib/postgresql"
    environment:
      POSTGRES_USER: <username>
      POSTGRES_PASSWORD: <password>
      POSTGRES_DB: blog
```
And run it with `docker-compose up -d`.

Update the `config.php` file with correct values. It should look something like this:
```php

<?php
    // debug config
    $GLOBALS['config']["debug"] = false;

    // site config
    $GLOBALS['config']["site_addr"] = "http://127.0.0.1";
    $GLOBALS['config']["admin_user"] = "username";
    $GLOBALS['config']["admin_password"] = "password";

    // cosmetic config
    $GLOBALS['config']["site_title"] = "My super blog";
    $GLOBALS['config']["site_sub"] = "My super blog description";

    // database config
    $GLOBALS['config']["host"] = "localhost";
    $GLOBALS['config']["dbname"] = "blog";
    $GLOBALS['config']["user"] = "username";
    $GLOBALS['config']["password"] = "password";

    // projects config
    $GLOBALS['config']["github_username"] = "githubusername";
```

Enjoy!
