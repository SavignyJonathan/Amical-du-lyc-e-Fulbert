 <?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=solibio;charset=utf8", "root", "");
$recettesParPage = 5;
$recettesTotalesReq = $bdd->query('SELECT id FROM recette');
$recettesTotales = $recettesTotalesReq->rowCount();
$pagesTotales = ceil($recettesTotales/$recettesParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
} else {
   $pageCourante = 1;
}
$depart = ($pageCourante-1)*$recettesParPage;
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <?php
      $videos = $bdd->query('SELECT * FROM recette ORDER BY id DESC LIMIT '.$depart.','.$recettesParPage);
      while($vid = $videos->fetch()) {
      ?>
      <b>N°<?php echo $vid['id']; ?> - <?php echo $vid['titre']; ?></b><br />
      <i><?php echo $vid['ingredients']; ?></i>
      <br /><br />
      <?php
      }
      ?>
      <?php
      for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="test.php?page='.$i.'">'.$i.'</a> ';
         }
      }
      ?>
   </body>
</html>