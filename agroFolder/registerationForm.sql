CREATE TABLE `registerationForm`.`register` ( `ID` INT(4) NOT NULL AUTO_INCREMENT , `fname` VARCHAR(255) NOT NULL , `lname` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `city` VARCHAR(255) NOT NULL , `state` VARCHAR(255) NOT NULL , `country` VARCHAR(255) NOT NULL , `zip` INT(5) NOT NULL , `mobile` INT(10) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = MyISAM;