<?php 
for($i=0; $i<=4; $i++) {
	$options[$i] = 'value="' . $i . '"';
	if($note->Vote == $i){
		$options[$i] = $options[$i] . ' selected="selected"';
	}	
}

?>
<div id="item<?php echo $note->Id; ?>" class="item color<?php echo $note->Vote; ?>">
		<div class="feature">
			<?php echo $note->Content;?>
		</div>
<!-- 		<div class="votes">
			<ul>
				<li>Should have <span>+1</span></li>
				<li>Nice to have <span>+1</span></li>
				<li>Not so important <span>+1</span></li>
				<li>Useless <span>+1</span></li>
			</ul>
		</div> -->
<?php 
	if(!$isGuest){
		?>
		<div class="choice">
			<select id="voteDropdown">
				<option <?php echo $options[0]; ?>>Select a option</option>
				<option <?php echo $options[1]; ?>>Should have</option>
				<option <?php echo $options[2]; ?>>Nice to have</option>
				<option <?php echo $options[3]; ?>>Not so important</option>
				<option <?php echo $options[4]; ?>>Useless</option>
			</select>
		</div>
		<?php
	}
?>		
</div>