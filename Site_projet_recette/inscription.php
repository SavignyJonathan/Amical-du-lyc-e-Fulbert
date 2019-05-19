<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=solibio', 'root', '');

	  if(isset($_POST['ok'])) 
	  {
	  	$nom = htmlspecialchars($_POST['Nom']);	
	  	$prenom = htmlspecialchars($_POST['Prenom']);
	  	$pseudo = htmlspecialchars($_POST['Pseudo']);
	  	$mail = htmlspecialchars($_POST['Adresse_mail']);	
	  	$mdp = sha1($_POST['MotDePasse']);
	  	$dateNaiss = htmlspecialchars($_POST['DateNaiss']);
	  	$administrateur = 1;	

	  		$bdd->exec("INSERT INTO utilisateurs(nom, prenom, pseudo, motDePasse, adresseMail, DateNaissance, administrateur) VALUES('".$nom."','".$prenom."','".$pseudo."','".$mdp."','".$mail."','".$dateNaiss."','".$administrateur."')");

	  	
	  	
	  }

	   if(isset($_POST['ok2'])) 
	  {
	  	$pseudo = htmlspecialchars($_POST['pseudo']);
	  	$mdp = sha1($_POST['mdp']);
	  	if (!empty($pseudo) AND !empty($mdp)) 
	  	{
	  		$requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE pseudo = ? AND motDePasse = ?");
	  		$requser->execute(array($pseudo, $mdp));
	  		$userexist = $requser->rowCount();
	  		if($userexist == 1)
			{
				$userinfo = $requser->fetch();
				$_SESSION['id_utilisateurs'] = $userinfo['id_utilisateurs'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['mdp'] = $userinfo['mdp'];
				header("Location: recettes.php?id=".$_SESSION['id_utilisateurs']);
			}
			else
			{
				echo "Mauvais identifiant ou mot de passe";
			}
	  	}
	  }

?>
<?php
include("header.php");
?>

	
	<div class="formulaire">
		<img class = "avatar" src="png/avatar.png">
			<div class="inscription">
				<form action="" class="ins" method="post">
					<h1 class="titre">S'inscrire</h1>
					<label for="Nom">Nom :</label>
					<input type="text" name="Nom">
					<label for="Prenom">Prenom :</label>
					<input type="text" name="Prenom">
					<label for="Pseudo">Pseudo :</label>
					<input type="text" name="Pseudo">
					<label for="Adresse_mail">Adresse mail :</label>
					<input type="text" name="Adresse_mail">
					<label for="MotDePasse">Mot de passe :</label>
					<input type="password" name="MotDePasse">
					<label for="DateNaiss">Date de naissance :</label>
					<input type="date" name="DateNaiss">
					<input class="bouton" type="submit" name="ok" value="ok">
				</form>
				<form action="" class="ins2" method="post">
					<h1 class="titre2">Se connecter</h1>
						<label for="pseudo">Pseudo :</label>
						<input type="text" name="pseudo"><br />
						<label for="mdp">Mot de passe :</label>
						<input type="password" name="mdp"><br />
						<input class="bouton" type="submit" name="ok2" value="ok">
				</form>
			</div>	
	</div>
</div>

</body>

</html>