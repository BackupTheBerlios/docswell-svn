<p><b>Create <?php echo $sys_name?> Database User</b>
<table border="0">
<tr><td>MySQL Database Host:</td>
<td><?php echo $dbhost?></td></tr>
<tr><td>MySQL Database Admin Username:</td>
<td><?php echo $dbaduname?></td></tr>
<tr><td>MySQL Database Admin Password:</td>
<td><?php echo $dbadpass?></td></tr>
<tr><td><?php echo $sys_name?> Database Name:</td>
<td><?php echo $dbname?></td></tr>
<tr><td><?php echo $sys_name?> Database Username:</td>
<td><?php echo $dbuname?></td></tr>
<tr><td><?php echo $sys_name?> Database Password:</td>
<td><?php echo $dbpass?></td></tr>
</table>
<?php
$db = @mysql_connect($dbhost, $dbaduname, $dbadpass);
if ($db) {
	if ($dbhost == "localhost")
		$webhost = $dbhost;
	else
		$webhost = $SERVER_NAME;
	$query = "INSERT INTO db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv) VALUES ('$webhost','$dbname','$dbuname','Y','Y','Y','Y','Y','Y','N','Y','Y','Y')";
	if (mysql_db_query("mysql", $query, $db)) {
		echo "<p><font color=\"green\">$query</font><p>\n";
		$query = "INSERT INTO user (Host,User,Password,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Reload_priv,Shutdown_priv,Process_priv,File_priv,Grant_priv,References_priv,Index_priv,Alter_priv) VALUES ('$webhost','$dbuname',PASSWORD('$dbpass'),'N','N','N','N','N','N','N','N','N','N','N','N','N','N')";
		if (mysql_db_query("mysql", $query, $db)) {
			echo "<p><font color=\"green\">$query</font><p>\n";
			mysql_query('FLUSH PRIVILEGES');
		} else {
			echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
		}
	} else {
		echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
	}
	@mysql_close($db);
} else {
	echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
}
?>
<p>[ <a href="install.php?action=create_dbusr&dbhost=<?php echo urlencode($dbhost)?>&dbaduname=<?php echo urlencode($dbaduname)?>&dbadpass=<?php echo urlencode($dbadpass)?>&dbname=<?php echo urlencode($dbname)?>&dbuname=<?php echo urlencode($dbuname)?>&dbpass=<?php echo urlencode($dbpass)?>?>">Go back</a> ] [ <a href="install.php?action=create_db&dbhost=<?php echo urlencode($dbhost)?>&dbaduname=<?php echo urlencode($dbaduname)?>&dbadpass=<?php echo urlencode($dbadpass)?>&dbname=<?php echo urlencode($dbname)?>&dbuname=<?php echo urlencode($dbuname)?>&dbpass=<?php echo urlencode($dbpass)?>">Next</a> ]
