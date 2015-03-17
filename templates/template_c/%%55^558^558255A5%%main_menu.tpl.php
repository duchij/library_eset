<?php /* Smarty version 2.6.28, created on 2015-03-16 20:36:39
         compiled from main_menu.tpl */ ?>
<h2>Menu</h2><hr>
<ul>
		<?php if ($this->_tpl_vars['admin']): ?>
<!-- 			<li><a href="app.php?addcon=1">Kongresy</a></li> -->
<!-- 			<li><a href="app.php?fform_fnc=1">FORM Designer</a></li> -->
			<hr>
		<?php endif; ?>
			<form method="post" action="app.php">
				<input type="hidden" name="class" value="libs">
				<li><button name="run" value="1">Pridaj knihu</button></li>
				<li><button name="run" value="2">Hľadať knihu</button></li>
				<li><button name="run" value="3">Požičane knihy</button></li>
				<li><button name="logout" value="1">Odhlásit sa</button></li>
			</form>
</ul>