ALTER TABLE `#__schedule_event` ADD `article_id` INT NOT NULL AFTER `title`
ALTER TABLE `#__schedule_event` ADD `group_id` INT NOT NULL AFTER `group_id`
ALTER TABLE `#__schedule_event` ADD `record` BOOLEAN NOT NULL default 0 AFTER 'record' 