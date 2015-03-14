<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" type="text/css" href="css/layout.css" >

<!-- <link rel="stylesheet" type="text/css" href="js/src/fancyfields.css" > -->

<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>	
<script src="js/abstracter.js"></script>

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
		<div id="content-main" style="width:750px;">

			<h1> Pridaj/Uprav knihu</h1>
			<h3>{$book.message}</h3>
<!-- 			<input type="hidden" value="{$book.id}"> -->
			
			<form name="form1" method='post' action="app.php">
			<input type="hidden" name="class" value="libs">
			<table>
				<tr>
					<td>Názov knihy:</td>
					<td><input type="text" name="name_txt" value="{$book.name}" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Podnázov:</td>
					<td><input type="text" name="subname_txt" value="{$book.subname}" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Autori:</td>
					<td><input type="text" name="autors_txt" value="{$book.autors}" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Vydavateľ:</td>
					<td><input type="text" name="bookprint_txt" value="{$book.bookprint}" style="width:300px;"></td>
				</tr>
				
				<tr>
					<td>ISBN Kód:</td>
					<td><input type="text" name="isbn_txt" value="{$book.isbn}" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Počet:</td>
					<td><input type="text" name="amount_txt" value="{$book.amount}"><br>
					Jednotlivé tagy oddeliť čiarkou....</td>
				</tr>

				<tr>
					<td>TAG:</td>
					<td><input type="text" name="tags_txt" value="{$book.tags}"></td>
				</tr>

			</table>
				<button name="{$book.action}" value="{$book.id}">Ulozit	</button>
				
		</form>
	</div>
	<div id="content-right">
		
	</div> 

	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>


</body>

</html>