<?php
include("service.php");
$service = new Service();
$isGuest = false;
$note = $service->AddNewNote($_GET['Content'], $_GET['AddedBy'], date('Y-m-d H:i:s'), $_GET['BoardId']);
echo json_encode($note);
?>
