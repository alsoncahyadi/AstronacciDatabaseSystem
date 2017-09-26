<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Template</title>
  <meta name="description" content="Layout?">
  <meta name="author" content="SimpliCty">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/styling.css">
</head>

<body style="overflow-x:hidden">
	<?php include "header1.php" ?>
	<br>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="title">Dashboard</div>
			<br>
			<div style="margin-left:24px;font-size:18px">filter</div>
			<div style="height:96px; width:512px; border: 2px solid red; border-radius: 10px;"></div>
			<br>
			<?php include "table-x.php" ?>
			<br>
			<div style="float:right">
				<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color:red;height:25px;padding-top:0px;">Assign to
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#">Sales</a></li>
					<li><a href="#">UnSales</a></li>
				</ul>
			  </div>
			</div>			
			<br><br>
			<div class="row">
				<div class="col-sm-1"><a href="#"><img src="../ass/addcli.png"/></a></div>
				<div class="col-sm-1"><a href="#"><img src="../ass/import.png"/></a></div>
				<div class="col-sm-1"><a href="#"><img src="../ass/download.png"/></a></div>
				<div class="col-sm-8"></div>
				<div class="col-sm-1"><a href="#"><img src="../ass/confirm.png"/></a></div>
			</div>
		<div class="col-sm-1"></div>
	</div>
</body>
</html>