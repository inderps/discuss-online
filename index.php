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
	var boardId = '<?php echo $_GET['id']; ?>';
</script>
</head> 
<body> 
	<div id="inputArea">
		<?php 
			if(!isset($_SESSION['email'])){
				?>
				<form action="index.php" method="post">
					<div class="label">Enter your Email ID to Start Contributing </div>
					<input name="email" type="text" class="text" />
					<input type="submit" class="start" value="Start"/>
				</form>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					var emailId = '<?php echo $_SESSION['email']; ?>';
				</script>
				<form>
					<div class="label">Add New Note </div>
						<div id="note_elements">
							<textarea class="text" rows="3" id="note"> </textarea>
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
	<div class="item">
		<div class="feature">
			Masonry works on a container element with a group of similar child items.
		</div>
		<div class="votes">
			<ul>
				<li>Should have <span>+1</span></li>
				<li>Good to have <span>+1</span></li>
				<li>Not so important <span>+1</span></li>
				<li>Useless <span>+1</span></li>
			</ul>
		</div>
		<div class="choice">
			<select>
				<option>Select your choice</option>
				<option>Should have</option>
				<option>Good to have</option>
				<option>Not so important</option>
				<option>Useless</option>
			</select>
		</div>
	</div>
	
	</div>
</body> 
</html> 