### [Exercise 2](https://kuleuven-diepenbeek.github.io/cloud-course/applicatiecolleges/docker_basics/#exercise-2)

Ik gebruik de mariadb base image en pas de environment variables aan naar het gewenste wachtwoord, user ...

Uit [de gevonden documentatie](https://hub.docker.com/_/mariadb) blijkt dat de volgende compose-file kunnen gebruiken:

1. Ik maak een docker-compose.yml file:
```yml
# Use root/example as user/password credentials
version: '3.1'

services:
  db:
    image: mariadb
    restart: always
    environment:
      MARIADB_ROOT_PASSWORD: example

  adminer:
    image: adminer
    restart: always
    ports:
      - 9092:8080
```

**LET OP: we hebben geen volume gebonden aan de container dus als we de container verwijderen is onze database ook weg**

Een beetje verder zoeken in de documentatie geeft ons het volgende om onze eigen data op te slaan: `... -v /my/own/datadir:/var/lib/mysql:Z ...`. Toegepast op de `docker-compose.yml` geeft dit: 

```yml
# Use root/example as user/password credentials
version: '3.1'

services:
  db:
    image: mariadb
    restart: always
    environment:
      MARIADB_ROOT_PASSWORD: example
    volumes:
      - ./mydata:/var/lib/mysql:Z

  adminer:
    image: adminer
    restart: always
    ports:
      - 9092:8080
```

2. Je kan de adminer interface gebruiken om te werken met de database. (je kan natuurlijk ook attachen tot de container en de mariadb commandline interface gebruiken) 
```bash
$ docker exec -it applicatiecolleges_1_docker_basics_exercise2_solution-db-1 bash
# start de mariadb commandline tool
$ mariadb –u root –p
# Geef je wachtwoord in 'example'
# Maak database
MariaDB [(none)]> CREATE DATABASE test;
# enter je database: 
MariaDB [(none)]> \u test
# edit je database
MariaDB [test]> schrijf_hier_je_sql_commands
```

3. Maak een database en tabel aan en bekijk je `mydata` folder. Je zal zien dat alle files voor de database erin verschenen zijn.

Met onderstaande SQL code kan je wat dummy data aanmaken.
```sql
-- Drop the table if it already exists
DROP TABLE IF EXISTS Students;

-- Create the Students table
CREATE TABLE Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    BirthDate DATE,
    Email VARCHAR(100),
    EnrollmentDate DATE
);

-- Insert two example students into the Students table
INSERT INTO Students (FirstName, LastName, BirthDate, Email, EnrollmentDate)
VALUES
('John', 'Doe', '2000-01-15', 'john.doe@example.com', '2023-09-01'),
('Jane', 'Smith', '1999-05-22', 'jane.smith@example.com', '2023-09-01');
```
 
