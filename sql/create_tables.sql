-- Lisää CREATE TABLE lauseet tähän tiedostoon
-- CREATE TABLE Yllapitaja(
-- id SERIAL PRIMARY KEY,
-- nimi varchar(50) NOT NULL,
-- salasana varchar(50) NOT NULL
-- );
-- 
CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
salasana varchar(50) NOT NULL,
yllapitaja boolean NOT NULL
);

CREATE TABLE Pokemon(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
jarjestysnumero INTEGER NOT NULL,
edellinenMuoto varchar(50),
seuraavaMuoto varchar(50),
yllapitaja_id INTEGER REFERENCES Yllapitaja(id)
);

CREATE TABLE KayttajaPokemon(
id SERIAL PRIMARY KEY,
kayttaja_id INTEGER REFERENCES Kayttaja(id),
pokemon_id INTEGER REFERENCES Pokemon(id),
kaappausPvm DATE NOT NULL,
CP INTEGER NOT NULL,
IV INTEGER NOT NULL
);