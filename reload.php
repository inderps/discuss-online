<?php 
include("service.php");
$service = new Service();
$user = $_GET['loggedInUser'];
$timeStamp = $_GET['timeStamp'];
$isGuest = true;
if($user!='null'){
	$isGuest = false;
}

if($timeStamp == 'null'){
	$timeStamp = null;
}
$notes = $service->GetAllNotes(1, $user, $timeStamp);
// echo "<div class='item'>" . $user .  "</div>";
if($notes!=null){
	foreach ($notes as $note) {
	include("_item.php");
	}
}
?>