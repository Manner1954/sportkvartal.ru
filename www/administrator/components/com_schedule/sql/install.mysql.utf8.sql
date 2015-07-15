CREATE TABLE IF NOT EXISTS #__schedule_day(
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  published TINYINT(1) NOT NULL DEFAULT 1,
  ordering INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_event(
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  article_id INT(11) NOT NULL,
  ordering INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_field(
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL,
  value VARCHAR(255) NOT NULL,
  published TINYINT(1) NOT NULL DEFAULT 1,
  ordering INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_field_value(
  id INT(11) NOT NULL AUTO_INCREMENT,
  event_id INT(11) NOT NULL,
  field_id INT(11) NOT NULL,
  value TEXT NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_line(
  id INT(11) NOT NULL AUTO_INCREMENT,
  line_time TIME NOT NULL DEFAULT '00:00:00',
  published TINYINT(1) NOT NULL DEFAULT 1,
  ordering INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_schedule(
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  title VARCHAR(255) NOT NULL,
  ordering INT(11) NOT NULL DEFAULT 1,
  published TINYINT(1) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX name (name)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_summary(
  id INT(11) NOT NULL AUTO_INCREMENT,
  schedule_id INT(11) NOT NULL,
  day_id INT(11) NOT NULL DEFAULT 0,
  line_id INT(11) NOT NULL,
  event_id INT(11) NOT NULL,
  published TINYINT(1) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS #__schedule_group(
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  published TINYINT(1) NOT NULL DEFAULT 1,
  ordering INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;