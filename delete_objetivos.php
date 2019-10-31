<?php

require_once '../../config.php';

if ($CFG->forcelogin) {
    require_login();
}

global $USER, $DB, $COURSE;

if(isset($_GET['id'])){
	
		
    $id = $_GET['id'];

    $DB->delete_records('induction_objetivo', array('id' => $id)) ;

}


header("Location:".$_SERVER['HTTP_REFERER']);

?>