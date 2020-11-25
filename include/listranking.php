
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
	 <input type='hidden' name='page' value="listrankingPage">
	 <input type='hidden' name='command' value="back">
      <button type="submit" class="btn btn-success btn-lg" id='back'>BACK</button>
	</form>
</div>
<h1 style="text-align: center;" class="h1">List Ranking </h1>

<div class="container" id='listranking'">
</div>

</body>
</html>
<script>

	var url='controller.php';
	var query={page: 'listrankingPage', command: 'ranking'};
	$.post(url, query, function(data){
	var rows= JSON.parse(data);
	
		//take out the header of table 	
	       var t = '<table style="width:80%; text-align: center;" class="table table-bordered table-condensed">';
            t+='<tr>';
            for(var p in rows[0][0]){
            t+='<th style="text-align: center;"> '+p+' </th>';
			}
		  for(var p in rows[1][0]){
            t+='<th style="text-align: center;"> '+p+' </th>';
            t+='</tr>';
		  
		}
//list ranking of username
	var list_username=[];
	for (var i = 0; i < rows[1].length; i++) { 
		for(var p in rows[1][i])
			list_username.push(rows[1][i][p]);
	}
	
//list ranking of score
            for (var i = 0; i < rows[0].length; i++) {  // for each row
                t += '<tr>';
			 for (var p in rows[0][i]){  // for each property
                    t += '<td> ' + rows[0][i][p] + '</td>'; }
				t+='<td>' + list_username[i] +'</td>';
				t += '</tr>';
		
			
              
            }
        t += '</table>';
        $('#listranking').html(t);
});

</script>