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
<div class="container" style="margin-top: 10px;">
	<form action='controller.php' method='post'>
	<input type='hidden' name='page' value="ShareGamePage">
	<input type='hidden' name='command' value='back'>
	<button type='submit' class='btn btn-success btn-lg'>BACK</button>
	</form>
</div>

<div class="container" style="margin: auto; text-align: center;">
<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//cs.tru.ca/~tlaif20/Project/controller.php">
<img border="0" alt="Facebook" src="include/images/facebook.png" width="50" height="50">
<p>Share on Facebook</p>
</a>
</div>
<div class="container" style="margin: auto; text-align: center;">
<a href="https://twitter.com/intent/tweet?text=http%3A//cs.tru.ca/~tlaif20/Project/controller.php">
<img border="0" alt="Facebook" src="include/images/twitter.png" width="50" height="50">
<p>Share on Twitter</p>
</a>
</div>

</body>
</html>
