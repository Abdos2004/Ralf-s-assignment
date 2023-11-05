<?php 

include "Connection.php";

if (isset($_POST['newname']) && isset($_POST['confirmpsw'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $newname = validate($_POST['newname']);

    $confirmpsw = validate($_POST['confirmpsw']);

    if (empty($newname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($confirmpsw)){

        header("Location: index.php?error=New password is required");

        exit();

    }else{

        $sql = "SELECT * FROM userdata WHERE user_name='$newname'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $newname ) {

                echo '<script>alert("Username exist! Use another username.");
            	window.location.href="index.php";</script>';

                exit();

            }

        }else{
			$sql = "INSERT INTO userdata (user_name,password) VALUES ('$newname', '$confirmpsw')";

			if ($conn->query($sql) === TRUE) {
			  echo '<script>alert("Proceed to Log In");
			   window.location.href="index.php";</script>';
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}


$mysqli -> close();
?>