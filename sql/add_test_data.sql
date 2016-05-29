-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Peli (nimi, tiedot) VALUES ('Street Fighter V', 'Street Fighter-sarjan uusin osa. Julkaistu vuonna 2016 PS4:lle sekä PC:lle.')
INSERT INTO Peli (nimi, tiedot) VALUES ('Tekken 7', 'Toistaiseksi vain arcadeissa julkaistu Tekken-sarjan uusin osa. Tulossa PS4:lle 2016.')

INSERT INTO Turnaustapahtuma (nimi, paikka, aloituspv, lopetuspv, live, avain) VALUES ('EVO 2015', 'Las Vegas', '17-7-2015', '19-7-2015', false, 'ABCDEFG')
INSERT INTO Turnaustapahtuma (nimi, paikka, aloituspv, lopetuspv, live, stream_urls, avain) VALUES ('EVO 2016', 'Las Vegas', '15-7-2016', '17-7-2016', true, {'stream1', 'stream2'}, 'abcdefg')

INSERT INTO Turnaus (turnaustapahtuma_id, peli_id) VALUES (1,1)
INSERT INTO Turnaus (turnaustapahtuma_id, peli_id) VALUES (1,2)
INSERT INTO Turnaus (turnaustapahtuma_id, peli_id) VALUES (2,1)
INSERT INTO Turnaus (turnaustapahtuma_id, peli_id) VALUES (2,2)

INSERT INTO Ottelu (nimi. turnaus_id, pelaaja1, pelaaja2, jarjestys, voittaja1, video_url, tulos) VALUES ('Grand Finals' 2, 'BE|AO', 'ORZ|NOBI', 1, false, )