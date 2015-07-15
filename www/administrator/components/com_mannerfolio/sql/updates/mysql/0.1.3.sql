/*
ALTER TABLE `tablename` ADD COLUMN `name` VARCHAR(255) NULL 
*/
ALTER TABLE #__mannerfolio
ADD COLUMN `ordering` int(11) NOT NULL DEFAULT '0';
