<?php
include_once("include/config.php");
if(isset($_GET['id'])){
	
	if (unactive($_GET['id'])) {
		setActive($_GET['id']);
	    echo "<h1> account attivato correttamente!</h1>";
	    header("Refresh: 5;URL=login.php");
	}else echo"<h1> Errore</h1>";

}

?>
