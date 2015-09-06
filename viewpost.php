<?php require('includes/config.php');

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Ajaveeb - <?php echo $row['postTitle'];?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

</head>
<body>
  <header class="center-align">
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">add</i>
    </a>
    <ul>
      <li><a href="./" class="btn-floating green tooltipped" data-position="left" data-delay="50" data-tooltip="Kodu"><i class="material-icons">home</i></i></a></li>
			<li><a href="./" class="btn-floating amber tooltipped" id="rss" data-position="left" data-delay="50" data-tooltip="RSS"><?php echo file_get_contents("img/rss.svg"); ?></a></li>
			<li><a class="btn-floating red tooltipped disabled" data-position="left" data-delay="50" data-tooltip="Admin"><i class="material-icons">build</i></a></li>
      <!-- <li><a class="btn-floating blue"><i class="material-icons">archive</i></a></li> -->
    </ul>
  </div>
    <h1>Richard Aasa</h1>
    <h5>150885IFIFB.DT</h5>
  </header>

	<div class="row">
    <div class="col s12 l8 offset-l2 z-depth-2" id="wrapper">
			<?php
				echo '<div>';
					echo '<h2>'.$row['postTitle'].'</h2>';
					echo '<hr />';
					echo '<p><a class="waves-effect waves-red grey darken-1 btn" href="'.$_SERVER['HTTP_REFERER'].'"><i class="material-icons right">forward</i>Tagasi</a></p>';
					echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
					echo '<p>'.$row['postCont'].'</p>';
				echo '</div>';
			?>
    </div>
	</div>

  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>

  </script>
</body>
</html>
