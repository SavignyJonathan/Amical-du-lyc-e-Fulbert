<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');


	  if(isset($_POST['ok'])) 
	  {
	   	$ingredients = htmlspecialchars($_POST['ingredients']);		
	  	$requser = $bdd->prepare("SELECT * FROM recette WHERE ingredients = ?");
	  	$requser->execute(array($ingredients));
	  	$userinfo = $requser->fetch();
		$_SESSION['ingredients'] = $ingredients;
	  	$bdd->exec("UPDATE `recette` SET `ingredients`= '$ingredients' WHERE `lastID` = '".$_SESSION['test']."'" );
	  	header('Location: dureeCuisson_Preparation.php');	

	  } 

?>

<?php include("header.php");
?>
	<div class="formulaireCreation">
		<form action="" method="post">
			<div class="creation">
				<label for="ingrediens">Ingredients :</label>
				<textarea name="ingredients" placeholder="Entrez vos ingredients"></textarea><br /><br /><br />
			</div>
			<input class="bouton" type="submit" name="ok" value="ok">
		</form>
	</div>
</div>
</body>
</html>