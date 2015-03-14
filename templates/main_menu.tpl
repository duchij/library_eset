<ul>
		{if $admin}
<!-- 			<li><a href="app.php?addcon=1">Kongresy</a></li> -->
<!-- 			<li><a href="app.php?fform_fnc=1">FORM Designer</a></li> -->
			<hr>
		{/if}
			<form method="post" action="app.php">
				<input type="hidden" name="class" value="libs">
				<li><button name="run" value="1">Pridaj knihu</button></li>
				<li><button name="run" value="2">Hladat knihu</button></li>
				<li><button name="run" value="3">Pozicat knihu</button></li>
				<li><button name="logout" value="1">Odhlasit sa</button></li>
			</form>
</ul>