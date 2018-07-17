ALTER TABLE hotel ADD COLUMN apihash VARCHAR(40) AFTER name;

ALTER TABLE room_occupancy_entity ADD COLUMN booking_id BIGINT after hotel_id;
ALTER TABLE room_occupancy_entity ADD INDEX booking_id_idx (booking_id);
ALTER TABLE room_occupancy ADD INDEX booking_id_idx (booking_id);

ALTER TABLE package_item ADD COLUMN per_period VARCHAR(255) AFTER name;
ALTER TABLE package_item ADD COLUMN  per_person VARCHAR(255) after per_period;
ALTER TABLE package_item ADD COLUMN  is_discount TINYINT(1) UNSIGNED;

ALTER TABLE package ADD COLUMN min_stay SMALLINT UNSIGNED DEFAULT 1 AFTER description;
ALTER TABLE package ADD COLUMN  max_stay SMALLINT UNSIGNED DEFAULT 99 AFTER min_stay;
ALTER TABLE package ADD COLUMN  min_adults SMALLINT UNSIGNED DEFAULT 1 AFTER max_stay;
ALTER TABLE package ADD COLUMN   max_adults SMALLINT UNSIGNED DEFAULT 99 AFTER min_adults;
ALTER TABLE package ADD COLUMN    min_children SMALLINT UNSIGNED DEFAULT 0 AFTER max_adults;
ALTER TABLE package ADD COLUMN     max_children SMALLINT UNSIGNED DEFAULT 99 after min_children;


ALTER TABLE booking ADD COLUMN      summary TEXT after price;
ALTER TABLE booking ADD COLUMN       hash VARCHAR(40) after summary;

ALTER TABLE hotel ADD COLUMN       admin_lang VARCHAR(10) DEFAULT 'en' after apihash;
ALTER TABLE hotel ADD COLUMN       booking_langs VARCHAR(255) DEFAULT 'en' after admin_lang;


ALTER TABLE hotel_config ADD COLUMN is_hidden TINYINT(1) DEFAULT '0';

ALTER TABLE booking ADD COLUMN is_backend_viewed TINYINT(1) DEFAULT '0';
ALTER TABLE booking ADD COLUMN payment_status VARCHAR(255) DEFAULT 'nopayment' AFTER hash;

ALTER TABLE booking ADD COLUMN lang VARCHAR(2) AFTER payment_status;

ALTER TABLE hotel_config ADD COLUMN created_at DATETIME NOT NULL;

ALTER TABLE hotel_config ADD COLUMN  updated_at DATETIME NOT NULL;