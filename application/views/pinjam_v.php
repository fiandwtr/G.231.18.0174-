<?php
echo anchor('pinjam/add_new','Tambah Pinjam');
echo "<br/><br/>";

echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>Nama Mahasiswa</th>
			<th>Judul Buku</th>
			<th>Tgl.Pinjam</th>
			<th>Tgl.Kembali</th>
			<th>Aksi</th>
			</tr>";
$no=0;
foreach($query->result_array() as $row)
{
	$no++;
	$link_edit = anchor('pinjam/edit/'.$row['ID_Pinjam'],'Edit');
	$link_delete = anchor('pinjam/delete/'.$row['ID_Pinjam'],'Hapus');
	
	echo "<tr>
			<td>".$no."</td>
			<td>".$row['Nama']."</td>
			<td>".$row['Judul']."</td>
			<td>".$row['tgl_pinjam']."</td>
			<td>".$row['tgl_kembali']."</td>
			<td>".$link_edit.' '.$link_delete."</td>
		  </tr>";
}
echo "</table>";
?>
<p><?php echo $links; ?></p>

<br/><a href="http://localhost/perpus">Kembali</a>

