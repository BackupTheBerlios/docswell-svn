<p><b>Create <?php echo $sys_name?> Database</b>
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
	$query = "CREATE DATABASE ".$dbname;
	if (mysql_query($query, $db)) {
		echo "<p><font color=\"green\">$query</font><p>\n";
		// Create database tables
		$fcontents = file("./sql/tables.sql");
		while (list ($line_num, $line) = each ($fcontents)) {
			$line = trim($line);
			if (!ereg("^#", $line) && !empty($line)) {
				if (ereg(";$", $line)) {
					$line = ereg_replace(";", "", $line);
					$aquery[] = $line;
					$query = join("", $aquery);
					if (mysql_db_query($dbname, $query, $db)) {
						echo "<p><font color=\"green\">$query</font>\n";
					} else {
						echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
					}
					$aquery = array();
				} else {
					$aquery[] = $line;
				}
			}
		}
		// Set database defaults
		$fcontents = file("./sql/defaults.sql");
		while (list ($line_num, $line) = each ($fcontents)) {
			$line = trim($line);
			if (!ereg("^#", $line) && !empty($line)) {
				if (ereg(";$", $line)) {
					$line = ereg_replace(";", "", $line);
					$aquery[] = $line;
					$query = join("", $aquery);
					if (mysql_db_query($dbname, $query, $db)) {
						echo "<p><font color=\"green\">$query</font>\n";
					} else {
						echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
					}
					$aquery = array();
				} else {
					$aquery[] = $line;
				}
			}
		}
		// Create database parameters in include file
		echo "<p><b>Create $sys_name Database access parameters in $dbconfile</b><br>\n";
		$fcontent = file($dbconfile);
		$fd = fopen($dbconfile, "w");
		while (list ($line_num, $line) = each ($fcontent)) {
			if (ereg("([\t ]*)var([\t ]*)\\\$Host([\t ]*)=([\t )]*)", $line, $regs)) {
				$newline = $regs[1]."var".$regs[2]."\$Host".$regs[3]."=".$regs[4]."\"$dbhost\";";
				fwrite($fd, $newline."\n");
				echo "<br><font color=\"green\">$line_num: $newline</font>\n";
			} else if (ereg("([\t ]*)var([\t ]*)\\\$Database([\t ]*)=([\t ]*)", $line, $regs)) {
				$newline = $regs[1]."var".$regs[2]."\$Database".$regs[3]."=".$regs[4]."\"$dbname\";";
				fwrite($fd, $newline."\n");
				echo "<br><font color=\"green\">$line_num: $newline</font>\n";
			} else if (ereg("([\t ]*)var([\t ]*)\\\$User([\t ]*)=([\t ]*)", $line, $regs)) {
				$newline = $regs[1]."var".$regs[2]."\$User".$regs[3]."=".$regs[4]."\"$dbuname\";";
				fwrite($fd, $newline."\n");
				echo "<br><font color=\"green\">$line_num: $newline</font>\n";
			} else if (ereg("([\t ]*)var([\t ]*)\\\$Password([\t ]*)=([\t ]*)", $line, $regs)) {
				$newline = $regs[1]."var".$regs[2]."\$Password".$regs[3]."=".$regs[4]."\"$dbpass\";";
				fwrite($fd, $newline."\n");
				echo "<br><font color=\"green\">$line_num: $newline</font>\n";
			} else {
				fwrite($fd, $line);
			}
		}
		fclose($fd);
		$mode = fileperms($dbconfile);
		echo "<p>Don't forget to change the permissions ".get_perms($mode)." of $dbconfile, so that only your web server can read it!\n"; 
	} else {
		echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
	}
	@mysql_close($db);
} else {
	echo "<p><font color=\"red\">Database error: ".mysql_error()."</font>\n";
}
?>
<p>[ <a href="install.php?action=create_db&dbhost=<?php echo urlencode($dbhost)?>&dbaduname=<?php echo urlencode($dbaduname)?>&dbadpass=<?php echo urlencode($dbadpass)?>&dbname=<?php echo urlencode($dbname)?>&dbuname=<?php echo urlencode($dbuname)?>&dbpass=<?php echo urlencode($dbpass)?>">Go back</a> ] [ <a href="install.php?action=check_db">Next</a> ]
