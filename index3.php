[php]
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=dataprocessing.xls");

// Tambahkan table
include ‘index.php’;
?>
[/php]
<?php 
session_start(); //memulai session
?>
<?php 
session_start(); //memulai session
?>
<html>
<head>
<title>Session POST</title>
<style type="text/css">
	label.txt{
		font:normal 12px Tahoma,Verdana;
		display:block;
		color:#666666;
		text-transform:uppercase;
	}
</style>
</head>
<body>
<?php
if(isset($_POST['btn'])):
	//membuat session array dengan variabel - variabel POST
	$_SESSION['pos']=$_POST;
endif;

if(isset($_SESSION['pos'])):
	$id   =$_SESSION['pos']['Id'];
	$Soal =$_SESSION['pos']['Soal'];

else:
	$id   ='';
	$soal ='';
endif;
?>
<form method="post" name="frm" action="">
	<input type="text" name="nama" value="<?php echo $id; ?>" />
	<label class="txt">Soal</label>
	<textarea name="alamat"> <?php echo $Soal;?> </textarea>

	<br />
	<input type="submit" name="btn" value="Submit" />
</form>

</body>
</html>
