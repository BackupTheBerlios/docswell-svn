<p><b>Set path to PHPlib directory</b>
<table border="0">
<?php
if (!ereg("^/", $phplibpath)) $phplibpath = "/".$phplibpath;
if (!ereg("/$", $phplibpath)) $phplibpath .= "/";
?>
<tr><td>Path to PHPlib directory:</td>
<td><?php echo $phplibpath?></td></tr>
</table>
<?php
// Create database parameters in include file
echo "<p><b>Set path to PHPlib directory in $prependfile</b><br>\n";
if (file_exists($phplibpath."db_mysql.inc")) {
	$fcontent = file($prependfile);
	$fd = fopen($prependfile, "w");
	while (list ($line_num, $line) = each ($fcontent)) {
		if (ereg("([\t ]*)\\\$_PHPLIB\[\"libdir\"\]([\t ]*)=([\t )]*)", $line, $regs)) {
			$newline = $regs[1]."\$_PHPLIB[\"libdir\"]".$regs[2]."=".$regs[3]."\"$phplibpath\";";
			fwrite($fd, $newline."\n");
			echo "<br><font color=\"green\">$line_num: $newline</font>\n";
		} else {
			fwrite($fd, $line);
		}
	}
	fclose($fd);
} else {
	echo "<br><font color=\"red\">$phplibpath is not the correct path to PHPlib directory.</font>\n";
	echo "<br><font color=\"red\">Go back and enter correct one.</font>\n";
}
?>
<p>[ <a href="install.php?action=set_phplib">Go back</a> ] [ <a href="install.php?action=check_phplib">Next</a> ]
