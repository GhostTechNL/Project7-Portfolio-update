<?php
// ====================== | Login & logout & signup System | ======================


//Login
if (filter_input(INPUT_POST, "Login")) {
	session_start();

	$_SESSION['Error'] = "";
	require '../DATABASE/Config_Database.php';

	$Username = $_POST['Username'];
	$Password = $_POST['Password'];

	if (empty($Username) || empty($Password)) {
		//
		header("Location: ../inloggen/");
		$_SESSION['Error'] = "Invoervelden zijn leeg";
		exit();
	} else {
		$sql = "SELECT * FROM Users WHERE UserName=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			//
			header("Location: ../inloggen/");
		  $_SESSION['Error'] = "Inlog Error";
		  exit();
		} else {
			//
			mysqli_stmt_bind_param($stmt, "s", $Username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($Password, $row['UserPassword']);
				if ($pwdCheck == false) {
					//Password is invalid
					header("Location: ../inloggen/");
		            $_SESSION['Error'] = "Wachtwoord is fout";
		            exit();
				} else if($pwdCheck == true){
					//Password is valid
					$_SESSION['Error'] = "";
					//
					$_SESSION["UserID"] = $row["UserID"];
					$_SESSION["UserType"] = $row["UserType"];
					//
					$sql = "SELECT LogID FROM Log";
                    $result = mysqli_query($conn, $sql);
                    $last_id = mysqli_num_rows($result) + 1;

                    $_SESSION['LogID'] = $last_id;
                    //
                    $sql = "INSERT INTO `Log` SET
                            `LogID` = '". $last_id ."',
                            `UserID` = '". $row['UserID'] ."',
                            `IpAdress` = '". $_SERVER['REMOTE_ADDR'] ."',
                            `Inlogtijd` = '". date('H:i:s') ."'";

                    mysqli_query($conn, $sql);
					//
					header("Location: ../Home/");
					exit();
				} else {
					//Password is invalid
					header("Location: ../inloggen/");
		            $_SESSION['Error'] = "Wachtwoord is fout";
		            exit();
				}
			} else {
				header("Location: ../inloggen/");
		        $_SESSION['Error'] = "Gebruikersnaam & wachtwoord is fout";
		        exit();
			}
		}
	}
}



//logout
if (filter_input(INPUT_GET, "action") == "Uitloggen" ) {

	require '../DATABASE/Config_Database.php';
	
	//phase 1: start the session | phase 2: empty the session | phase 3: destory the last living thing in the session.
	session_start();

	$sql = "UPDATE `Log` SET
	        `uitlogtijd` = '". date('H:i:s') ."'
	        WHERE `LogID` = '". $_SESSION['LogID'] ."'";
	mysqli_query($conn, $sql);

	session_unset();
	session_destroy();
	//return to the Home page
	header("Location: ../index.php");
}



//Sign up
if (filter_input(INPUT_POST, "SignUp")) {
  session_start();

  require '../DATABASE/Config_Database.php';

  $username = $_POST['Username'];
  $email = $_POST['Email'];
  $password = $_POST['Password'];
  $passwordRepeat = $_POST['RepeatPassword'];

  //
  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../Registreren/");
    $_SESSION['Error'] = "Invoervelden zijn leeg";
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../Registreren/");
    $_SESSION['Error'] = "Email & gebruikersnaam zijn ongeldig";
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../Registreren/");
    $_SESSION['Error'] = "Email is niet geldig";
    exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../Registreren/");
    $_SESSION['Error'] = "Gebruikersnaam gebruikt ilegalen karakters";
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../Registreren/");
    $_SESSION['Error'] = "De ingevoerde wachtwoord zijn niet het zelfde";
    exit();
  }
  else {

    //
    $sql = "SELECT UserName FROM Users WHERE UserName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      //
      header("Location: ../Registreren/");
      $_SESSION['Error'] = "Registreren Mislukt!";
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        //
        header("Location: ../Registreren/");
        $_SESSION['Error'] = "Email is algebruikt";
        exit();
      }
      else {

        $sql = "INSERT INTO Users (UserName, UserEmail, UserPassword, UserType) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          //
          header("Location: ../Registreren/");
          $_SESSION['Error'] = "Registreren Mislukt!";
          exit();
      }
      else {
        $accounttype = "NU";
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPwd, $accounttype);
        mysqli_stmt_execute($stmt);

        //
        header("Location: ../inloggen/");
        $_SESSION['Message'] = "Registreren is gelukt!";
        exit();
      }

    }
  }

  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
// ====================== | Insert & Update Project | ======================


//Insert a new project in the database
if (filter_input(INPUT_POST, "InsertProject")) {
  //
  require '../DATABASE/Config_Database.php';

  $ProjectName = $_POST['ProjectName'];
  $ProjectCategory = $_POST['ProjectCategory'];
  $ProjectDescription = $_POST['Projectdescription'];

  $img = addslashes($_FILES['image']['tmp_name']);
  $filename = addslashes($_FILES['image']['name']);
  $img = file_get_contents($img);
  $img = base64_encode($img);

  mysqli_select_db($conn, $db['database']);

  $sql = "INSERT INTO `Projecten` SET
         `ProjectName` = '". $ProjectName ."', 
         `ProjectDescription` = '". $ProjectDescription ."',
         `Category` = '". $ProjectCategory ."',
         `ProjectNameImage` = '". $filename ."',
         `ProjectDataImage` = '". $img ."'";

  mysqli_query($conn,$sql);

  header("location: ../Admin-paneel/");

}



//Update an already project
if (filter_input(INPUT_POST, "UpdateProject")) {
  //
  require '../DATABASE/Config_Database.php';
  //
  $ProjectID = $_POST['ProjectID'];
  $ProjectName = $_POST['ProjectName'];
  $ProjectCategory = $_POST['ProjectCategory'];
  $ProjectDescription = $_POST['Projectdescription'];

  $img = addslashes($_FILES['image']['tmp_name']);
  $filename = addslashes($_FILES['image']['name']);
  $img = file_get_contents($img);
  $img = base64_encode($img);

  mysqli_select_db($conn, $db['database']);

  $sql = "UPDATE `Projecten` SET
         `ProjectName` = '". $ProjectName ."', 
         `ProjectDescription` = '". $ProjectDescription ."',
         `Category` = '". $ProjectCategory ."',
         `ProjectNameImage` = '". $filename ."',
         `ProjectDataImage` = '". $img ."'
         WHERE `ProjectID` = '". $ProjectID ."'";

  mysqli_query($conn,$sql);

  header("location: ../Admin-paneel/");
}




//Delete a Project
if (filter_input(INPUT_POST, "DeleteProject")) {
  //
  require '../DATABASE/Config_Database.php';
  //
  $ProjectID = $_POST['ProjectID'];

  mysqli_select_db($conn, $db['database']);

  $sql = "DELETE FROM `Projecten`
         WHERE `ProjectID` = '". $ProjectID ."'";

  mysqli_query($conn,$sql);

  header("location: ../Admin-paneel/");

}
?>