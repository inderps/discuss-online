<?php
include("service.php");
$service = new Service();
$note = $service->AddNewNote($_GET['Content'], $_GET['AddedBy'], date('Y-m-d H:i:s'), $_GET['BoardId']);
?>
<div class="item">
		<div class="feature">
			<?php echo $note->Content;?>
		</div>
<!-- 		<div class="votes">
			<ul>
				<li>Should have <span>+1</span></li>
				<li>Good to have <span>+1</span></li>
				<li>Not so important <span>+1</span></li>
				<li>Useless <span>+1</span></li>
			</ul>
		</div> -->
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