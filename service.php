<?php
include(dirname(__FILE__). DIRECTORY_SEPARATOR. "database".DIRECTORY_SEPARATOR. "database.php");

class Notes {
	var $Id;
	var $Content;
	var $AddedOn;
	var $AddedBy;
	var $BoardId;
	
	function Notes($Id, $Content, $AddedOn, $AddedBy, $BoardId) {
		$this->Id = $Id;
		$this->Content = $Content;
		$this->AddedBy = $AddedBy;
		$this->AddedOn = $AddedOn;
		$this->BoardId = $BoardId;			
	}
}


class Service {
	var $dB;
	
	function Service() {
		$this->dB = New Database();
   	}
	
	function AddNewNote($content, $addedBy, $addedOn, $boardId) {
		$this->dB->UpdateQ("insert into Notes(Content, AddedBy, AddedOn, BoardId) values('" . $content . "', '" . $addedBy ."', '" . $addedOn ."'," . $boardId .")");	
		return new Notes(mysql_insert_id(), $content, $addedOn, $addedBy, $boardId);
	}
}	
?>