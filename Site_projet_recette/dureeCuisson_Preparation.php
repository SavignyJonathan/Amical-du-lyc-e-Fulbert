<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');


	  if(isset($_POST['ok'])) 
	  {
	   	$dureeCuisson = htmlspecialchars($_POST['dureeCuisson']);
	   	$dureePrepa = htmlspecialchars($_POST['dureePrepa']);		
	  	$requser = $bdd->prepare("SELECT * FROM recette WHERE dureeCuisson = ? AND dureeCuisson = ?");
	  	$requser->execute(array($dureeCuisson, $dureePrepa));
	  	$userinfo = $requser->fetch();
		$_SESSION['dureeCuisson'] = $dureeCuisson;
		$_SESSION['dureePrepa'] = $dureePrepa;
	  	$bdd->exec("UPDATE `recette` SET `dureeCuisson`= '$dureeCuisson' WHERE `lastID` = '".$_SESSION['test']."'" );
	  	$bdd->exec("UPDATE `recette` SET `dureePrepa`= '$dureePrepa' WHERE `lastID` = '".$_SESSION['test']."'" );
	    header('Location: etapes.php');	

	  } 

?>

<?php include("header.php");
?>
	<div class="formulaireCreation">
		<form action="" method="post">
			<div class="recetteR">
				<label for="dureeCuisson">Durée de cuisson (en minutes) :</label>
				<input type="text" name="dureeCuisson"><br /><br /><br />

				<label for="dureePrepa">Durée de préparation (en minutes) :</label>
				<input type="text" name="dureePrepa"><br /><br /><br />
				
			</div>
			<input class="bouton" type="submit" name="ok" value="ok">
		</form>
	</div>
</div>
</body>
</html>