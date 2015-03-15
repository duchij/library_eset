<?php /* Smarty version 2.6.28, created on 2015-03-15 19:35:33
         compiled from search.tpl */ ?>
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
		
	<div id="content-main" style="width:550px;">
			<h3><?php echo $this->_tpl_vars['book']['message']; ?>
</h3>
<!-- 			<input type="hidden" value="<?php echo $this->_tpl_vars['book']['id']; ?>
"> -->
			
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
					<td><input type="text" name="phrase" value="<?php echo $this->_tpl_vars['search_phrase']; ?>
"></td>
					<td><button name="search_fnc">Hladaj</button>
				<tr>
					<td><input type="checkbox" name="inword" value="yes">Hladaj v strede slova (inak hlada od zaciatku slova)
				</tr>

			</table>
			<hr>
			<h2><?php echo $this->_tpl_vars['search_result']; ?>
</h2>
			<hr>
			<table width="100%">
				<tr>
					<td><strong>Nazov</strong></td>
					<td><strong>Pocet volnych kusov</strong></td>
					<td colspan="3"><strong>Akcia</strong></td>
			<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['row']):
?>
				<tr>
					<td><?php echo $this->_tpl_vars['row']['name']; ?>
</td>
					<td><?php echo $this->_tpl_vars['row']['amount']; ?>
</td>
					<td>
						<?php if ($this->_tpl_vars['row']['amount'] > 0): ?>
							<button name="borrow_fnc" value="<?php echo $this->_tpl_vars['row']['id']; ?>
">Požičať</button>
						<?php endif; ?>
					</td>
					<td><button name="edit_fnc" value="<?php echo $this->_tpl_vars['row']['id']; ?>
">Editovať</button></td>
					<td><button name="delete_fnc" value="<?php echo $this->_tpl_vars['row']['id']; ?>
">Zmazať</button></td>
				</tr>
            <?php endforeach; endif; unset($_from); ?>
			</table>
		</form>
		</div>
	
	<div id="content-right">
			nieco 
		
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