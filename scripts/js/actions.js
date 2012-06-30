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
      		var $boxes = $('<div class="item">adasd </div>');
      		container.prepend( $boxes ).masonry( 'reload' );
			//$('#container').append( $boxes ).masonry( 'prepended', $boxes );
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
		console.log("ss");
		$('#container').masonry( 'reload' );
   		setTimeout("update()", 3000);
} 