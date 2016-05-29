-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Peli(
    id SERIAL PRIMARY KEY,
    nimi        varchar(40)     NOT NULL,
    tiedot      text
)

CREATE TABLE Turnaustapahtuma(
    id SERIAL PRIMARY KEY,
    nimi        varchar(40)     NOT NULL,
    paikka      varchar(40),
    aloituspv   DATE,
    lopetuspv   DATE,
    avain       INTEGER         NOT NULL
)

CREATE TABLE Turnaus(
    id SERIAL PRIMARY KEY,
    turnaustapahtuma_id INTEGER REFERENCES Turnaustapahtuma(id),
    peli_id INTEGER REFERENCES Peli(id),
    tulokset    varchar(20)[]
)

CREATE TABLE Ottelu(
    id SERIAL PRIMARY KEY,
    turnaus_id INTEGER REFERENCES Turnaus(id)
    pelaaja1    varchar(20)     NOT NULL,
    pelaaja2    varchar(20)     NOT NULL,
    voittaja1   boolean,
    tulos       varchar(20)
)