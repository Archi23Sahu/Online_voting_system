<?php 
session_start();
//write code to generate a random string first 

$a=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M');

$s="";
$n=rand(4,7);
for($i=1;$i<=$n;$i++)
{
	shuffle($a);
	$s=$s.$a[0];
	
}
$_SESSION['capcha']=$s;
//echo "<br />String is $s";
$w=300;
$h=50;
$c=imagecreate($w,$h);
$yellow=imagecolorallocate($c,255,255,128);
$red=imagecolorallocate($c,255,0,0);
//imagestring($c,5,10,4,$s,$red);
$fnt=imageloadfont('gdf_fonts/cowboys.gdf');
imagestring($c,$fnt,10,4,$s,$red);

header("Content-type:image/png");
imagepng($c);
imagedestroy($c);

?>