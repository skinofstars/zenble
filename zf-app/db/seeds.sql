INSERT INTO albums (artist, title)
VALUES
('Paolo Nutine', 'Sunny Side Up'),
('Florence + The Machine', 'Lungs'),
('Massive Attack', 'Heligoland'),
('Andre Rieu', 'Forever Vienna'),
('Sade', 'Soldier of Love');

INSERT INTO users (username, password, salt, role, date_created)
VALUES ('admin', SHA1('passwordce8d96d579d389e783f95b3772785783ea1a9854'),
  'ce8d96d579d389e783f95b3772785783ea1a9854', 'administrator', NOW());
