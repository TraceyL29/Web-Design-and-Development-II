
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
<div class="container" style="margin-top: 10px;">
	<form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="viewscorePage">
	 <input type='hidden' name='command' value="back">
      <button type="submit" class="btn btn-success btn-lg" id='back'>BACK</button>
	</form>
</div>

<h1 style="text-align: center;" class="h1">Your past score</h1>
<div class="container" id='pastscore' style="text-align: center;">
</div>

</body>
</html>
<script>

	var url='controller.php';
	var query={page: 'viewscorePage', command: 'viewscore', playername: "<?php echo $_SESSION['userName']?>"};
	$.post(url, query, function(data){
	alert(data);
	var rows= JSON.parse(data);
	       var t = '<table style="width: 80%;" class="table table-bordered table-condensed">';
            t+='<tr>';
            for(var p in rows[0])
            t+='<th style="text-align: center;"> '+p+' </th>';
            t+='</tr>';
            for (var i = 0; i < rows.length; i++) {  // for each row
                t += '<tr>';
                for (var p in rows[i])  // for each property
                    t += '<td> ' + rows[i][p] + ' </td>'; // the property value, not the property name 
                t += '</tr>';
            }
        t += '</table>';
        $('#pastscore').html(t);
});
</script>