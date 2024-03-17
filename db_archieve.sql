CREATE TABLE IF NOT EXISTS `stok_masuk_items` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `nama_item` varchar(150) NOT NULL,
    `kode_item` varchar(150) NOT NULL,
    `packing` varchar(150) NOT NULL,
    `jml pack` int NOT NULL,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`)
            ON DELETE CASCADE
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `live_stok` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `nama_item` varchar(150) NOT NULL,
    `kode_item` varchar(150) NOT NULL,
    `jml_pack_primer` int NOT NULL,
    `jml_pack_sekunder` int,
    `jml_pack_tersier` int,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
            ON DELETE CASCADE
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;



ALTER TABLE `stok_primer_items` ADD `harga` int NOT NULL; 



CREATE TABLE IF NOT EXISTS `stok_primer` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `jumlah` int,
    `harga` int,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `stok_sekunder` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `jumlah` int,
    `harga` int,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `stok_tersier` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `jumlah` int,
    `harga` int,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `stok_in` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `packing` int NOT NULL,
    `jumlah` int,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `stok_out` (
    `id` int NOT NULL AUTO_INCREMENT,
    `no_nota` int NOT NULL,
    `total` int NOT NULL,
    `metode_pembayaran` varchar(150) NOT NULL,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `d_stok_out` (
    `id` int NOT NULL AUTO_INCREMENT,
    `no_nota` int NOT NULL,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `packing` int NOT NULL,
    `jumlah` int NOT NULL,
    `harga` int NOT NULL,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

ALTER TABLE `packing_items` 
ADD `stok_primer` int,
`stok_sekunder` int,
`stok_tersier` int,
`harga_primer` int,
`harga_sekunder` int,
`harga_tersier` int
; 

CREATE TABLE IF NOT EXISTS `temp_stok_out` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `kategori_id` int NOT NULL,
    `item_id` int NOT NULL,
    `packing` int NOT NULL,
    `total` int NOT NULL,
    `nota_no` int NOT NULL,
    `metode_bayar` varchar(150) NOT NULL,
    `waktu_ditambahkan` timestamp DEFAULT current_timestamp(),
    `is_deleted` boolean NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`)
        REFERENCES `user_admin` (`id`),
    FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori` (`id`),
    FOREIGN KEY (`item_id`)
        REFERENCES `packing_items` (`id`)
) Engine = InnoDB CHARSET=utf8mb4 AUTO_INCREMENT=1;

ALTER TABLE `temp_stok_out` 
ADD `jumlah` int;

ALTER TABLE `stok_primer` 
ADD `harga_jual` int;

ALTER TABLE `stok_primer` 
ADD `supplier_id` int;

ALTER TABLE `stok_primer` 
ADD CONSTRAINT
FOREIGN key (`supplier_id`)
REFERENCES `d_supplier` (`id`);

ALTER TABLE `stok_sekunder` 
ADD `harga_jual` int;

ALTER TABLE `stok_sekunder` 
ADD `supplier_id` int;

ALTER TABLE `stok_sekunder` 
ADD CONSTRAINT
FOREIGN key (`supplier_id`)
REFERENCES `d_supplier` (`id`);

ALTER TABLE `stok_tersier` 
ADD `harga_jual` int;

ALTER TABLE `stok_tersier` 
ADD `supplier_id` int;

ALTER TABLE `stok_tersier` 
ADD CONSTRAINT
FOREIGN key (`supplier_id`)
REFERENCES `d_supplier` (`id`);

ALTER TABLE `packing_items`
ADD `supplier_id` int;
ALTER TABLE `packing_items` 
ADD CONSTRAINT
FOREIGN key (`supplier_id`)
REFERENCES `d_supplier` (`id`);


ALTER TABLE `stok_in` 
ADD `supplier_id` int,
 `harga_jual` int,
 `harga_beli` int
;
