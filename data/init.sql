CREATE DATABASE LuisterLijst;
use LuisterLijst;

CREATE TABLE Nummers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Titel VARCHAR(30) NOT NULL,
    Artiest VARCHAR(30) NOT NULL,
    Album VARCHAR(50) NOT NULL,
    Jaar INT
  );