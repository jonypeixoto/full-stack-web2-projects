<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		.parent{
			margin: 0 auto;
			max-width: 900px; 
			display: flex;
			flex-wrap: wrap;
		}

		.box1{
			float: left;
			width: 50%;
			height: 500px;
			background: red;
		}

		.box2{
			float: left;
			width: 50%;
			height: 200px;
			background: orange;
		}
	</style>
</head>
<body>

<div class="parent">
	<div class="box1"></div>
	<div class="box2"></div>
	<div style="background:purple;" class="box2"></div>
</div><!--parent-->

</body>
</html>