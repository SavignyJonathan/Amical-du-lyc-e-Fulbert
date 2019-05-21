<?php session_start();
include("header.php");

$bdd = new PDO("mysql:host=127.0.0.1;dbname=solibio;charset=utf8", "root", "");
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $get_id = htmlspecialchars($_GET['id']);
   $recette = $bdd->prepare('SELECT * FROM recette WHERE id = ?');
   $recette->execute(array($get_id));
   if($recette->rowCount() == 1) {
      $recette = $recette->fetch();
      $titre = $recette['titre'];
      $ingredients = $recette['ingredients'];
      $etapes = $recette['etapes'];
      $lastID = $recette['lastID'];
   } else {
      die('Cette recette n\'existe pas !');
   }


   if (isset($_POST['validerCommentaire'])) {
      if (isset($_POST['contenu']) AND  !empty($_POST['contenu']) ) {
         $contenu = htmlspecialchars($_POST['contenu']);
         $pseudo = htmlspecialchars($_POST['pseudo']);

         $insert = $bdd->prepare('INSERT INTO commentaire (contenu, pseudo,id_recette) VALUES (?,?,?)');
         $insert->execute(array($contenu,$_SESSION['pseudo'],$get_id));

         $commentaires = $bdd->prepare("SELECT * FROM commentaire WHERE id_recette = ? ORDER BY id DESC");
         $commentaires->execute(array($get_id));
         if($commentaires->rowCount() == 1) {
            $commentaires = $commentaires->fetch();
            $contenu = $commentaires['contenu'];
            $pseudo = $commentaires['pseudo'];
            $id_recette = $commentaires['id_recette'];
         }

         if(!empty($_POST['validerCommentaire']))  
         {
            unset($_POST['validerCommentaire']);
            header("Location:recetteF.php?id=".$get_id."" );
         }
      }
   }
  


   $commentairesParPage = 3;
   $commentairesTotalesReq = $bdd->query('SELECT id FROM commentaire');
   $commentairesTotales = $commentairesTotalesReq->rowCount();
   $pagesTotales = ceil($commentairesTotales/$commentairesParPage);
   if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
      $_GET['page'] = intval($_GET['page']);
      $pageCourante = $_GET['page'];
} 

   else {
      $pageCourante = 1;
   }
$depart = ($pageCourante-1)*$commentairesParPage;

} 
?>

<div class="formulaireTitre">
   <div class="formulaireFini">
      <form class="image" action="" method="post" enctype="multipart/form-data">

         <img class="image_final" src="image/<?= $lastID?>.jpg">

      </form>
<form method="post" class="texte">
   <div class="recetteF">
      <h1><?= $titre ?></h1>
      <p>Ingrédients :</p> 
      <textarea><?= $ingredients ?></textarea><br />
      <p>Étapes :</p>
      <textarea><?= $etapes ?></textarea>
      </div>
</form>
</div>
</div>
<form method="post" action="#">
   <div class="Bloccommentaire">
      <div class="blocinfo">
         <h2>Commentaires:</h2>
         <textarea name="contenu" placeholder="Votre commentaire" class="commentaire"></textarea>
         <input type="submit" name="validerCommentaire"><br />
      </div>
         <div class="commentaireexist">
            <?php
               $commentaires = $bdd->query('SELECT * FROM commentaire WHERE id_recette = '.$get_id.' ORDER BY id DESC LIMIT '.$depart.','.$commentairesParPage);
               while($c = $commentaires->fetch())
               {
               echo"<fieldset>
               <legend>";
               echo $c['pseudo']." à dit";
               echo "</legend>";
               echo "<textarea readonly= \"readonly\">";
               echo $c['contenu'];
               echo "</textarea>";;
               echo"</fieldset>";
               echo "<div class=\"intercom\"></div>";
               }
               echo "<div class = \"lien\">";
               for($i=1;$i<=$pagesTotales;$i++) {
                  if($i == $pageCourante) {
                     echo $i;
                  } 
                  else {
                     echo '<a href="recetteF.php?id= '.$get_id.'&page='.$i.'">'.$i.'</a> ';
                  }
               }
               echo "</div>";
               ?>
         </div>
      <br />
   </div>
</form>
</div>
</body>
</html>

