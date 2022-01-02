# Personal website


>   ### Todo:
>   - [ ] fix /data/projects (not needed anymore)
>   - [ ] fix weird bug on admin panel (not saving tags first try + some remanent errors)
>
>   - [ ] push this to github without the /data folder
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

Update the `config.php` with correct values.

Enjoy!
