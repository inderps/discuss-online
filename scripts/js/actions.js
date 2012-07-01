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
                        url:'reload.php?BoardId=' + boardId + '&loggedInUser=' + emailId + '&timeStamp=' + timeStamp,
                        success:function(data){
           					var notes = $(data);
           					$('#container').prepend(notes).masonry( 'reload' );
							//$('#container').append( $boxes ).masonry( 'prepended', $boxes );
                        }
        });
        var now = new Date();
        timeStamp = now.getFullYear() 
        			+ '-' + (now.getMonth() + 1)
        			+ '-' + now.getDate()
        			+ ' ' + now.getHours() 
        			+ ':' + now.getMinutes()
        			+ ':' + now.getSeconds();
   		setTimeout("update()", 3000);
} 