CREATE TABLE IF NOT EXISTS albums (
  id int(11) NOT NULL auto_increment,
  artist varchar(100) NOT NULL,
  title varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  salt varchar(50) NOT NULL,
  role varchar(50) NOT NULL,
  date_created datetime NOT NULL,
  PRIMARY KEY (id)
)
