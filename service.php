<?php
include(dirname(__FILE__). DIRECTORY_SEPARATOR. "database".DIRECTORY_SEPARATOR. "database.php");

class Notes {
	var $Id;
	var $Content;
	var $AddedOn;
	var $AddedBy;
	var $BoardId;
	var $Vote;
	
	function Notes($Id, $Content, $AddedOn, $AddedBy, $BoardId, $Vote) {
		$this->Id = $Id;
		$this->Content = $Content;
		$this->AddedBy = $AddedBy;
		$this->AddedOn = $AddedOn;
		$this->BoardId = $BoardId;			
		$this->Vote = $Vote;
	}
}


class Service {
	var $dB;
	
	function Service() {
		$this->dB = New Database();
   	}
	
	function AddNewNote($content, $addedBy, $addedOn, $boardId) {
		$this->dB->UpdateQ("insert into Notes(Content, AddedBy, AddedOn, BoardId) values('" . $content . "', '" . $addedBy ."', '" . $addedOn ."'," . $boardId .")");	
		return new Notes(mysql_insert_id(), $content, $addedOn, $addedBy, $boardId, 0);
	}
	
	function GetAllNotes($boardId, $user, $timeStamp){
		$notes = null;
		$timeStampCondition = '';
		if($timeStamp!=null){
			$timeStampCondition = " and n.AddedOn > '" . $timeStamp . "' ";
		}		
		
		$query = "SELECT n.Id, n.Content FROM notes n where n.BoardId = " . $boardId ;
		if($user != NULL){
			$query = "SELECT n.Id, n.Content, v.RequirementId FROM notes n LEFT JOIN votes v ON n.Id = v.NotesId and v.VotedBy like '" . $user . "' where n.BoardId = " . $boardId;
		}
		$query = $query . $timeStampCondition . ' order by n.AddedOn desc';
		$result = $this->dB->RetreiveQ($query);
		$count = 0;
		while ($row = mysql_fetch_array($result)) {
			$notes[$count]->Id = $row['Id']; 
			$notes[$count]->Content = $row['Content']; 
			if(!isset($row['RequirementId'])){
				$notes[$count]->Vote = 0; 
			}
			else{
				$notes[$count]->Vote = $row['RequirementId']; 
			}
			$count +=1;
		}		
		return $notes;
	}
}	
?>