<?php /* Smarty version 2.6.28, created on 2015-03-12 11:11:32
         compiled from test.tpl */ ?>
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
			
			
			<div id="formular">
			<form name="form1" method='post' action="app.php">
			
				
				<div id="block" style="border:none;padding:0px;margin:0px">
				
				</table>
				
				
			</div>
			
			
		</form>
		</div>
	
	</div>
	<!-- <div id="content-right">
			 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "regbyuser.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><hr/>
 			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "avabkongres.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
		</div> -->
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