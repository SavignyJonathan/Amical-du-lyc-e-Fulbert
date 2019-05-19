<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');

	if(isset($_POST['ok'])) 
	{
		header("Location:recettes.php");
	}

	if(isset($_POST['annuler']))
	{
		$bdd->exec("DELETE FROM recette WHERE lastID =".$_SESSION['test']."");
		header("Location:recettes.php");
	}
?>
<?php include("header.php");
?>
	<div class="formulaireTitre">
		<div class="formulaireFini">	

			<form class="image" action="" method="post" enctype="multipart/form-data">
				<img class="image_final" src="image/<?= $_SESSION['test']?>.jpg">
			</form>

			<form action="" method="post" class="texte">
				<div class="recetteF">
					<h1><?php echo $_SESSION['titre']?></h1>
					<label for="ingredients">ingredients :<br /></label>
					<textarea readonly="readonly" name=""><?php echo $_SESSION['ingredients']?></textarea>
					<br /><br />
					<label for="étapes">étapes :<br /></label>
					<textarea readonly="readonly" name=""><?php echo $_SESSION['etapes']?></textarea>
				</div>
				
		</div>
			
				<input class="ok" type="submit" name="ok" value="ok">
				<input class="annuler" type="submit" name="annuler" value="annuler"></form>
			
	</div>
</div>
</body>
</html>