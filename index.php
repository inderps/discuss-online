<?php session_start(); ?>
<?php 
	if(isset($_POST['email'])){
		$_SESSION['email'] = $_POST['email'];
	}
?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<title>Discuss Online</title> 
<link type="text/css" rel="stylesheet"  href="scripts/css/style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="scripts/js/jquery.masonry.min.js"></script>
<script src="scripts/js/actions.js"></script>
<script type="text/javascript">
	var emailId = null;
	var boardId = '<?php echo $_GET['id']; ?>';
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33085077-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head> 
<body> 
	<div id="header">
		<span class="title">Online Requirement Gathering - </span> <span class="name"> CRM Solution for Photographers</span>
	</div>
	<div id="inputArea">
		<?php 
			if(!isset($_SESSION['email'])){
				?>
				<form action="" method="post" onsubmit="return SubmitMe(this)">
					<div class="label">Enter your Email ID to Start Contributing </div>
					<input name="email" type="text" class="text" />
					<input type="submit" class="start" value="Start"/>
				</form>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					emailId = '<?php echo $_SESSION['email']; ?>';
				</script>
				<form id="add-note-form">
					<div class="label">Suggest a new feature </div>
						<div id="note_elements">
							<textarea class="text" rows="3" id="note"></textarea>
							<a href="#">
								<img id="addItem" src="images/add.png" border="0"/>
							</a>
						</div>
				</form>
				<?php
			}
		?>
	</div>
	<div id="loadingNewNoteArea" style="display: none;">
			Adding Please wait................
	</div>
	<div id="container">
	</div>
</body> 
</html> 