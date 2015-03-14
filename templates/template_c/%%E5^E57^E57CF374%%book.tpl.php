<?php /* Smarty version 2.6.28, created on 2015-03-13 21:29:47
         compiled from book.tpl */ ?>
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
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		</div>

	<div id="content">
		<div id="content-left">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "main_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
			<div id="content-main" style="width:750px;">
			<h1> Pridaj/Uprav knihu</h1>
			<h3><?php echo $this->_tpl_vars['book']['message']; ?>
</h3>
<!-- 			<input type="hidden" value="<?php echo $this->_tpl_vars['book']['id']; ?>
"> -->
			
			<form name="form1" method='post' action="app.php">
			<input type="hidden" name="class" value="libs">
			<table>
				<tr>
					<td>Názov knihy:</td>
					<td><input type="text" name="name_txt" value="<?php echo $this->_tpl_vars['book']['name']; ?>
" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Podnázov:</td>
					<td><input type="text" name="subname_txt" value="<?php echo $this->_tpl_vars['book']['subname']; ?>
" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Autori:</td>
					<td><input type="text" name="autors_txt" value="<?php echo $this->_tpl_vars['book']['autors']; ?>
" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Vydavateľ:</td>
					<td><input type="text" name="bookprint_txt" value="<?php echo $this->_tpl_vars['book']['bookprint']; ?>
" style="width:300px;"></td>
				</tr>
				
				<tr>
					<td>ISBN Kód:</td>
					<td><input type="text" name="isbn_txt" value="<?php echo $this->_tpl_vars['book']['isbn']; ?>
" style="width:300px;"></td>
				</tr>
				<tr>
					<td>Počet:</td>
					<td><input type="text" name="amount_txt" value="<?php echo $this->_tpl_vars['book']['amount']; ?>
"><br>
					Jednotlivé tagy oddeliť čiarkou....</td>
				</tr>

				<tr>
					<td>TAG:</td>
					<td><input type="text" name="tags_txt" value="<?php echo $this->_tpl_vars['book']['tags']; ?>
"></td>
				</tr>

			</table>
				<button name="<?php echo $this->_tpl_vars['book']['action']; ?>
" value="<?php echo $this->_tpl_vars['book']['id']; ?>
">Ulozit	</button>
				<!-- div id="block" style="border:none;padding:0px;margin:0px">-->
		</form>
	</div>
	<div id="content-right">
		
		</div> 
	</div>
	<div id="footer"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<div id="bottom"></div>
	
</div>


</body>

</html>