<?php
if (!ereg("^/", $phplibpath)) $phplibpath = "/".$phplibpath;
if (!ereg("/$", $phplibpath)) $phplibpath .= "/";
// Create database parameters in include file
echo "<p><b>Set path to PHPlib directory in $prependfile</b>\n";
if (file_exists($phplibpath."db_mysql.inc")) {
	$fcontent = file($prependfile);
	$fd = fopen($prependfile, "w");
	while (list ($line_num, $line) = each ($fcontent)) {
		if (ereg("([\t ]*)\\\$_PHPLIB\[\"libdir\"\]([\t ]*)=([\t )]*)", $line, $regs)) {
			$newline = $regs[1]."\$_PHPLIB[\"libdir\"]".$regs[2]."=".$regs[3]."\"$phplibpath\";";
			fwrite($fd, $newline."\n");
			echo "<ul><li><font color=\"green\">Line $line_num: $newline</font>\n";
		} else {
			fwrite($fd, $line);
		}
	}
	fclose($fd);
} else {
	echo "<li><font color=\"red\">$phplibpath is not the correct path to PHPlib directory.</font>\n";
	echo "<br><font color=\"red\">Go back and enter correct one.</font>\n";
}
?>
</ul>
<p>[ <a href="install.php?action=set_phplib">Go back</a> ] [ <a href="install.php?action=check_phplib">Next</a> ]
