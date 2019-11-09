<head>
<title>:: Damas Mahardi :: Proses Text Mining::</title>
 <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
	
	<!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <!-- Favicon -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#4e8ef7">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
<?php
//membuat koneksi ke database

include 'koneksi.php';
if (isset($_POST['submit'])) {//Script akan berjalan jika di tekan tombol submit..
 
//Script upload file csv..
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." Berhasil di Upload" . "</h1>";
        echo "<h2>Menampilkan Hasil Upload:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }
 
    //Import uploaded file ke Database, Letakan dibawah sini..
    $handle = fopen($_FILES['filename']['tmp_name'], "r"); //Membuka file dan membacanya
    while (($data = fgetcsv($handle, 18749194250000, ",")) !== FALSE) {
	$import="INSERT into tbsoal (Id,Kategori,Soal) values('$data[0]','$data[1]','$data[2]')"; //data array sesuaikan dengan jumlah kolom pada CSV anda mulai dari “0” bukan “1”
        mysqli_query($import) or die(mysqli_error()); //Melakukan Import
    }
 
    fclose($handle); //Menutup CSV file
    echo "<br><strong>Import data selesai.</strong>";
    
} else { //Jika belum menekan tombol upload, form dibawah akan muncul.. ?>
 
<!-- Form Untuk Upload File CSV-->
<div class="container">
    <div class="topnav" id="myTopnav">
        <a href="index.php">Beranda</a>
        <a class="active-1" href="proses.php?act=corpus">Opini</a>
        <a class="active-2" href="proses.php?act=indexing">Preprocessing</a>
        <a class="active-3" href="proses.php?act=bobot">Hitung TF</a>
        <a class="active-4" href="proses.php?act=showindex">Tampilkan Index</a>
        <a href="retrieve.php">Retrieval</a>
        <a class="active-5" href="proses.php?act=cache">Eksport data</a>
        <a class="active-6" href="index3.php?act=update">save update data train dan tes</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Data Opini Tingkat Kepuasan</h3>
        </div>
        <div class="panel-body">
        <b>Silahkan masukan file csv yang ingin diupload</b><br /> 
            <form enctype='multipart/form-data' action='' method='post'>
            <strong>Cari CSV File anda:</strong><br />
                <input type='file' name='filename' size='18749194250' class="form-control" required="" /><br />
                <input type='submit' name='submit' value='Upload' class="btn btn-primary btn-sm" />
            </form>
        </div>
    </div>
    <div>
    <?php

include("koneksi.php");
include 'fungsi.php';
error_reporting(0);
//periksa apa yang diinginkan pengguna (variabel act)
$apa = $_GET["act"];
//jika "corpus"
 
if ($apa == "corpus") {
    print('
        <style> 
            .active-1 {
                background-color: #FFC0CB;
                color: #ffffff;
            }
        </style>
     ');
    
    $row=0;
    $result = mysqli_query($koneksi, "SELECT * FROM tbsoal ORDER BY Id ");
    while($row = mysqli_fetch_array($result)) {
        echo $row['Id'] . ". <font color =red>". $row['Kategori'] . "</font><br />" . $row['Soal'];
        echo "<hr />";

        $row++;
    }
}
//jika delete

//jika "cari"
else if ($apa == "cari") {
cari("aba");
print("<hr />");
} 
//jika "indexing"
else if ($apa == "indexing") {
    print('
        <style> 
            .active-2 {
                background-color: #FFC0CB;
                color: #ffffff;
            }
        </style>
     ');
buatindex();
print("<hr />");
} 
else if ($apa == "bobot") {
    print('
        <style> 
            .active-3 {
                background-color: #FFC0CB;
                color: #ffffff;
            }
        </style>
     ');
hitungbobot();
print("<hr />");
} 
else if ($apa == "probabilitas P(vj)") {
probabilitas();
print("<hr />");
}
else if ($apa == "panjangvektor") {
panjangvektor();
print("<hr />");
}
else if ($apa == "showvektor") {
print("<table>");
print("<tr><td>Doc-ID</td><td>Panjang Vektor</td></tr>");
$result = mysqli_query("SELECT * FROM tbvektor");
while($row = mysqli_fetch_array($result)) {
print("<tr>");
print("<td>" . $row['DocId'] . "</td><td>"
. $row['Panjang'] . "</td>");
print("</tr>");
}
print("</table><hr />");
}
//jika "showindex"
else if ($apa == "showindex") {
    print('
        <style> 
            .active-4 {
                background-color: #FFC0CB;
                color: #ffffff;
            }
        </style>
     ');

print("<table 
        border='1'
        style='
        position: relative;
        width : 100%;
        margin : auto;
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse;
        width: 80%;
        text-align: center;'>");
print("
<tr>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>#</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Term</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Doc-ID</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Count</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Bobot</th>
</tr>");
$result = mysqli_query($koneksi, "SELECT * FROM tbindex ORDER BY Id");
while($row = mysqli_fetch_array($result)) {

print("<tr>");
print("
    <td style='position:relative; padding-bottom: 20px;'>". $row['Id'] . "</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['Term'] . "</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['DocId'] ."</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['Count']. "</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['Bobot'] . "</td>");
print("</tr>");

}
print("</table><hr />");
}
//show probabilitas

//jika "retrieve"
else if ($apa == "retrieve") {
print('<center><form action="proses.php?act=retrieve" method="post">
Kata kunci: <input type="text" name="keyword" />
<input name = "Cari!" type="submit" />
</form></center><hr />');
$keyword = $_POST["keyword"];
if ($keyword) {
$keyword = preproses($keyword);
print('Hasil retrieval untuk <font color=blue><b>' .
$_POST["keyword"] . '</b></font> (<font color=blue><b>'
. $keyword . '</b></font>) adalah <hr />');
ambilcache($keyword);
}
} 
//jika klasifikasi


//end retrievel
//jika "cache"
else if ($apa == "cache") {
    print('
        <style> 
            .active-5 {
                background-color: #FFC0CB;
                color: green;
            }
        </style>
     ');

    print('<div align=center>');
    print('<p>
                <a href="export.php">
                    <button>Export Data ke Excel</button>
                </a>
                <a href="export.php">
                    <button>klasifikasi</button>
                </a>
            </p>
        ');
    print('</div>');
// print("<table>");
print("<table 
    border='1'
    style='
    position: relative;
    width : 100%;
    margin : auto;
    font-family: sans-serif;
    color: #444;
    // background-color : #000000;
    border-collapse: collapse;
    width: 80%;
    text-align: center;'>");
// print("<tr><td>#</td><td>Query</td><td>Doc-ID</td>
// <td>Value</td></tr>");
print("
<tr>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>#</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Query</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Doc-ID</th>
    <th style='
        position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;'>Value</th>
</tr>");
$result = mysqli_query($koneksi, "SELECT * FROM tbcache ORDER BY Query ASC");
while($row = mysqli_fetch_array($result)) {
// print("<tr>");
// print("<td>" . $row['Id'] . "</td><td>"
// . $row['Query'] . "</td><td>" . $row['DocId'] .
// "</td><td>" . $row['Value'] . "</td>");
// print("</tr>");
print("<tr>");
print("
    <td style='position:relative; padding-bottom: 20px;'>". $row['Id'] . "</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['Query'] . "</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['DocId'] ."</td>
    <td style='position:relative; padding-bottom: 20px;'>". $row['Value']. "</td>");
print("</tr>");
}
print("</table><hr />");
}
//jika beranda atau tidak memilih apapun
else {
print("<p align=center>Pilih salah satu link di atas!</p><hr />");
}

?>    
    </div>
</div>
<?php 
} mysqli_close($koneksi); //Menutup koneksi SQL?>

<h5 align=center> Damas Mahardi </h5>
</body>

<style>

/* Add a black background color to the top navigation */
.topnav {
    background-color:   blue;
    overflow: hidden;
  }

  /* Style the links inside the navigation bar */
  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  /* Change the color of links on hover */
  .topnav a:hover {
    background-color: gray;
    color: white;
  }

  /* Add an active class to highlight the current page */
  .topnav a.active {
    background-color: salmon;
    color: white;
  }

  /* Hide the link that should open and close the topnav on small screens */
  .topnav .icon {
    display: none;
  }

</style>