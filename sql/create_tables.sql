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
    live        boolean NOT NULL,
    stream_urls varchar(20)[],
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
    nimi        varchar(20)     NOT NULL,
    pelaaja1    varchar(20)     NOT NULL,
    pelaaja2    varchar(20)     NOT NULL,
    jarjestys   INTEGER         NOT NULL,
    voittaja1   boolean,
    video_url   varchar(20),
    timecode    varchar(10)     DEFAULT ('0m0s'),
    tulos       varchar(20)
)