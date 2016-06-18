-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Game (name, info) VALUES ('Street Fighter V', 'Street Fighter-sarjan uusin osa. Julkaistu vuonna 2016 PS4:lle sekä PC:lle.');
INSERT INTO Game (name, info) VALUES ('Tekken 7', 'Toistaiseksi vain arcadeissa julkaistu Tekken-sarjan uusin osa.');
INSERT INTO Game (name, info) VALUES ('Tekken 7: Fated Retribution', 'Tekken 7:n kesällä tuleva päivitys. Julkaistaan joskus myös PS4:lle.');   

INSERT INTO Event (name, location, start_date, end_date, live, update_key) VALUES ('EVO 2015', 'Las Vegas', '17-7-2015', '19-7-2015', false, 'ABCDEFG');
INSERT INTO Event (name, location, start_date, end_date, live, stream_urls, update_key) VALUES ('EVO 2016', 'Las Vegas', '15-7-2016', '17-7-2016', true, '{"stream1", "stream2"}', 'abcdefg');

INSERT INTO Tournament (event_id, game_id) VALUES (1,1);
INSERT INTO Tournament (event_id, game_id) VALUES (1,2);
INSERT INTO Tournament (event_id, game_id) VALUES (2,1);
INSERT INTO Tournament (event_id, game_id) VALUES (2,2);

INSERT INTO Fight (name, tournament_id, player1, player2, ordering, winner1, video_url, p1score, p2score) VALUES ('Grand Finals', 2, 'BE|AO', 'ORZ|NOBI', 1, false, '8fvK0JOa0vg', 5, 3);

INSERT INTO Users (username, password, super) VALUES ('super', 'super', true);
INSERT INTO Users (username, password, super) VALUES ('basic', 'basic', false);