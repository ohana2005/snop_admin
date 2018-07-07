ALTER TABLE booking ADD COLUMN is_backend_viewed TINYINT(1) DEFAULT '0';
ALTER TABLE booking ADD COLUMN payment_status VARCHAR(255) DEFAULT 'nopayment' AFTER hash;
ALTER TABLE booking ADD COLUMN lang VARCHAR(2) AFTER payment_status;