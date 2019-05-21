<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $get_id = htmlspecialchars($_GET['id']);
   }

	  if(isset($_POST['ok'])) 
	  {
	  	$titre = htmlspecialchars($_POST['titre']);
	  	$test = rand(100,5656565);		
		$bdd->exec("INSERT INTO recette(titre,lastID, pseudo,id_recette) VALUES('".$titre."', $test,'".$_SESSION['pseudo']."', lastID )");
		$requser = $bdd->prepare("SELECT * FROM recette WHERE titre = ?");
	  	$requser->execute(array($titre));
	  	$userinfo = $requser->fetch();
	  	$_SESSION['titre'] = $userinfo['titre'];
	  	$_SESSION['test'] = $test;
	  	$test = $_SESSION['test'];

		header('Location: ingredients.php');	
      }

		 include("header.php");
		 ?>

	<div class="formulaireCreation">
		<form action="" method="post">
			<div class="creation">
				<label for="Titre">Titre :</label>
				<input type="text" name="titre">
			</div>
			<input class="bouton" type="submit" name="ok" value="ok">
		</form>
	</div>
</div>


</body>
</html>
