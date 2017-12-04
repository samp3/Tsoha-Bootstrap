-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (id, nimi, salasana, yllapitaja) VALUES ('ylla','pitaja', true);
INSERT INTO Kayttaja (id, nimi, salasana, yllapitaja) VALUES ('sampe','sampe', false);
INSERT INTO Kayttaja (id, nimi, salasana, yllapitaja) VALUES ('milka','milka', false);
INSERT INTO Pokemon (id, nimi, jarjestysnumero, tyyppi, edellinenmuoto, seuraavamuoto) VALUES (25, 'Pikachu', 25, 'sahko', 'Pichu', 'Raichu');
INSERT INTO KayttajaPokemon(kayttaja_id, pokemon_id, kaappauspvm, cp, iv) VALUES (2, 25, date '2017-12-01', 500, 80);
INSERT INTO KayttajaPokemon(kayttaja_id, pokemon_id, kaappauspvm, cp, iv) VALUES (2, 25, date '2017-12-01', 450, 70);