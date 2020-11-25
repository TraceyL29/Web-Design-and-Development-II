
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Calculator game</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      .center_div{
          margin: auto;
          width: 50%;
          /*border: 3px solid green;*/
          margin-top: 50px;
      }
	#change-profile, #play{
	margin: auto;

}

	#exit{
	margin-top: 10px;
	margin-right: 120px;
	}
    </style>

  </head>
  <body>
	 <div class="container center_div">
	 <?php
    	 echo '<h1 style="text-align: center;" class="h1">Welcome to multi-choice questions and answers, '.$_SESSION['userName'].'! </h1><br>'
      ?>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="MainPage">
	 <input type='hidden' name='command' value="play">
      <button type="submit" class="btn btn-success btn-lg" id="play">Play game</button>
	 </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="MainPage">
	 <input type='hidden' name='command' value="suggest">
	 <button type="submit" class="btn btn-success btn-lg" id="suggest">Suggest Question/Answer</button>
	 </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="MainPage">
	 <input type='hidden' name='command' value="listranking">
	 <button type="submit" class="btn btn-success btn-lg" id="ranking">List ranking</button>
	 </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="MainPage">
	 <input type='hidden' name='command' value="share">
	 <button type="submit" class="btn btn-success btn-lg" id="share">Share game</button>
	 </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="MainPage">
	 <input type='hidden' name='command' value="viewscore">
	 <button type="submit" class="btn btn-success btn-lg" id="viewscore">View your score</button>
      </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value='MainPage'>
	 <input type='hidden' name='command' value="changeprofile-unsubscribe">
	 <button type="submit" class="btn btn-success btn-lg" id="change-profile">Change Profile/Unsubscribe</button>
	 </form><br>
	 <form action='controller.php' method='post'>
	 <input type='hidden' name='page' value='MainPage'>
	 <input type='hidden' name='command' value="logout">
	 <button type="submit" class="btn btn-success btn-lg" id="change-profile">Log Out</button>
	 </form>

	</div>

    </body>
</html>