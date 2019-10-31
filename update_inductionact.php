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
$record1-> nameactivity  = $_POST['nameactivity'];
$record1-> status  = $_POST['status'];
$record1-> date  = $dateactu;

//$record1-> createdate = $fecha->getTimestamp();
//$record1-> idestado = 1;
//$records = array($record1);
//print_r($records);
//$lastinsertid = $DB->insert_record('top_acompanamiento', $record1);
//echo $lastinsertid;

$DB->update_record('induction_activity', $record1, $bulk=false);

header("Location:".$_SERVER['HTTP_REFERER']);
?>