<!DOCTYPE html>
<html lang="en">
<head>
  <title>Damas Maahardi | Retrive Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <meta name="theme-color" content="#4e8ef7">
  <link rel="stylesheet" href="CSS/style6.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
  <div class="topnav" id="myTopnav">
    <a href="index.php">Beranda</a>
    <a href="proses.php?act=corpus">Opini</a>
    <a href="proses.php?act=indexing">Preprocessing</a>
    <a href="proses.php?act=bobot">Hitung TF</a>
    <a href="proses.php?act=showindex">Tampilkan Index</a>
    <a class="active" href="retrieve.php">Retrieval</a>
    <a href="proses.php?act=cache">Eksport data</a>
    <a href="index3.php?act=update">save update data train dan tes</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>

  <div class="content">
    <br></br>
    <div class="text-title">
      <img class="image-icon" src="images/cari3.jpeg" alt="logo" width="1200px" height="300px" >
    </div>
    <form action="retrieve.php" method="post">
      <br></br>
      <br></br>
      <br></br>
      <div class="form-group">
        <input type="text" placeholder="Masukan Kata disini..," class="form-control" name="keyword">
      </div>
      <div class="btn-search">
        <button class="btn btn-primary" type="submit">
          <b>Cari</b> 
        </button>
      </div>
    </form>

    <div class="result">
      <?php
        include 'koneksi.php';
        include 'fungsi.php';
        error_reporting(0);
        $keyword = $_POST["keyword"];
        if ($keyword) {
          $keyword = preproses($keyword, null);
          print('Hasil retrieval untuk <font color=blue><b>' .
          $_POST["keyword"] . '</b></font> (<font color=blue><b>'
          . $keyword . '</b></font>) adalah <hr />');
          ambilcache($keyword);
        }
      ?>
    </div>

    <div>
  </div>

</div>



</body>

<<style >
  body{
    background-color:gray;
  }

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