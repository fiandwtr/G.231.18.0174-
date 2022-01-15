<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Perpustakaan</title>
</head>
<body>
	<h1>Selamat datang <?php echo $username; ?></h1>
	<h2>Aplikasi Perpustakaan FTIK USM</h2>
	<b>Pilihan menu :</b>
	<ol>
		<li><a href="<?=base_url('index.php/buku');?>">Kelola data buku</a></li>
		<li><a href="<?=base_url('index.php/anggota');?>">Kelola data anggota</a></li>
		<li><a href="<?=base_url('index.php/pinjam'); ?>">Kelola Transaksi Pinjam</a></li>
	</ol>
	<a href="<?=base_url('index.php/perpus/logout'); ?>">Logout</a>
</body>
</html>

