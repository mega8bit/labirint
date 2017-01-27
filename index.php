<?php 
	define("LABIRINT_SIZE_Y",130);
	define("LABIRINT_SIZE_X",50);
	if(isset($_POST['go'])){
		
		$map = [LABIRINT_SIZE_X][LABIRINT_SIZE_Y];
		$y_coord = 0;
		$x_coord = 0;
		for($i = 0;$i<=LABIRINT_SIZE_X;$i++){
			for($j = 0;$j<=LABIRINT_SIZE_Y;$j++){
				$map[] = [
					[$x_coord,$y_coord,$x_coord,$y_coord+10],
					[$x_coord,$y_coord,$x_coord+10,$y_coord],
				];
				$x_coord+=10;
			}
			$y_coord +=10;
			$x_coord = 0;
		}
		for($i = 0;$i<LABIRINT_SIZE_X;$i++){
			$map[$i][0] = null;
		}
		for($i = LABIRINT_SIZE_X;$i<count($map);$i++){
			$d = rand(1,2);
			if($d == 1){
				$map[$i][0] = null;
			}
			if($d == 2){
				$map[$i][1] = null;
			}
		}	

		$map = json_encode($map);
		//echo('<pre>');
		//	var_dump($map);
		//echo('</pre>');		
	}
?>

<h1>Go To labirint!</h1>
<form method="POST">
	<input type="hidden" name="go" value="go">
	<input type="submit" value="GO">
</form>

<?php if(!empty($map)): ?>

<canvas id="canvas" width="1250" height="1000">
	
</canvas>

<script>
	var canvas = document.getElementById("canvas");
	var ctx = canvas.getContext("2d");
	var map = JSON.parse("<?= $map ?>");
	console.log(map);
	for(i = 0;i<map.length;i++){
		for(j = 0;j<map[i].length;j++){
			if(map[i][j] == null){
				continue;
			}
			ctx.beginPath();
    			ctx.lineWidth = 1;
    			ctx.strokeStyle = 'red';
			ctx.moveTo(map[i][j][0],map[i][j][1]);
			ctx.lineTo(map[i][j][2],map[i][j][3]);
			ctx.stroke();
		}
	}
	ctx.strokeRect(0,0,1250,510);
	
</script>

<?php endif; ?>
