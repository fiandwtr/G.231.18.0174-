<?php
echo anchor('anggota/add_new','Tambah anggota');
echo "<br/><br/>";

echo "<table border='1'>
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Progdi</th>
			<th>Aksi</th>
			</tr>";
$no=0;
foreach($query->result_array() as $row)
{
	$no++;
	$progdi = $row['progdi'];
	$link_edit = anchor('anggota/edit/'.$row['ID_Anggota'],'Edit');
	$link_delete = anchor('anggota/delete/'.$row['ID_Anggota'],'Hapus',"onclick='return confirm(\"Yakin?\")'");
	
	echo "<tr>
			<td>".$no."</td>
			<td>".$row['nim']."</td>
			<td>".$row['nama']."</td>
			<td>".$opt_progdi[$progdi]."</td>
			<td>".$link_edit.' '.$link_delete."</td>
		  </tr>";
}
echo "</table>";
?>
<!-- Menampilkan paging -->
<p><?php echo $links; ?></p>

<br/><a href="http://localhost/perpus">Kembali</a>