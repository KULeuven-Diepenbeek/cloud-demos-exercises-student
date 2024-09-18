### [Exercise 1](https://kuleuven-diepenbeek.github.io/cloud-course/applicatiecolleges/docker_basics/#exercise-1)

Gebruik de nginx base image en maak gebruik van docker volumes om je eigen statische website te tonen

Uit [de gevonden documentatie](https://hub.docker.com/_/nginx) blijkt dat we volgende commando kunnen gebruiken: `$ docker run --name some-nginx -p 9091:80 -v /some/content:/usr/share/nginx/html:ro -d nginx`

(om het te automatiseren maak ik gebruik van relative path binding to host directory in plaats van docker volumes)

1. Ik maak een docker-compose.yml file:
```yml
version: '3.8'

services:
  nginx_example:
    image: nginx:latest
    container_name: nginx_example
    ports:
      - "9091:80"
    volumes:
      - ".myfiles/":"/usr/share/nginx/html"
    restart: unless-stopped

```
2. Ik maak een `index.html` file aan met mijn website code in.