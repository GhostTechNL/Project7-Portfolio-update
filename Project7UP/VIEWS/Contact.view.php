<div class="Contact">
	<h1>Contact</h1>
	<form action="SEND.php" method="POST">
		<div>
		    <label>Naam<span>*</span></label>
		    <input type="text" name="PName" placeholder="....">
		</div>
		<div>
			<label>Email<span>*</span></label>
		    <input type="text" name="PEmail" placeholder="....">
		</div>
		<div>
			<label>Onderwerp<span>*</span></label>
		    <input type="text" name="PSubject" placeholder="....">	
		</div>
		<div>
			<label>Bericht<span>*</span></label>
		    <textarea name="PMessage" placeholder="...." rows="10"></textarea>
		</div>
		<input type="submit" name="submit" value="Verzenden">
	</form>
	
</div>