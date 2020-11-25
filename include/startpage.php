<!DOCTYPE html>
<html lang="en">
<head>
  <title> Multi-choice questions and answers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
 

    .center_div{
        margin: auto;
        width: 40%;
        /* border: 3px solid green; */
    }

  </style>
<script>
</script>
</head>
<body>
<h1 style="text-align: center;">Welcome to multi-choice questions and answers</h1>


<div class="container center_div" id="login-form">
  <h2>Login</h2>
  <form action="controller.php" method='post'>
  <input type='hidden' name='page' value='StartPage'>
  <input type='hidden' name='command' value='SignIn'>
    <div class="form-group">
      <div class="row">
      <div class="col-xs-8">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
      <?php
      if (!empty($error_msg_username))
         echo $error_msg_username;
      ?>

    </div>
    </div>
  </div>
    <div class="form-group">
      <div class="row">
      <div class="col-xs-8">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
      <?php
      if (!empty($error_msg_password))
         echo $error_msg_password;
      ?>

    </div>
    </div>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-primary" id="signup">Signup</button>
  </form>
</div>

<div class="container center_div" style="display:none;" id="signup-form">
  <h2>Signup</h2>
  <form action="controller.php" method='post'>
  <input type='hidden' name='page' value='StartPage'>
  <input type='hidden' name='command' value='Join'>
    <div class="form-group">
      <div class="row">
      <div class="col-xs-8">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
		<?php
			if(!empty($error_msg_username)){
		  		if ($error_msg_username == '* Wrong username'){
		    			echo '';
					}
		  		if ($error_msg_username == '* Username already exists'){
                    	echo $error_msg_username;}}
                 ?>

    </div>
  </div>
</div>
    <div class="form-group">
      <div class="row">
      <div class="col-xs-8">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
    </div>
  </div>
</div>
    <div class="form-group">
      <div class="row">
      <div class="col-xs-8">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
  </div>
</div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
<script>

$("#signup").click(function(){
  $("#signup-form").show();
  $("#login-form").hide();
  });

<?php
     if(!empty($display_type)){
	if ($display_type == 'signin'){
            echo '$("#signup-form").hide();';
		  echo '$("#login-form").show();';
	}
        if ($display_type == 'join'){
            echo '$("#login-form").hide();';
		  echo '$("#signup-form").show();';
	}
   }      
?>

</script>
