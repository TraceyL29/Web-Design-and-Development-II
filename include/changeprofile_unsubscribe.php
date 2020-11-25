<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Calculator game</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

<body>
<div 
<div class="container" style='margin-top:10px;'>
	<form action='controller.php' method='post'>
	<input type='hidden' name='page' value="changeprofile-unsubscribePage">
	<input type='hidden' name='command' value='back'>
	<button type='submit' class='btn btn-success btn-lg'>BACK</button>
	</form>
</div>
<div class="container">
	<h1 style="text-align: center;" class="h1">Change profile/ Unsubcribe</p><br>
	<button type='button' class='btn btn-success btn-lg' id='unsubscribe'>Unsubscribe</button>
 	<p id='message'></p>
  	<label >Username:</label>
  	<input type="text" id="username" name="username" placeholder="enter your username"><br><br>
  	<label for="email">Email:</label>
  	<input type="text" id="email" name="email" placeholder="enter your email"><br><br>
	<label for="password">Password:</label>
  	<input type="text" id="password" name="password" placeholder="enter your email"><br><br>
  	<input type="button" value="Submit" class="btn btn-success btn-lg" id='changeprofile'>
	<p id='message2'></p>

</div>
</body>
</html>
<script>

//button unsubcribe
$('#unsubscribe').click(function(){
	var url='controller.php';
	var query={page: 'changeprofile-unsubscribePage', command: 'unsubscribe', playername: "<?php echo $_SESSION['userName'];?>"};
	$.post(url, query, function(data){
	$('#message').html('successful unsubscribe!');
});
});

//submit changed infromation 
$('#changeprofile').click(function(){
	var url='controller.php';
	var username= $('#username').val();
	var email= $('#email').val();
	var password=$('#password').val();
	var query={page: 'changeprofile-unsubscribePage', command: 'changeprofile', playername: username, playeremail: email, playerpassword: password};
	$.post(url, query, function(data){
	$('#message2').html('your information is changed!');
});
});

</script>