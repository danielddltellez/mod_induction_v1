<?php
require_once '../../config.php';
if ($CFG->forcelogin) {
    require_login();
}

global $USER, $DB, $COURSE;

$id = $_GET['id'];

$record1 = new stdClass();
$record1-> id = $id;
$record1-> filename  = $_POST['filename'];
$record1-> ubicacion  = $_POST['ubicacion'];


$DB->update_record('induction_files', $record1, $bulk=false);

header("Location:".$_SERVER['HTTP_REFERER']);
?>