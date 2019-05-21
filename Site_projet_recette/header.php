<!DOCTYPE html>
<html>
<head>
	<title>Toutes les meilleurs recettes !</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="recettes.css">
	<link rel="stylesheet" href="inscription.css">
	<link rel="stylesheet" href="Titre.css">
	<link rel="stylesheet" href="Connexion.css">
	<link rel="icon" href="png/pomme.png">
</head>

<body>
	<div class="bloc_page">
		<nav class="entete">
			<h1><a href="recettes.php"><img src = "png/logo.png"></a></h1>
			<a href="inscription.php">
				<nav class="compte">
					<ul>
						<?php
						 if($_SESSION){
							echo"<a href=\"deconnexion.php\"><li class=\"li_entete\">Déconnexion</li></a>";
						}
						else{
							echo"<li class=\"li_entete\">Connexion</li>";
						}
						?>
						
					</ul>
				</nav>
			</a>
			<div class="recherche"> 
				<form method="GET" class="ufzerf">
				<input class="input_entete" type="search" name="q" placeholder="Entrez un plat">
				<div class="test">
				</div>
				</form>
			</div>
			
		</nav>
		