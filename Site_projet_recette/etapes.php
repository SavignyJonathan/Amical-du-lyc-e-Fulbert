<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');


	  if(isset($_POST['ok'])) 
	  {
	   	$etapes = htmlspecialchars($_POST['etapes']);
	  	$requser = $bdd->prepare("SELECT * FROM recette WHERE etapes = ?");
	  	$requser->execute(array($etapes));
	  	$userinfo = $requser->fetch();
		$_SESSION['etapes'] = $etapes;

	  	$bdd->exec("UPDATE `recette` SET `etapes`= '$etapes' WHERE `lastID` = '".$_SESSION['test']."'" );
	  	header('Location: miniature.php');	

	  } 

?>

<?php include("header.php");
?>
	<div class="formulaireCreation">
		<form action="" method="post">
			<div class="creation">
				<label for="etapes">Etapes :</label>
				<textarea placeholder="Entrez les étapes de la recette" name="etapes"></textarea>
				<br /><br /><br />
				
			</div>
			<input class="bouton" type="submit" name="ok" value="ok">
		</form>
	</div>
</div>
</body>
</html>