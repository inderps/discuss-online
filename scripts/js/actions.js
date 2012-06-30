$(function(){    
    var $container = $('#container');
    $container.masonry({
      itemSelector: '.item',
      columnWidth: 100,
      isAnimated: true
    });
    
    $('#addItem').click(function(){
      	var $boxes = $('<div class="item">adasd </div>');
		$('#container').append( $boxes ).masonry( 'appended', $boxes );
    });
    
});  
  