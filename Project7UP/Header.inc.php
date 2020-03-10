<?php #Note: Home, Over mij, Skills, Contact, inloggen ?>
<nav>
	<figure>
	    <img src="IMG/Logo.png">
	</figure>
	<ul>
		<li><a href="Home/"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="Over-mij/"><i class="fas fa-user"></i>Over mij</a></li>
		<li><a href="Skills/"><i class="fas fa-award"></i>Skills</a></li>
		<li><a href="Contact/"><i class="fas fa-envelope"></i>Contact</a></li>
		<?php if (!isset($_SESSION['UserID'])) { ?>
		    <li><a href="Inloggen/"><i class="fas fa-id-card"></i>Inloggen</a></li>
		<?php } elseif($_SESSION['UserType'] == "OW" || $_SESSION['UserType'] == "AD"){ ?>
			<li><a href="Admin-paneel/"><i class="fas fa-database"></i>Admin</a></li>
		    <li><a href="Uitloggen/"><i class="fas fa-power-off"></i>Uitloggen</a></li>
		<?php } else { ?>
			<li><a href="Uitloggen/"><i class="fas fa-power-off"></i>Uitloggen</a></li>
		<?php }
		?>
	</ul>

	<div class="Social">
		<a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
		<a href="https://www.linkedin.com/in/tynoschrama/"><i class="fab fa-linkedin"></i></a>
		<a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
	</div>
</nav>