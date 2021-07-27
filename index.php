
<?php 
require("connexion.php");

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>forum</title>
</head>


<body bgcolor="#996600">



<div class="contenant">

<img src="th.jpg" width='1910' height='440'  />

<font size="5">
<?php
$commentaire=$auteur="";
$commentaireerr=$auteurerr="";

if($_SERVER["REQUEST_METHOD"]== "POST"){

if(empty($_POST["commentaire"])){
	$commentaireerr="champ requis!!!!!";
}
else{
	$commentaire=$_POST["commentaire"];
}

if(empty($_POST["auteur"])){
	$auteurerr="champ requis!!!!!";
}
else{
	$auteur=$_POST["auteur"];
}
}

?>


<center>
<div style="width:700px; text-align:left;">

<br /><br />

<legend><b> SUJET :</b></legend> 


<h1> <font color="#FF0000">AVIS CONCERNANT LE CORONAVIRUS (COVID-19) </font></h1> 

<br /><br />

<?php


$req1="SELECT * FROM tabcommentaire ORDER BY datetime DESC ";
$res1=$idcon->query($req1);
$nbenregistrement=$res1->rowCount();
if($nbenregistrement>0){

		$resobj=$res1->fetchALL(PDO::FETCH_OBJ);
		foreach($resobj as $key=>$val){
		echo"<p>".$val->auteur."  ".$val->datetime."</p>";
		echo"<p>".$val->commentaire."</p>";
	
        echo "<hr>";
		
		}
		$res1->closeCursor();
		//idcon=NULL;
}

?>

<br /><br />
<form name="inscription" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


<br />
<fieldset>
<legend><b>AUTEUR:</b></legend> <br /> 

<input name="auteur" value="<?php echo $auteur;?>" size="50"/><font color="#FF0000"><b>* <?php echo $auteurerr;?></b></font>
</fieldset>
<br /> <br />
<fieldset>

<legend> <b>COMMENTAIRE :</b> </legend> <br />
<textarea cols="80" rows="10"  name="commentaire"><?php echo $commentaire;?></textarea><font color="#FF0000"><b>* <?php echo $commentaireerr;?></b></font>

<br /> <br />
</fieldset>
<br />
 <center><input type="submit" value="Envoyer" name="btnenvoyer" /></center>




</form>

<?php
if(isset($_POST['btnenvoyer']) && $auteur!="" &&  $commentaire!="" ){
$datetime=date("d-m-Y    H:i:s");
	$res=$idcon->exec("insert into tabcommentaire (auteur,commentaire,datetime) values ('".$_POST['auteur']."','".$_POST['commentaire']."','".$datetime."')");
	
	if($res){
	header("location:index.php");
		$auteur="";
		$commentaire="";
		
	}
	else{
	echo "Enregistrement n'est pas ajouter";
	}

	$idcon=NULL;
			
}
?>


</font>

</body>
</div>
</fieldset>
</center>
</html>
