
CREATE TYPE pokemon_gender AS ENUM ('Male', 'Female', 'Genderless');
-- syntax error ensimmäisessä createssa? sen jälkeen kyllä toimii ja siksi duplikaatti create
CREATE TYPE pokemon_gender AS ENUM ('Male', 'Female', 'Genderless');
CREATE TYPE move_category AS ENUM ('Physical', 'Special', 'Status');
CREATE TYPE pokemon_type AS ENUM ('Normal', 'Fire', 'Fighting', 'Water', 'Flying', 'Grass', 'Poison', 'Electric', 'Ground', 'Psychic', 'Rock', 'Ice', 'Bug', 'Dragon', 'Ghost', 'Dark', 'Steel', 'Fairy');

CREATE TABLE patron(
	id SERIAL NOT NULL PRIMARY KEY,
	name varchar(50) UNIQUE NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE move(
	id SERIAL NOT NULL PRIMARY KEY,
	name varchar(50) UNIQUE NOT NULL,
	type pokemon_type NOT NULL,
	category move_category NOT NULL,
	power integer,
	accuracy integer CHECK(accuracy < 101 ) CHECK(accuracy > -1),
	pp integer,
	description text
);

CREATE TABLE species(
	id SERIAL NOT NULL PRIMARY KEY,
	name varchar(50) UNIQUE NOT NULL,
	dexno integer UNIQUE NOT NULL,
	type1 pokemon_type NOT NULL,
	type2 pokemon_type,
	ability1 varchar(20) NOT NULL,
	ability2 varchar(20),
	hability1 varchar(20),
	hability2 varchar(20),
	base_hp integer NOT NULL,
	base_atk integer NOT NULL,
	base_def integer NOT NULL,
	base_satk integer NOT NULL,
	base_sdef integer NOT NULL,
	base_speed integer NOT NULL
);

-- junction table
CREATE TABLE moves_of_species(
	move_id integer REFERENCES move(id),
	species_id integer REFERENCES species(id),
	id SERIAL NOT NULL PRIMARY KEY
);

CREATE TABLE pokemon(
	user_id integer REFERENCES patron(id),
	species_id integer REFERENCES species(id),
	id SERIAL NOT NULL PRIMARY KEY,
	nickname varchar(50) NOT NULL,
	gender pokemon_gender NOT NULL,
	ability varchar(20) NOT NULL,
	iv_hp integer CHECK(iv_hp < 32) CHECK(iv_hp > -1),
	iv_atk integer CHECK(iv_atk < 32) CHECK(iv_atk > -1),
	iv_def integer CHECK(iv_def < 32) CHECK(iv_def > -1),
	iv_satk integer CHECK(iv_satk < 32) CHECK(iv_satk > -1),
	iv_sdef integer CHECK(iv_sdef < 32) CHECK(iv_sdef > -1),
	iv_speed integer CHECK(iv_speed < 32) CHECK(iv_speed > -1),
	ev_hp integer CHECK(ev_hp < 253) CHECK(ev_hp > -1),
	ev_atk integer CHECK(ev_atk < 253) CHECK(ev_atk > -1),
	ev_def integer CHECK(ev_def < 253) CHECK(ev_def > -1),
	ev_satk integer CHECK(ev_satk < 253) CHECK(ev_satk > -1),
	ev_sdef integer CHECK(ev_sdef < 253) CHECK(ev_sdef > -1),
	ev_speed integer CHECK(ev_speed < 253) CHECK(ev_speed > -1),
	move1 integer REFERENCES move(id),
	move2 integer REFERENCES move(id),
	move3 integer REFERENCES move(id),
	move4 integer REFERENCES move(id)
);

