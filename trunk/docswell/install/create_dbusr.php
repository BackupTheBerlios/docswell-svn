<p><b>Enter Database Parameters to create <?php echo $sys_name?> Database User</b>
<form action="install.php">
<input type="hidden" name="action" value="create_dbusr">
<input type="hidden" name="op" value="set">
<table border="0">
<tr><td>MySQL Database Host:</td>
<td><input name="dbhost" value="<?php echo $dbhost?>"></td></tr>
<tr><td>MySQL Database Admin Username:</td>
<td><input name="dbaduname"value="<?php echo $dbaduname?>"></td></tr>
<tr><td>MySQL Database Admin Password:</td>
<td><input name="dbadpass"value="<?php echo $dbadpass?>"></td></tr>
<tr><td><?php echo $sys_name?> Database Name:</td>
<td><input name="dbname"value="<?php echo $dbname?>"></td></tr>
<tr><td><?php echo $sys_name?> Database Username:</td>
<td><input name="dbuname"value="<?php echo $dbuname?>"></td></tr>
<tr><td><?php echo $sys_name?> Database Password:</td>
<td><input name="dbpass"value="<?php echo $dbpass?>"></td></tr>
<tr><td></td>
<td><input type="submit" value="Submit"></td></tr>
</table>
</form>
<p>[ <a href="install.php">Go back</a> ]
