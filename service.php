<?php
include(dirname(__FILE__). DIRECTORY_SEPARATOR. "database".DIRECTORY_SEPARATOR. "database.php");

class Notes {
	var $Id;
	var $Content;
	var $AddedOn;
	var $AddedBy;
	var $BoardId;
	var $Vote;
	var $VotedOn;
	
	function Notes($Id, $Content, $AddedOn, $AddedBy, $BoardId, $Vote, $VotedOn) {
		$this->Id = $Id;
		$this->Content = $Content;
		$this->AddedBy = $AddedBy;
		$this->AddedOn = $AddedOn;
		$this->BoardId = $BoardId;			
		$this->Vote = $Vote;
		$this->VotedOn = $VotedOn;
	}
}

class Vote {
	var $Id;
	var $VotedOn;
	var $VotedBy;
	var $NotesId;
	var $Vote;

	function Vote($Id, $VotedOn, $VotedBy, $NotesId, $Vote){
		$this->Id = $Id;
		$this->VotedOn = $VotedOn;
		$this->VotedBy = $VotedBy;
		$this->NotesId = $NotesId;
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
		return new Notes(mysql_insert_id(), $content, $addedOn, $addedBy, $boardId, 0, NULL);
	}
	
	function GetAllNotes($boardId, $user){
		$notes = null;
		
		$query = "SELECT n.Id, n.Content, n.AddedOn FROM notes n where n.BoardId = " . $boardId ;
		if($user != NULL){
			$query = "SELECT n.Id, n.Content, n.AddedOn, v.VotedOn, v.RequirementId FROM notes n LEFT JOIN votes v ON n.Id = v.NotesId and v.VotedBy like '" . $user . "' where n.BoardId = " . $boardId;
		}
		$query = $query . ' order by n.AddedOn desc';
		$result = $this->dB->RetreiveQ($query);
		$count = 0;
		while ($row = mysql_fetch_array($result)) {
			$notes[$count]->Id = $row['Id']; 
			$notes[$count]->Content = $row['Content']; 
			$notes[$count]->AddedOn = $row['AddedOn']; 
			$notes[$count]->VotedOn = $row['VotedOn']; 
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
	
	function Vote($noteId, $votedBy, $votedOn, $vote) {
		$query = "insert into Votes(VotedOn, VotedBy, NotesId, RequirementId) values('" . $votedOn . "', '" . $votedBy ."', " . $noteId ."," . $vote .")";
		$result = $this->dB->RetreiveQ("select Id from Votes where NotesId=" . $noteId . " and VotedBy = '" . $votedBy . "'");
		if($row = mysql_fetch_array($result)) {
			$query = "update Votes set VotedOn = '" . $votedOn . "', RequirementId = " . $vote ." where Id = " . $row['Id'];
		}
		$this->dB->UpdateQ($query);	
		return new Vote(mysql_insert_id(), $votedOn, $votedBy, $noteId, $vote);
	}
}	
?>