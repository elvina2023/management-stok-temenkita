
<?php


class temenkita {

    private $db;


    public function __construct($db = '')
    {
        $this->setConnect($db);
    }


    public function setConnect($db)
    {
        $this->db = $db;
    }
    // supplier
    public function insert_supplier($data){
        $insert_data = "INSERT INTO `d_supplier` SET user_id = ?, nama_supplier = ?, telp_supplier = ?, alamat_supplier = ?, deskripsi_supplier = ?, tanggal = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }

    public function cek_nama_supplier($nama_supplier)
    {
        $check_nama = "SELECT nama_supplier FROM `d_supplier` WHERE nama_supplier = ?";
        $check_nama = $this->db->prepare($check_nama);
        $check_nama->execute([ $nama_supplier ]);

        return $check_nama->rowCount() > 0;
    }

    public function cek_sup($data)
    {
        $check_data = "SELECT id FROM `d_supplier` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->rowCount() > 0;
    }
    public function cek_kategori($data)
    {
        $check_data = "SELECT id FROM `kategori` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->rowCount() > 0;
    }

    public function cek_barang($data)
    {
        $check_data = "SELECT id FROM `packing_items` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->rowCount() > 0;
    }

    public function tampil_data_supplier()
    {
        $select_tampildata = "SELECT * FROM `d_supplier` ORDER BY id ASC";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }
    public function delete_supplier($data)
    {
        $delete_data = "DELETE FROM `d_supplier` WHERE user_id = ? AND id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function fetch_supplier($data)
    {
        $check_data = "SELECT nama_supplier , telp_supplier , alamat_supplier , deskripsi_supplier
        FROM `d_supplier` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->fetch(PDO::FETCH_OBJ);
    }

    public function fetch_kategori($data)
    {
        $check_data = "SELECT nama_kategori, waktu_ditambahkan
        FROM `kategori` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->fetch(PDO::FETCH_OBJ);
    }

    public function fetch_barang($data)
    {
        $check_data = "SELECT nama_item ,kode_item, pack_primer, pack_sekunder, pack_tersier, primer_sekunder, sekunder_tersier
        FROM `packing_items` WHERE user_id = ? AND id = ?";
        $check_data = $this->db->prepare($check_data);
        $check_data->execute($data);

        return $check_data->fetch(PDO::FETCH_OBJ);
    }

    public function update_supplier($data)
    {
        $update_data = "UPDATE `d_supplier` SET nama_supplier = ?, telp_supplier = ?, alamat_supplier = ?, deskripsi_supplier = ? WHERE user_id = ? AND id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }
    // sup finish

    // kategori
    public function tampil_data_kategori()
    {
        $select_tampildata = "SELECT * FROM `kategori` ORDER BY id ASC";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }

    public function insert_kategori($data){
        $insert_data = "INSERT INTO `kategori` SET user_id = ?, nama_kategori = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }

    public function cek_nama_kategori($nama_kategori)
    {
        $check_nama = "SELECT nama_kategori FROM `kategori` WHERE nama_kategori = ?";
        $check_nama = $this->db->prepare($check_nama);
        $check_nama->execute([ $nama_kategori ]);

        return $check_nama->rowCount() > 0;
    }

   
    public function update_kategori($data)
    {
        $update_data = "UPDATE `kategori` SET nama_kategori = ? WHERE user_id = ? AND id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }
    
    public function update_barang($data)
    {
        $update_data = "UPDATE `packing_items` SET nama_item = ?,kode_item = ? , pack_primer = ?, pack_sekunder = ?, pack_tersier = ?, primer_sekunder = ?, sekunder_tersier = ?
        WHERE user_id = ? AND id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function delete_kategori($data)
    {
        $delete_data = "DELETE FROM `kategori` WHERE user_id = ? AND id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }

    public function delete_kategori_stokout($data)
    {
        $delete_data = "DELETE FROM `temp_stok_out` WHERE user_id = ? AND kategori_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_kategori_stokT($data)
    {
        $delete_data = "DELETE FROM `stok_tersier` WHERE user_id = ? AND kategori_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_kategori_stokS($data)
    {
        $delete_data = "DELETE FROM `stok_sekunder` WHERE user_id = ? AND kategori_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_kategori_stokP($data)
    {
        $delete_data = "DELETE FROM `stok_primer` WHERE user_id = ? AND kategori_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_kategori_stokin($data)
    {
        $delete_data = "DELETE FROM `stok_in` WHERE user_id = ? AND kategori_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
// set delete barang
    public function delete_barang_frompack($data)
    {
        $delete_data = "DELETE FROM `packing_items` WHERE user_id = ? AND id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_barang_stokout($data)
    {
        $delete_data = "DELETE FROM `temp_stok_out` WHERE user_id = ? AND item_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_barang_stokT($data)
    {
        $delete_data = "DELETE FROM `stok_tersier` WHERE user_id = ? AND item_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_barang_stokS($data)
    {
        $delete_data = "DELETE FROM `stok_sekunder` WHERE user_id = ? AND item_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_barang_stokP($data)
    {
        $delete_data = "DELETE FROM `stok_primer` WHERE user_id = ? AND item_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    public function delete_barang_stokin($data)
    {
        $delete_data = "DELETE FROM `stok_in` WHERE user_id = ? AND item_id = ?";
        $delete_data = $this->db->prepare($delete_data);
        $delete_data->execute($data);

        return $delete_data;
    }
    // kategori finish

    // barang :x
    public function tampil_data_barang1()
    {
        $select_tampildata = "SELECT * FROM `packing_items` ORDER BY id ASC";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }

    public function tampil_data_barang_out()
    {
        $select_tampildata = "SELECT * FROM `temp_stok_out` ORDER BY id ASC";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }

    public function tampil_data_barang_khusus($data)
    {
        $select_tampildata = "SELECT * FROM `packing_items` WHERE kategori_id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([ $data ]);

        return $select_tampildata;
        
    }
    public function tampil_data_barang_khusus2($data)
    {
        $select_tampildata = "SELECT * FROM `packing_items` WHERE id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([ $data ]);

        return $select_tampildata;
        
    }

    public function tampil_harga_sebelum($data)
    {
        $select_tampildata = "SELECT * FROM `stok_in` WHERE item_id = ?, packing = ?, kategori_id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([ $data ]);

        return $select_tampildata;
        
    }

    public function tampil_data_primer()
    {
        $select_tampildata = "SELECT * FROM `stok_primer` ";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
    }

    public function tampil_data_sekunder()
    {
        $select_tampildata = "SELECT * FROM `stok_sekunder`";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }

    public function tampil_data_tersier()
    {
        $select_tampildata = "SELECT * FROM `stok_tersier`";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
        
    }
    public function jml_awal_tersier($data)
    {
        $select_tampildata = "SELECT jumlah FROM `stok_tersier` WHERE 'item_id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([$data]);

        return $select_tampildata;
        
    }


    public function cek_kode_barang($kode_barang)
    {
        $check_nama = "SELECT kode_item FROM `packing_items` WHERE kode_item = ?";
        $check_nama = $this->db->prepare($check_nama);
        $check_nama->execute([ $kode_barang ]);

        return $check_nama->rowCount() > 0;
    }

    public function insert_barang_baru($data){
        $insert_data = "INSERT INTO `packing_items` SET user_id = ?, kategori_id = ?, nama_item = ?, kode_item = ?, pack_primer = ?, pack_sekunder = ?, pack_tersier = ?, primer_sekunder = ?, sekunder_tersier = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }

    public function insert_stok_in($data){
        $insert_data = "INSERT INTO `stok_in` SET user_id = ?, kategori_id = ?,  item_id = ?, packing = ?, jumlah = ?, supplier_id = ?, harga_beli = ?, harga_jual = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }
    
    public function insert_stok_out($data){
        $insert_data = "INSERT INTO `temp_stok_out` SET user_id = ?, kategori_id = ?,  item_id = ?, packing = ?, jumlah = ?, total = ?, nota_no = ?, metode_bayar = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }


    public function insert_stok_primer($data){
        $insert_data = "INSERT INTO `stok_primer` SET user_id = ?, kategori_id = ?, item_id = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }

    public function get_primer_sekunder($data){
        $select_tampildata = "SELECT primer_sekunder FROM `packing_items` WHERE id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([ $data ]);

        return $select_tampildata;
    }

    public function get_sekunder_tersier($data){
        $select_tampildata = "SELECT sekunder_tersier FROM `packing_items` WHERE id = ?";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute([ $data ]);

        return $select_tampildata;
    }
    public function update_stok_primer($data)
    {
        $update_data = "UPDATE `stok_primer` SET  jumlah = ?, harga = ? , harga_jual = ? WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }
    public function update_stok_primer_out($data)
    {
        $update_data = "UPDATE `stok_primer` SET  jumlah = ? WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function insert_stok_sekunder($data){
        $insert_data = "INSERT INTO `stok_sekunder` SET user_id = ?, kategori_id = ?, item_id = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }

    public function update_stok_sekunder_out($data)
    {
        $update_data = "UPDATE `stok_sekunder` SET  jumlah = ? WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function update_stok_sekunder($data)
    {
        $update_data = "UPDATE `stok_sekunder` SET  jumlah = ?, harga = ?, harga_jual = ? WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function insert_stok_tersier($data){
        $insert_data = "INSERT INTO `stok_tersier` SET user_id = ?, kategori_id = ?, item_id = ?";
        $insert_data = $this->db->prepare($insert_data);
        $insert_data->execute($data);

        return $insert_data;
    }
    public function update_stok_tersier($data)
    {
        $update_data = "UPDATE `stok_tersier` SET  jumlah = ?, harga = ?, harga_jual = ?  WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function update_stok_tersier_out($data)
    {
        $update_data = "UPDATE `stok_tersier` SET  jumlah = ? WHERE item_id = ?  AND user_id = ? AND kategori_id = ?";
        $update_data = $this->db->prepare($update_data);
        $update_data->execute($data);

        return $update_data;
    }

    public function tampil_nomor_nota()
    {
        $select_tampildata = "SELECT * FROM `stok_out` ";
        $select_tampildata = $this->db->prepare($select_tampildata);
        $select_tampildata->execute();

        return $select_tampildata;
    }

    


}


?>