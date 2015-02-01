-- Lisää INSERT INTO lauseet tähän tiedostoon


INSERT INTO move(name, type, category, power, accuracy, pp, description)
VALUES	('Test Move', 'Normal', 'Physical', 50, 100, 35, 'This is a test description'),
('Test Move 2', 'Flying', 'Special', 10, 80, 10, 'aaaaaaaaaaaaaaaaaaaaaaaa');

INSERT INTO species(name, dexno, type1, type2, ability1, ability2, hability1, hability2,
base_hp, base_atk, base_def, base_satk, base_sdef, base_speed)
VALUES ('Test Species', 1700, 'Fire', 'Water', 'Pickup', NULL, NULL, NULL, 10, 20, 30, 40, 50, 60),
('Test Species 2', 1880, 'Normal', NULL, 'Levitate', NULL, 'Sand Veil', NULL, 11, 22, 33, 44, 55, 66);

INSERT INTO moves_of_species(move_id, species_id)
VALUES ((SELECT id from move WHERE name='Test Move'), (SELECT id from species WHERE name='Test Species')),
((SELECT id from move WHERE name='Test Move 2'), (SELECT id from species WHERE name='Test Species')),
((SELECT id from move WHERE name='Test Move 2'), (SELECT id from species WHERE name='Test Species 2'));

INSERT INTO patron(name, password)
VALUES ('UserName', 'SecretPassword');

INSERT INTO pokemon(user_id, species_id, nickname, gender, ability, iv_hp, iv_atk, iv_def, iv_satk, iv_sdef, iv_speed,
ev_hp, ev_atk, ev_def, ev_satk, ev_sdef, ev_speed, move1, move2, move3, move4)
VALUES ((SELECT id from patron WHERE name='UserName'), (SELECT id from species WHERE name='Test Species'), 'nicky',
'Male', (SELECT ability1 from species WHERE name='Test Species'), NULL, NULL, NULL, 20, NULL, NULL, NULL, 150, NULL, NULL, NULL, NULL,
(SELECT id from move WHERE name='Test Move'), NULL, NULL, NULL);
