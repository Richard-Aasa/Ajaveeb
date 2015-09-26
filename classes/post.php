<?php
class Post {

	private $db;
	public $array = array();

	// $db is a PDO
	function __construct($db) {
		$this->db = $db;
	}

	function byID($id) {
		$stmt = $this->db->prepare("SELECT * FROM posts WHERE postID = :id");
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		$row = array();
		if($row = $stmt->fetch()) {
			$row['postDesc'] = '<p>'.$row['postDesc'].'</p>';
			$row['postCont'] = '<p>'.$row['postCont'].'</p>';
			$row['postTag'] = '<div id="'.$row['postTag'].'" class="hide-on-med-and-down cat"><a href="?tag='.$row['postTag'].'">'.$row['postTag'].'</a></div>';

		}
		return $row;
	}

	// Add formatting
	function filter($filter,$value) {
		$stmt = $this->db->prepare("SELECT * FROM posts WHERE :filter = :value");
		$stmt->execute(array(':filter' => $filter, ':value' => $value));
		while ($row = $stmt->fetch()) {
			$row['postDesc'] = '<p>'.$row['postDesc'].'</p>';
			$row['postCont'] = '<p>'.$row['postCont'].'</p>';
			$row['postTag'] = '<div id="'.$row['postTag'].'" class="hide-on-med-and-down cat"><a href="?tag='.$row['postTag'].'">'.$row['postTag'].'</a></div>';
			array_push($this->array, $row);
		}
	}

	// Add formatting. Example use after all(). foreach($posts->$array as $post){echo $post['postID']}
	function all() {
		$stmt = $this->db->query("SELECT * FROM posts");
		while ($row = $stmt->fetch()) {
			$row['postDesc'] = '<p>'.$row['postDesc'].'</p>';
			$row['postCont'] = '<p>'.$row['postCont'].'</p>';
			$row['postTag'] = '<div id="'.$row['postTag'].'" class="hide-on-med-and-down cat"><a href="?tag='.$row['postTag'].'">'.$row['postTag'].'</a></div>';
			array_push($this->array, $row);
		}
	}

	// Done
	function edit($query) {
		// Assume$query has the neccesary keys
		$stmt = $this->db->prepare("UPDATE posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont, postTag = :postTag WHERE postID = :postID");
		$stmt->execute(array(
			':postID' => $query['postID'],
			':postTitle' => $query['postTitle'],
			':postDesc' => $query['postDesc'],
			':postCont' => $query['postCont'],
			':postTag' => $query['postTag']));
		return isset($stmt);
	}

	// Done
	function remove($id) {
		// ID will always be validated, no need to bind, for now.
		$stmt = $this->db->exec("DELETE FROM posts WHERE postID = '.$id.'");
		return $stmt != 0;
	}

	// Done
	function add($query) {
		$stmt = $this->db->prepare("INSERT INTO posts (postTitle, postDesc, postCont, postTag) VALUES (:postTitle, :postDesc, :postCont, :postTag)");
		$stmt->execute(array(
			':postTitle' => $query['postTitle'],
			':postDesc' => $query['postDesc'],
			':postCont' => $query['postCont'],
			':postTag' => $query['postTag']));
		return isset($stmt);
	}
}
?>
