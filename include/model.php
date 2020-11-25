<?php
$conn = mysqli_connect('localhost', 'tlaif20', 'independentlife', 'C354_tlaif20');
if (mysqli_connect_errno())
    echo 'Failed to connect to SQL: ' . mysqli_connect_error();

//check if the username and password correct
function check_validity($username, $password){
  global $conn;
  $sql="select username, password from Players where username='$username' and password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result)>0) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

//check if the username exists
function check_existence($username){
  global $conn;
  $sql= "select username from Players where username= '$username'";
  $result= mysqli_query($conn, $sql);
  if (mysqli_num_rows($result)>0) {
        return TRUE;
      }
  else{
  return FALSE;
}
}

//add user 
function join_user($username, $password, $email){
	$current_date = date("Ymd");  
	if(!check_existence($username)){
		global $conn;
		$sql= "insert into Players (id, username, password, email, date) values (NULL, '$username', '$password', '$email','$current_date')";
		mysqli_query($conn, $sql);
		return TRUE;
		}
		else{
		return FALSE;
		}
	
}

//get user id
function get_user_id($username){
	global $conn;
	$sql= "select username, id from Players where username= '$username'";
	$result= mysqli_query($conn, $sql);
    	while ($row= mysqli_fetch_assoc($result)) {
        	return $row['id'];
	}
}

//unsubcribe/delete player in Players table and Score table
function unsubscribe($userid){
    global $conn;  
    $sql = "delete from Players where id='$userid'";
    $sql2= "delete from Score where userid='$userid'";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    if ($result==true&&$result2==true){
	return true;
	}
	else{
	return false;
	}
}

//change profile
function change_profile($userid, $username, $email, $password){
	global $conn;
	$sql= "update Players set username='$username', email='$email', password='$password' where id='$userid'";
	$result= mysqli_query($conn,$sql);
	if($result){
	return true;
	}
	else{
	return false;
	}
}

 ?>
