<div class="Skill">
	<div class="SkillMeter">
		<h1>Mijn skills</h1>
		<ul>
			<li>
				<div>
					<h3>HTML & CSS</h3>
				    <div class="procent-bar"><div id="HTML" class="procent"><span>80%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>Web design</h3>
				    <div class="procent-bar"><div id="WEB" class="procent"><span>50%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>Javascript</h3>
				    <div class="procent-bar"><div id="JS" class="procent"><span>50%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>PHP</h3>
				    <div class="procent-bar"><div id="PHP" class="procent"><span>60%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>SQL</h3>
				    <div class="procent-bar"><div id="SQL" class="procent"><span>50%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>C#</h3>
				    <div class="procent-bar"><div id="CSHARP" class="procent"><span>30%</span></div></div>
				</div>
			</li>
			<li>
				<div>
					<h3>Java</h3>
				    <div class="procent-bar"><div id="JAVA" class="procent"><span>20%</span></div></div>
				</div>
			</li>				
		</ul>
	</div>
	<div class="Projecten">
		<h1>Projecten</h1>
		<ul>
			<?php
            require 'DATABASE/Config_Database.php';

            mysqli_select_db($conn, $db['database']);
            
            $query = "SELECT ProjectID,ProjectName,ProjectDataImage FROM Projecten";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
            	$Dataimage = $row['ProjectDataImage']; ?>
			<li>
				<a href="ProjectV/<?php echo $row['ProjectID']?>">					
					<img src="<?php echo (!empty($Dataimage)) ? 'data:image;base64,' . $Dataimage : 'IMG/Noimage.png' ?>">
				    <h2><?php echo $row['ProjectName'];?></h2>
				</a>
			</li>
		<?php }	?>
		</ul>
	</div>
</div>