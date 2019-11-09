
<html>
<head>
    <title>Upload page</title>
    <!-- Favicon -->
    <link rel="icon" href="img/fav-icon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<form method="POST" action="index.php">
<input type="submit" value="Index Dan Klasifikasi" />
</form>
<form method="POST" action="hapus.php">
<input type="submit" value="Hapus" />
</form>
<body>
<?php
//KONEKSI.. 
//("localhost","id11383888_root","227252","id11383888_dbst");
 
$host='localhost';
$username='id11383888_root';
$password='227252';
$database='id11383888_dbst';
mysql_connect($host,$username,$password);
mysql_select_db($database);
 
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script Upload File..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file to Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into tbsoal (Id','Kategori','Soal) values(NULL,'$data[0]','$data[1]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol submit, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->
   Silahkan masukan file csv yang ingin diupload<br /> 
   <form enctype='multipart/form-data' action='' method='post'>
    Cari CSV File anda:<br />
    <input type='file' name='filename' size='100'>
   <input type='submit' name='submit' value='Upload'></form>
 
<?php } mysql_close(); //Menutup koneksi SQL?>

</body>
</html><br><br><br>