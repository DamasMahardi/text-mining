<?php 
$data = unserialize(base64_decode($_POST['data']));

//$jumlah2 = unserialize(base64_decode($_POST['jumlah2']));
echo "<pre>";
print_r($data);
echo "</pre>";

?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>Proses Stemming Porter</title>
</head>
<body>
   <h2>Porter Indonesia </h2>
   
      <html>
	  <?php foreach ($teks3=$teks3." ".$teks2;):?>
	  
      Kata: <input type="text" name="kata><?php echo $teks3;?>" value="<?php echo $teks2;?>"  />
	 />
      <br />
	  
	<?php endforeach; ?>
      <br />
	  <form method="POST" action="proses2.php" enctype="multipart/form-data">
	<input type="submit" value="stemming" />
     

   </form>
</body>
</html>