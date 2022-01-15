<?php
	if(!empty($query))
	{
		$row=$query->row_array();
	}
	else
	{
		$row['ID_Pinjam'] 	= '';
		$row['ID_Anggota'] 		= '';
		$row['ID_Buku'] 	= '';
		$row['tgl_pinjam'] 	= '';
		$row['tgl_kembali'] 	= '';
	}
	/*
	echo "<pre>";
	print_r($row);
	echo "</pre>";
	*/
	echo "<h2>Form Pinjam Buku</h2>";
	
	// -- tambahan & modifikasi
	echo validation_errors();
	
	echo form_open('pinjam/save/');
	echo form_hidden('id',set_value('id',$row['ID_Pinjam']));
	echo form_hidden('is_update',$is_update);
	
	echo "Anggota : ".form_dropdown('ID_Anggota',$anggota,$row['ID_Anggota']);
	echo "<br/><br/>";
	echo "Buku : ".form_dropdown('ID_Buku',$buku,$row['ID_Buku']);
	echo "<br/><br/>";
	$data=array(
              'name'	=> 'tgl_pinjam',
              'type'    => 'date',
			  'value'	=> $row['tgl_pinjam']
        );
	echo "Tgl.Pinjam : ".form_input($data);
	echo "<br/><br/>";
	$data=array(
              'name'	=> 'tgl_kembali',
              'type'    => 'date',
			  'value'	=> $row['tgl_kembali']
        );
	echo "Tgl.Kembali : ".form_input($data);
	echo "<br/><br/>";
	echo form_submit('btn_simpan','Simpan');
	echo form_reset('btn_batal','Batal');
	echo form_close();
?>
<br/><a href="http://localhost/perpus/index.php/pinjam">Kembali</a>
