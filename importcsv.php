<html>
<head>
<title>Upload / import file csv ke Mysql dengan PHP</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pencarian sederhana dengan PHP, MySQL dan Bootstrap">
    <meta name="author" content="">

    <title>Pencarian sederhana dengan PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="img/fav-icon.png">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.acchoblues.blogspot.com"> Hakko Blog's</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.acchoblues.blogspot.com">Tutorial</a></li>
            <li><a href="http://www.acchoblues.blogspot.com">Pemrograman</a></li>
            <li><a href="http://www.acchoblues.blogspot.com">Template</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<?php
//membuat koneksi ke database
mysql_connect('localhost','root','');
mysql_select_db('dbst');
 
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script upload file csv..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file ke Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $import="INSERT into tbsoal (Id,Kategori,Soal) values('$data[0]','$data[1]','$data[2]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysql_query($import) or die(mysql_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
}else { //Jika belum menekan tombol upload, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->

<div class="container" style="margin-top: 60px;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Data Soal</h3>
        </div>
            <div class="panel-body">
            <b>Silahkan masukan file csv yang ingin diupload</b><br /> 
                <form enctype='multipart/form-data' action='' method='post'>
                   <strong>Cari CSV File anda:</strong><br />
                    <input type='file' name='filename' size='100' class="form-control" required="" /><br />
                    <input type='submit' name='submit' value='Upload' class="btn btn-primary btn-sm" />
                </form>
            </div>
    </div>
</div>
<?php } mysql_close(); //Menutup koneksi SQL?>
</body>
</html><br><br><br>