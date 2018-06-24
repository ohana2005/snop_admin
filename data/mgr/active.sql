INSERT INTO `config` (`name`, `title`, `section`) VALUES ('smtp_server', 'Smtp server', 'system');
ALTER TABLE quizz_question_answer ADD COLUMN is_correct TINYINT(1);

ALTER TABLE quizz_question ADD COLUMN comment TEXT;
ALTER TABLE `quizz_question` CHANGE `name` `name` TINYTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

ALTER TABLE quizz_take ADD COLUMN questions_count SMALLINT UNSIGNED AFTER info;
ALTER TABLE quizz_take ADD COLUMN correct_answers_count SMALLINT UNSIGNED AFTER questions_count;
ALTER TABLE quizz_take ADD COLUMN percentage SMALLINT UNSIGNED AFTER correct_answers_count;

ALTER TABLE quizz ADD COLUMN created_at DATETIME NOT NULL;
ALTER TABLE quizz ADD COLUMN updated_at DATETIME NOT NULL;
ALTER TABLE quizz ADD COLUMN user_id BIGINT;

ALTER TABLE quizz ADD COLUMN slug VARCHAR(255);

DROP TABLE IF EXISTS user_config_design;
DROP TABLE IF EXISTS user_config_settings;
CREATE TABLE user_config_design (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, header1_color VARCHAR(32), header2_color VARCHAR(32), header3_color VARCHAR(32), header4_color VARCHAR(32), link_color VARCHAR(32), top_background_color VARCHAR(32), top_text_color VARCHAR(32), bottom_background_color VARCHAR(32), bottom_background_color2 VARCHAR(32), bottom_text_color VARCHAR(32), button1_background_color VARCHAR(32), button1_text_color VARCHAR(32), button2_background_color VARCHAR(32), button2_text_color VARCHAR(32), bottom_link_color VARCHAR(32), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE user_config_settings (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, receive_notification_quizz_taken TINYINT(1) DEFAULT '0', top_logo_image VARCHAR(255), logo_text VARCHAR(255), html_title VARCHAR(255), homepage_text TEXT, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;

ALTER TABLE user_config_design ADD COLUMN top_text2_color VARCHAR(32) after top_text_color;
ALTER TABLE user_config_design ADD COLUMN bottom_text2_color VARCHAR(32) after bottom_text_color;
ALTER TABLE user_config_design ADD COLUMN bottom_link_color VARCHAR(32) after bottom_text2_color;
ALTER TABLE user_config_design ADD COLUMN quizz_text_color VARCHAR(32) after bottom_link_color;
ALTER TABLE user_config_design ADD COLUMN quizz_header_color VARCHAR(32) after quizz_text_color;

ALTER TABLE user_config_design ADD COLUMN text_color VARCHAR(32) after link_color;

ALTER TABLE sf_guard_user add column lang VARCHAR(255) DEFAULT 'en' after last_login;

CREATE TABLE text_block_translation (id BIGINT, text TEXT, lang CHAR(2), PRIMARY KEY(id, lang)) ENGINE = INNODB;
ALTER TABLE user_config_settings ADD COLUMN card_info TINYTEXT;
ALTER TABLE user_config_settings ADD COLUMN footer_info VARCHAR(255);
ALTER TABLE user_config_settings ADD COLUMN email VARCHAR(255);
 ALTER TABLE user_config_settings ADD COLUMN phone VARCHAR(255);
  ALTER TABLE user_config_settings ADD COLUMN skype VARCHAR(255);
   ALTER TABLE user_config_settings ADD COLUMN facebook VARCHAR(255);
    ALTER TABLE user_config_settings ADD COLUMN website VARCHAR(255);


###########
    ALTER TABLE user_config_settings ADD COLUMN youtube VARCHAR(255);
         ALTER TABLE user_config_settings ADD COLUMN image VARCHAR(255);


ALTER TABLE quizz_take ADD COLUMN is_backend_viewed TINYINT(1) DEFAULT '0';