-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, salasana, yllapitaja) VALUES ('ylla','pitaja', true);
INSERT INTO Kayttaja (nimi, salasana) VALUES ('sampe','sampe');
INSERT INTO Kayttaja (nimi, salasana) VALUES ('milka','milka');
INSERT INTO Pokemon (id, nimi, jarjestysnumero, tyyppi, edellinenmuoto, seuraavamuoto) VALUES (25, 'Pikachu', 25, 'sahko', 'Pichu', 'Raichu');
INSERT INTO KayttajaPokemon(kayttaja_nimi, pokemon_id, lempinimi, kaappauspvm, cp, iv) VALUES ('ylla', 25, 'seppo', date '2017-12-01', 500, 80);
INSERT INTO KayttajaPokemon(kayttaja_nimi, pokemon_id, lempinimi, kaappauspvm, cp, iv) VALUES ('ylla', 25, 'yrjänä', date '2017-12-01', 450, 70);