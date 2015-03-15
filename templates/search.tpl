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
		
	<div id="content-main" style="width:550px;">
			<h3>{$book.message}</h3>
<!-- 			<input type="hidden" value="{$book.id}"> -->
			
			<form name="form1" method='post' action="app.php">
			<input type="hidden" name="class" value="libs">
			<table>
				<tr>
					<td> Hľadaj v </td>
					<td> <select name="searchin"> 
							<option value="name">V nazve</option>
							<option value="autor">V autoroch</option>
							<option value="isbn">Podla ISBN</option>
						</select>
					</td>
					<td><input type="text" name="phrase" value="{$search_phrase}"></td>
					<td><button name="search_fnc">Hladaj</button>
				<tr>
					<td><input type="checkbox" name="inword" value="yes">Hladaj v strede slova (inak hlada od zaciatku slova)
				</tr>

			</table>
			<hr>
			<h2>{$search_result}</h2>
			<hr>
			<table width="100%">
				<tr>
					<td><strong>Nazov</strong></td>
					<td><strong>Pocet volnych kusov</strong></td>
					<td colspan="3"><strong>Akcia</strong></td>
			{foreach from=$result key=i item=row}
				<tr>
					<td>{$row.name}</td>
					<td>{$row.amount}</td>
					<td>
						{if $row.amount > 0}
							<button name="borrow_fnc" value="{$row.id}">Požičať</button>
						{/if}
					</td>
					<td><button name="edit_fnc" value="{$row.id}">Editovať</button></td>
					<td><button name="delete_fnc" value="{$row.id}">Zmazať</button></td>
				</tr>
            {/foreach}
			</table>
		</form>
		</div>
	
	<div id="content-right">
			nieco 
		
		</div> 
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>


</body>

</html>