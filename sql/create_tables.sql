-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
nimi varchar(50) PRIMARY KEY NOT NULL,
salasana varchar(50) NOT NULL,
yllapitaja boolean
);

CREATE TABLE Pokemon(
id SERIAL PRIMARY KEY,
nimi varchar(50) NOT NULL,
jarjestysnumero INTEGER NOT NULL,
tyyppi varchar(50) NOT NULL,
edellinenmuoto varchar(50),
seuraavamuoto varchar(50),
kayttaja_nimi varchar(50) REFERENCES Kayttaja(nimi)
);

CREATE TABLE KayttajaPokemon(
id SERIAL PRIMARY KEY,
pokemon_id INTEGER REFERENCES Pokemon(id),
kayttaja_nimi varchar(50) REFERENCES Kayttaja(nimi),
lempinimi varchar(50) NOT NULL,
kaappauspvm DATE NOT NULL,
cp INTEGER NOT NULL,
iv INTEGER NOT NULL

);