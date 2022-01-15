<?php
echo anchor('buku/add_new','Tambah Buku');
echo "<br><br>";

echo"<table border='1'>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>";

    $no=0;
    foreach($query->result_array() as $row)
    {
        $no++;
        $kategori       =$row['Kategori'];
        $link_edit      =anchor('buku/edit/'.$row['ID_Buku'],'Edit');
        $link_delete    =anchor('buku/delete/'.$row['ID_Buku'],'Hapus',"onclick='return confirm(\"Yakin?\")'");
        //menampilkan data
        echo"<tr>
                <td>".$no."</td>
                <td>".$row['Judul']."</td>
                <td>".$row['Pengarang']."</td>
                <td>".$opt_kategori[$kategori]."</td>
                <td>".$link_edit.' | '.$link_delete."</td>
            </tr>";
    }
    echo"</table>";
?>    
<!-- Menampilkan paging -->
<p><?php echo $links; ?></p>

<br/><a href="http://localhost/perpus">Kembali</a>