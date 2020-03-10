<div class="Inloggen">

	<h1>Inloggen</h1>
	<?php 
	if (!empty($_SESSION['Error'])) { ?>
		<div class="Error">
			<h2>Oops, er is iets mis gegaan:</h2>
			<h3><?php echo $_SESSION['Error']; ?></h3>
		</div>
	<?php $_SESSION['Error'] = ""; 
    } elseif (!empty($_SESSION['Message'])) { ?>
		<div class="message">
			<h2>Leuke Error:</h2>
			<h3><?php echo $_SESSION['Message']; ?></h3>
		</div>
	<?php $_SESSION['Message'] = ""; 
    }
	?>
	<form action="CONTROL/System.php" method="POST">
		<div>
			<input type="text" name="Username" placeholder="Gebruikersnaam..." autocomplete="off">
		</div>
		<div>
			<input type="password" name="Password" placeholder="Wachtwoord...">
		</div>
		<div>
		    <input type="submit" name="Login" value="Inloggen">
		</div>
		<div>
			<a href="Registreren/">Nog geen account?</a>
		</div>
	</form>
	
</div>