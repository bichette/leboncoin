<?php
print_r($_GET);
print_r($_POST);

if(isset($_GET['action'])){
		switch ($_GET['action']){
		case "A": 	echo '<img src="images/etoile.jpg" title="etoile" alt="etoile" width="170" height="150"  />';
					break;
		case "B": 	echo '<img src="images/logoleboncoin.jpg" title="logo" alt="logo" width="170" height="150"  />';
					break;
		default: 
		}
}

if(isset($_POST['action']) and $_POST['action'] == "C")
{
	echo '<div>';
			echo '<p>ccc</p>';
			echo '<p>cc</p>';
			echo '<p>c</p>';
			echo '</div>';
}
?>