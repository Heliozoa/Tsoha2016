-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Peli(
    id SERIAL PRIMARY KEY,
    nimi varchar(40) NOT NULL,
    tiedot varchar(400)
)

CREATE TABLE Turnaus(
    id SERIAL PRIMARY KEY,
    nimi varchar(40) NOT NULL,
    paikka varchar(40),
    aloituspv DATE,
    lopetuspv DATE,
    tulokset varchar(max)
)

CREATE TABLE Ottelu(
    id SERIAL PRIMARY KEY,
    pelaajat varchar(40) NOT NULL,
    tulos varchar(40) NOT NULL
)