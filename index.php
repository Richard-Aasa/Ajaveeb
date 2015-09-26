<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html class=“no-js”>
<head>
    <meta charset="utf-8">
    <title>Ajaveeb</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/modernizr.js"></script> <!-- Modernizr toetus kõikidele brauseritele-->
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
			$query = new Post($db);
			if(!empty($_GET['tag'])) {
				$query->filter('postTag',$_GET['tag']);
				// If no query with such tag exist redirect
				if(count($query->$array) == 0) {
					header('Location: ./');
				}
			} else {
				$query->all();
			}
			//var_dump(get_object_vars($query));
			foreach($query->array as $post) {
				echo '<div>';
					echo '<h3 class="center-align"><a href="viewpost.php?id='.$post['postID'].'">'.$post['postTitle'].'</a></h3>';
					echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($post['postDate'])).'</p>';
					echo $post['postDesc'];
					echo '<p><a class="waves-effect waves-red grey darken-1 btn" href="viewpost.php?id='.$post['postID'].'"><i class="material-icons right">forward</i>Loe edasi</a></p>';
          echo $post['postTag'];
        echo '</div>';
			}

  		?>

    </div>
	</div>
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/init.js"></script>
  </script>
</body>
</html>
