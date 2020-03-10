<div class="Inloggen">

	<h1>Registreren</h1>
	<?php 
	if (!empty($_SESSION['Error'])) { ?>
		<div class="Error">
			<h2>Oops, er is iets mis gegaan:</h2>
			<h3><?php echo $_SESSION['Error']; ?></h3>
		</div>
	<?php $_SESSION['Error'] = ""; } 
	?>
	<form action="CONTROL/System.php" method="POST">
		<div>
			<input type="text" name="Username" placeholder="Gebruikersnaam..." autocomplete="off" required>
		</div>
		<div>
			<input type="text" name="Email" placeholder="Email..." required>
		</div>
		<div>
			<input type="password" name="Password" placeholder="Wachtwoord..." required>
		</div>
		<div>
			<input type="password" name="RepeatPassword" placeholder="Herhaal Wachtwoord..." required>
		</div>
		<div>
		    <input type="submit" name="SignUp" value="Registreren">
		</div>
		<div>
			<a href="Inloggen">ik bezit al een account?</a>
		</div>
	</form>
	
</div>