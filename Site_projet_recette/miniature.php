<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');


	  if(isset($_POST['ok'])) 
	  {
	  	
		if(exif_imagetype($_FILES['image']['tmp_name']) == 2)
		{
			$chemin = 'image/' .$_SESSION['test'].'.jpg';	
	  		$bdd->exec("UPDATE `recette` SET `image`= '$chemin' WHERE `lastID` = '".$_SESSION['test']."'" );
			move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
		}
		else
		{
			echo "Votre image doit être au format JPG";
		}
			  header("Location:final.php");

	  } 

?>

<?php include("header.php");
?>
	<div class="formulaireCreation">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="recetteR">
				<label for="image">Ajouter une miniature :</label>
				<input type="FILE" name="image"><br /><br /><br />
				<br /><br /><br />
				

			</div>
			<input class="bouton" type="submit" name="ok" value="ok">
		</form>
	</div>
</div>
</body>
</html>