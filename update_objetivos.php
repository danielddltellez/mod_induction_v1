<?php
require_once '../../config.php';
if ($CFG->forcelogin) {
    require_login();
}

global $USER, $DB, $COURSE;

$id = $_GET['id'];

$record1 = new stdClass();
$record1-> id = $id;
$record1-> nameobjetivo = $_POST['nameobjetivo'];
$record1-> valorobjetivo  = $_POST['valorobjetivo'];
$record1-> avanceobjetivo = $_POST['avanceobjetivo'];
$record1-> finalobjetivo  = $_POST['finalobjetivo'];


$DB->update_record('induction_objetivo', $record1, $bulk=false);

header("Location:".$_SERVER['HTTP_REFERER']);
?>