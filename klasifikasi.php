<?php
//naive bayes
//("localhost","id11383888_root","227252","id11383888_dbst");
 
$con = mysql_connect("localhost","id11383888_root","227252","id11383888_dbst"); 
mysql_select_db("dokumen", $con); $sql2="select count(id) as total from dokumen";
$result2=mysql_query($sql2,$con);
$jum=0;
while($lRow2=mysql_fetch_array($result2)){
$total=$lRow2['total'];
} $total=$total-1; 
$kategori="";
$tertinggi=0;
 $sql="select * from kategori";
$result=mysql_query($sql,$con);       while($lRow=mysql_fetch_array($result)){
echo "Kategori : ". $lRow['kategori'] ."<br>";
$nilai =1;
$sql2="select count(id) as total from dokumen where keyword='". $lRow['kategori'] ."'";
 $result2=mysql_query($sql2,$con);            while($lRow2=mysql_fetch_array($result2)){
$totalkat=$lRow2['total'];
}
echo $totalkat . "/" . $total . "<br>";
$nilai=$nilai*$totalkat/$total; 
$sql3="select * from link where dokid=". $kode ."";
$result3=mysql_query($sql3,$con);            while($lRow3=mysql_fetch_array($result3)){
$sql4="select count(id) as total from link where keyid='". $lRow3['keyid'] ."' and kategori='". $lRow['kategori'] ."'";
$result4=mysql_query($sql4,$con);            while($lRow4=mysql_fetch_array($result4)){
$jumlah=$lRow4['total'];
$jumlah=$jumlah+1;
 $nilai=$nilai*$jumlah/$totalkat;
 }
}
echo "P = ". $nilai . "<br>"; 
      //kategori
if($nilai>$tertinggi){
$tertinggi=$nilai;
$kategori=$lRow['kategori'];
}}
echo "<br><br><br> Nilai Tertinggi adalah ".  $kategori ." Dengan Nilai = ".$tertinggi;
 $sql5="UPDATE dokumen set keyword='".  $kategori ."' where id=". $kode ." ";
mysql_query($sql5,$con);
?>