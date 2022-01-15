<?php
if(!empty($query))
{   //kalau ada data atau perintah edit data
    $row=$query->row_array();
}else{
    //kalau status menambahkan data baru
    $row['ID_Buku']     ="";
    $row['Judul']       ="";
    $row['Pengarang']   ="";
    $row['Kategori']    ="";
}

//menampilkan error validasi 
echo validation_errors();
echo form_open('buku/check');
echo form_hidden('id',set_value('id',$row['ID_Buku']));
echo form_hidden('is_update',$is_update);

echo "Judul : ".form_input('judul',set_value('Judul',$row['Judul']),"size='50' maxlength='100'");

echo "<br/><br/>";
echo "Pengarang : ".form_input('pengarang',set_value('Pengarang',$row['Pengarang']),"size='50' maxlength='150'");

echo "<br/><br/>";
echo "Kategori : ".form_dropdown('kategori',$opt_kategori,set_value('Kategori',$row['Kategori']));

echo "<br/><br/>";
echo form_submit('btn_simpan','Simpan');
echo form_close();
?>

<br/><a href="http://localhost/perpus">Kembali</a>