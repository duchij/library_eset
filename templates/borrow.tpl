<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Kniznica - zapozicane knihy</title>	
<link rel="stylesheet" type="text/css" href="css/layout.css">

<!-- <script src="js/jquery.js"></script>
<script src="js/src/fancyfields-1.2.min.js"></script> -->

</head>
<body>
<div id="wrapper">
		<div id="header">
			{include file="header.tpl"}
		
		</div>

	<div id="content">
		<div id="content-left">
			{include file="main_menu.tpl"}
		</div>
		<div id="content-main" style="width:550px;">

			<h1>Zapožičané knihy</h1>
			<h3>{$book.message}</h3>
			
			<form name="form1" method='post' action="app.php">
			<input type="hidden" name="class" value="libs">

			     {foreach from=$borrow key=i item=row}
					

			     {/foreach}	
				
			</form>
		</div>
		<div id="content-right">
			<h1>Moje značky</h1><hr>
		</div> 

	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>


</body>

</html>