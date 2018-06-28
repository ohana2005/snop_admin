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