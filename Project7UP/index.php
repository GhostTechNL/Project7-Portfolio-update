<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="NL">
<head>

	<title>Tyno Portfolio | <?php if ($_GET['page'] == "index.php" || $_GET['page'] == "index"){ echo "Home"; } else { echo $_GET['page']; } ?></title>

	<base href="http://localhost/Project7UP/">

	<link rel="shortcute icon" type="image/x-icon" href="IMG/Logo.png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link rel="stylesheet" type="text/css" href="STYLE/StyleKIT.css">

	<meta charset="utf-8">
	<meta name="description" content="Zoek u een programmeur die voor u een website of applicatie wilt bouwen? Dan bent u op het juiste adres. Kijk op mijn portfolio voor meer informatie of om mij te contacteren.">
	<meta name="keywords" content="Programmeur, Website designer, Applicatie ontwikkelaar, Portfolio">
	<meta name="author" content="Tyno schrama">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

	<div class="Brothers">
		<?php require 'Header.inc.php'; ?>

	    <main>
	    	<?php
	    	//Check over page leeg is
	    	if (empty($_GET['page'])) {
	    		header("location: Home/");
	    	}
	    	//zorgt er voor dat index als Home wordt weergeven.
	    	elseif ($_GET['page'] == "Home" || $_GET['page'] == "index.php") {
	    		require 'VIEWS/index.view.php';
	    	}
	    	elseif ($_GET['page'] == "Uitloggen") {
	    		header("location: ../CONTROL/System.php?action=Uitloggen");
	    	} 
	    	else{
	    		$page = 'VIEWS/'.$_GET['page'].'.view.php';
	    		if (file_exists($page)) {
	    			include ($page);
	    		} else {
	    			?>
	    			<div class="Error2">
	    				<h1>Error: 404</h1>
	    			    <h1>Oops, er iets iets misgegaan.</h1>	   				
	    			</div>
	    			<?php
	    		}
	    	}
	    	?>
	    </main>
	</div>
	
	<?php require 'Footer.inc.php'; ?>

	<script type="text/javascript" src="JS/WebJsKit.js"></script>
</body>
</html>