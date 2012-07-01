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
                        url:'reload.php?BoardId=' + boardId + '&loggedInUser=' + emailId,
                        success:function(data){
           					var notes = $(data);
           					$('#container').html(notes);
      						$('#container').masonry( 'reload' );
							//$('#container').append( $boxes ).masonry( 'prepended', $boxes );
                        }
        });
   		setTimeout("update()", 3000);
} 