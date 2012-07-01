function Board() {
	var container = $('#container');
	function init(){
		container.masonry({
      		itemSelector: '.item',
      		columnWidth: 25,
      		isAnimated: true
    	});
    	add();
	}
	
	function add(){
		$('#addItem').click(function(){
           $('#inputArea').hide();
           $('#loadingNewNoteArea').show();
             $.ajax({
                        async:true,
                        url:'add-notes.php?BoardId=' + boardId + '&AddedBy=' + emailId + '&Content=' + $('#note').val(),
                        success:function(data){
           					$('#loadingNewNoteArea').hide();
                            $('#inputArea').show();
           					var $note = $(data);
      						container.prepend( $note ).masonry( 'reload' );
							//$('#container').append( $boxes ).masonry( 'prepended', $boxes );
                        }
             });
    	});
	}
	
	return {
		init: init
	}   
}
    
    

$(document).ready(function () {
    new Board().init();
    update();
});

function update(){
		$.ajax({
                        async:true,
        				dataType: "json",
                        url:'reload.php?BoardId=' + boardId + '&loggedInUser=' + emailId,
                        success:function(data){
                        	var html = "";
                        	for(var index in data.notes){
                        		if(CheckIfThisNoteNeedsToBeAdded(data.notes[index])){
			                        		html = html + CreateItem(data.notes[index], emailId);                        			
                        		}
                        	}
           					$('#container').prepend(html).masonry( 'reload' );
							//$('#container').append( $boxes ).masonry( 'prepended', $boxes );
                        }
        });
        var now = new Date();
   		setTimeout("update()", 10000);
}

function CreateItem(note, isUser){
	var htmlToRender = '';
	var options = new Array();
	htmlToRender = htmlToRender + 
	'<div data-addedOn="' + note.AddedOn + '" id="item' + note.Id + '" class="item color' + note.Vote + '"> '
	+ '<div class="feature"> ' + note.Content + '</div>';
	
	if(isUser){
		for(var i=0; i<=4; i++) {
			options[i] = 'value="' + i + '"';
			if(note.Vote == i)	{
				options[i] = options[i] + ' selected="selected"';
			}		
		}
		htmlToRender = htmlToRender 
			+ '<div class="choice">'
			+ '<select id="voteDropdown' + note.Id + '">'
			+	'<option ' + options[0] + ' >Select a option</option> '
			+	'<option ' + options[1] + ' >Should have</option> '
			+	'<option ' + options[2] + ' >Nice to have</option> '
			+	'<option ' + options[3] + ' >Not so important</option> '
			+	'<option ' + options[4] + ' >Useless</option> '
			+ '</select>'
			+ '</div>';
	}
	
	htmlToRender = htmlToRender + '</div>';
	return htmlToRender;	
} 

function CheckIfThisNoteNeedsToBeAdded(note){
	var noteElement = $('#item' + note.Id);
	if (noteElement.length > 0){
		if(noteElement.attr('data-addedOn')==note.AddedOn){
			return false;
		}
	}
	return true;
}
