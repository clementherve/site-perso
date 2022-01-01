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

Install Postgrèsql PHP module and restart your server (here, nginx):
```bash
sudo apt install php7.4-pgsql
sudo systemctl restart nginx.service
```

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
      POSTGRES_DB: articles
```
And run it with `docker-compose up -d`.

Update the `config.php` with correct values.

Enjoy!
