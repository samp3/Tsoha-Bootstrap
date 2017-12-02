-- Lisää CREATE TABLE lauseet tähän tiedostoon
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
tyyppi varchar(50) NOT NULL,
edellinenmuoto varchar(50),
seuraavamuoto varchar(50),
kayttaja_id INTEGER REFERENCES Kayttaja(id)
);

CREATE TABLE KayttajaPokemon(
id SERIAL PRIMARY KEY,
kayttaja_id INTEGER REFERENCES Kayttaja(id),
pokemon_id INTEGER REFERENCES Pokemon(id),
kaappauspvm DATE NOT NULL,
cp INTEGER NOT NULL,
iv INTEGER NOT NULL
);