/*
ALTER TABLE `tablename` ADD COLUMN `name` VARCHAR(255) NULL 
*/
ALTER TABLE #__mannerfolio
ADD COLUMN `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0';
