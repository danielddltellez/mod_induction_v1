<?php
require_once '../../config.php';
if ($CFG->forcelogin) {
    require_login();
}

global $USER, $DB, $COURSE;

$id = $_GET['id'];
$dateactu = strtotime($_POST['date']);
$record1 = new stdClass();
$record1-> id = $id;
$record1-> nameprocesses  = $_POST['nameprocesses'];
$record1-> estatus  = $_POST['estatus'];
$record1-> date  = $dateactu;

$DB->update_record('induction_processes', $record1, $bulk=false);

header("Location:".$_SERVER['HTTP_REFERER']);
?>