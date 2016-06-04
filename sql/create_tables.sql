-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Game(
    id SERIAL PRIMARY KEY,
    name        varchar(40)     NOT NULL,
    info        text
);

CREATE TABLE Event(
    id SERIAL PRIMARY KEY,
    name        varchar(40)     NOT NULL,
    location    varchar(40),
    start_date  DATE,
    end_date    DATE,
    live        boolean         NOT NULL,
    stream_urls varchar(20)[],
    update_key  varchar(10)     NOT NULL
);

CREATE TABLE Tournament(
    id SERIAL PRIMARY KEY,
    event_id    INTEGER REFERENCES Event(id),
    game_id     INTEGER REFERENCES Game(id),
    results     varchar(20)[]
);

CREATE TABLE Fight(
    id SERIAL PRIMARY KEY,
    tournament_id INTEGER REFERENCES Tournament(id),
    name        varchar(20)     NOT NULL,
    player1     varchar(20)     NOT NULL,
    player2     varchar(20)     NOT NULL,
    ordering    INTEGER         NOT NULL,
    winner1     boolean,
    video_url   varchar(20),
    timecode    INTEGER         DEFAULT (0),
    results     varchar(20)
);