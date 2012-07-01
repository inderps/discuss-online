<?php 
include("service.php");
$service = new Service();
$user = $_GET['loggedInUser'];
$isGuest = true;
if($user!='null'){
	$isGuest = false;
}

$notes = $service->GetAllNotes(1, $user);
// echo "<div class='item'>" . $user .  "</div>";
$data->notes = $notes;
if($notes!=null){
	echo json_encode($data);
}
?>