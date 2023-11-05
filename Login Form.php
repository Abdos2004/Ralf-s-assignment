<?php 

session_start(); 

include "Connection.php";

if (isset($_POST['uname']) && isset($_POST['psw'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $psw = validate($_POST['psw']);

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($psw)){

        header("Location: index.php?error=psw is required");

        exit();

    }else{

        $sql = "SELECT * FROM userdata WHERE user_name='$uname' AND password='$psw'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $psw) {

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                if ($uname == 'admin'){
                    header("Location: adminhome.php");
                }else{
                    header("Location: userhome.php");
                }
            

                exit();

            }else{

            	echo '<script>alert("Incorrect username or password!");
            	window.location.href="index.php";</script>';

                exit();

            }

        }else{
        	echo '<script>alert("Incorrect username or password!");
        	window.location.href="index.php";</script>';

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}
$mysqli -> close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="Login Form.css" />
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>
