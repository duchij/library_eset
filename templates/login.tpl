<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter</title>
</head>

<body>
<div id="wrapper">
	<div id="header">
		{include file="header.tpl"}
	</div>
	<div id="content">
		
		<div id="content-main" style="width:250px;">
				
			<form method='post' action="index.php">
			
			<table>
				<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
				<tr><td>Heslo:</td><td> <input type="password" name="password"></td></tr>
				
			
			<tr><td colspan="2"><button formaction="index.php?login_fnc=1" type="submit">Prihlasit</button> 
			<button formaction="index.php?register_fnc=1"  >Vytvorit novy ucet</button>
			<button formaction="index.php?reset_fnc=1">Zabudnute heslo?</button></td></tr>
			
			</table>
			<a href="https://github.com/duchij/abstrakter/wiki/Ako-sa-prihl%C3%A1si%C5%A5%3F" target="_blank">Pomoc?</a>
			</form> 
			
		</div>
		 
		<div id="content-right" style="width:700px;">
		</div>
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
		
</div>

</body>

</html>