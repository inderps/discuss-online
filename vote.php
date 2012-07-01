<?php
include("service.php");
$service = new Service();
$vote = $service->Vote($_GET['NoteId'], $_GET['VotedBy'], date('Y-m-d H:i:s'), $_GET['Vote']);
echo json_encode($vote);
?>
