<p><b>Enter path to PHPlib directory</b>
<form action="install.php">
<input type="hidden" name="action" value="set_phplib">
<input type="hidden" name="op" value="set">
<table border="0">
<tr><td>Path to PHPlib directory:</td>
<td><input name="phplibpath" value="<?php echo $phplibdefault?>"></td></tr>
<tr><td></td>
<td><input type="submit" value="Submit"></td></tr>
</table>
</form>
<p>[ <a href="install.php">Go back</a> ]
