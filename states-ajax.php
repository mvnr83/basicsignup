<?php
require_once('config/database.php');

$countryId = $_REQUEST['countryId'];
if(empty($countryId)){
    exit();
}

//fetch all states information
$dbObj = new dbFile\dbClass();
$allStates = $dbObj->getStatesByCountry($countryId);
echo json_encode($allStates);

?>
