<p><b>Enter Sytem URL</b>
<form action="install.php">
<input type="hidden" name="action" value="set_url">
<input type="hidden" name="op" value="set">
<table border="0">
<tr><td>System URL:</td>
<td><input name="sysurl" value="<?php echo $sysurl?>"> ( e.g. http://<?php echo $HTTP_HOST?>/<?php echo $sys_name?>/ )</td></tr>
<tr><td></td>
<td><input type="submit" value="Submit"></td></tr>
</table>
</form>
<p>[ <a href="install.php">Go back</a> ]
