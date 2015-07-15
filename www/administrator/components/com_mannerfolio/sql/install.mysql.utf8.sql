DROP TABLE IF EXISTS #__mannerfolio_cat;

CREATE TABLE #__mannerfolio_cat (
id int(10) NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
alias varchar(255) NOT NULL,
state tinyint(3) NOT NULL,
PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS #__mannerfolio;

CREATE TABLE #__mannerfolio (
id int(10) NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
alias varchar(255) NOT NULL,
state tinyint(3) NOT NULL,
professio varchar(255) NOT NULL,
intodesc mediumtext NOT NULL,
fulldesc mediumtext,
created datetime NOT NULL,
catid int(10) NOT NULL,
image varchar(255) NOT NULL,
PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

