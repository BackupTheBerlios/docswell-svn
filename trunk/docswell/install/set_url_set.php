<?php
if (!ereg("/$", $sysurl)) $sysurl .= "/";
// Create database parameters in include file
echo "<p><b>Set System URL in $sysconfile</b><br>\n";
if (file_exists($sysconfile)) {
	$fcontent = file($sysconfile);
	$fd = fopen($sysconfile, "w");
	while (list ($line_num, $line) = each ($fcontent)) {
		if (ereg("([\t ]*)\\\$sys_url([\t ]*)=([\t )]*)", $line, $regs)) {
			$newline = $regs[1]."\$sys_url".$regs[2]."=".$regs[3]."\"$sysurl\";";
			fwrite($fd, $newline."\n");
			echo "<ul><li><font color=\"green\">Line $line_num: $newline</font>\n";
		} else {
			fwrite($fd, $line);
		}
	}
	fclose($fd);
} else {
	echo "<li><font color=\"red\">$sysconfile does not exists.</font>\n";
	echo "<br><font color=\"red\">Go back and enter correct one.</font>\n";
}
?>
</ul>
<p>[ <a href="install.php?action=set_url">Go back</a> ] [ <a href="install.php?action=create_dbusr">Next</a> ]
