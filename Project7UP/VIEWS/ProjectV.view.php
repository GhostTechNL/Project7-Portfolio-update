<div class="ProjectV">
    <div class="Projectdisplay">
        <?php

        if ($_GET['action']) {
            require 'DATABASE/Config_Database.php';

            mysqli_select_db($conn, $db['database']);
            
            $query = "SELECT * FROM Projecten WHERE ProjectID=". $_GET['action'];
            $result = mysqli_query($conn, $query);
                   
            while ($row = mysqli_fetch_array($result)) { 
                $Dataimage = $row['ProjectDataImage'];?>

    	       <div>
    		      <h1><?php echo "Project: " . $row['ProjectName']; ?></h1>
    		      <p><?php echo $row['ProjectDescription']; ?></p>
    	       </div>
    	       <div>
    		      <img src="<?php echo (!empty($Dataimage)) ? 'data:image;base64,' . $Dataimage : 'IMG/Noimage.png' ?>">
    	       </div>
           <?php } 
        }?>
    </div>
</div>