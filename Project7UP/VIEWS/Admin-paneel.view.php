<?php 
//Troll people how not own an account.
if (empty($_SESSION['UserID'])) { ?>

    <div class="Error2">
	    <h1>Error: 404</h1>
	    <h1>Oops, er iets iets misgegaan.</h1>	   				
	</div>

<?php } elseif ($_SESSION['UserType'] == "OW" || $_SESSION['UserType'] == "AD") { ?>

	<div class="ADPanel">
	    <div class="PNav">
		    <ul>
			    <li><a href="admin-paneel/">Project</a></li>
			    <li><a href="admin-paneel/">User</a></li>
		    </ul>
	    </div>
	    <div class="WorkArea">
		    <div class="ProjectList">
			    <div><a href="admin-paneel/Nieuw">Project Toevoegen</a></div>
			    <ul>
				    <?php

				    require 'DATABASE/Config_Database.php';

		            mysqli_select_db($conn, $db['database']);

		            $query = "SELECT * FROM Projecten";
		            $result = mysqli_query($conn, $query);
		        
		                while ($row = mysqli_fetch_array($result)) { 
		                	$Dataimage = $row['ProjectDataImage']; ?>
		                <li>
					        <a href="admin-paneel/<?php echo $row['ProjectID']; ?>">
						        <img src="<?php echo (!empty($Dataimage)) ? 'data:image;base64,' . $Dataimage : 'IMG/Noimage.png' ?>">
						        <h3><?php echo $row['ProjectName']; ?></h3>
					        </a>
				        </li>
		        <?php } ?>
			    </ul>
		    </div>
		    <div class="Panel">
				    <?php
				    //
				    if ($_GET['action'] == "Nieuw" || empty($_GET['action'])){ ?>
				    	<form action="CONTROL/System.php" method="POST" enctype="multipart/form-data">
				    	    <div>
				                <img id="preview" src="IMG/Noimage.png">
		                        <input type="file" name="image" onchange="previewimage(event)">
		                    </div>
			                <div>
				                <label>ProjectNaam</label>
		                        <input type="text" name="ProjectName" placeholder="ProjectNaam..." autocomplete="off">
		                    </div>
		                    <div>
			                    <label>Categorie</label>
		                        <input type="text" name="ProjectCategory" placeholder="Categorie..."autocomplete="off">
		                    </div>
		                    <div>
			                    <label>Omschrijving</label>
		                        <textarea name="Projectdescription" placeholder="Omschrijving...." rows="10"></textarea>
		                    </div>
		        	            <input class="Sbtn" type="submit" name="InsertProject" value="Save nieuw project">
				    	</form>
		            <?php 
		            } else { 
		            	//
				        $query = "SELECT * FROM Projecten WHERE ProjectID=". $_GET['action'];
		                $result = mysqli_query($conn, $query);

		                    while ($row = mysqli_fetch_array($result)) { 
		                    	$Dataimage = $row['ProjectDataImage']; ?>

		                    	<form action="CONTROL/System.php" method="POST" enctype="multipart/form-data">
		        	                <div>
				                        <img id="preview" src="<?php echo (!empty($Dataimage)) ? 'data:image;base64,' . $Dataimage : 'IMG/Noimage.png' ?>">
		                                <input type="file" name="image" onchange="previewimage(event)">
		                            </div>
			                        <div>
				                        <label>ProjectNaam</label>
		                                <input type="text" name="ProjectName" placeholder="ProjectNaam..." value="<?php echo $row['ProjectName']; ?>" autocomplete="off">
		                                <input type="hidden" name="ProjectID" value="<?php echo $row['ProjectID']; ?>">
		                            </div>
		                            <div>
			                            <label>Categorie</label>
		                                <input type="text" name="ProjectCategory" placeholder="Categorie..." value="<?php echo $row['Category']; ?>" autocomplete="off">
		                            </div>
		                            <div>
			                            <label>Omschrijving</label>
		                                <textarea name="Projectdescription" placeholder="Omschrijving...." rows="10"><?php echo $row['ProjectDescription']; ?></textarea>
		                            </div>
		        	                <input class="Sbtn" type="submit" name="UpdateProject" value="Save wijziging">
		        	            </form>
		              <?php }
		                } ?>
		    </div>
	    </div>
    </div>
<?php 
} else { ?>
	<div class="Error2">
	    <h1>Sorry, maar je heb geen permissie</h1>	   				
	</div>
<?php } ?>