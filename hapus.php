<?php
include "koneksi.php";
$Id=$_GET['Id'];
$query=mysql_query("delete from tbsoal where Id='$Id'");
if($query){
?><script language="javascript">document.location.href="index.php";</script><?php
}else{
echo "gagal hapus data";
}
?>