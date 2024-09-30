# [Exercise 1:](https://kuleuven-diepenbeek.github.io/cloud-course/applicatiecolleges/docker_build_files/#exercise-1) C development environment

Maak een `Dockerfile` en een `docker-compose.yml` file die een C development environment opzet zodat je met het volgende commando `make build && make run` in de container het kleine C programma in `./myfiles` kan compileren en runnen met behulp van GCC. Zorg ervoor dat de `./myfiles` met een volume gebonden is aan de container zodat je vanaf de host wijzigingen kan aanbrengen.

TIPS: Gebruik een geschikte base image en denk na welke programma's je nodig hebt om C applicaties te compilen en runnen.