	<p><b>PHPlib Session</b>
<?php
	// s is a per session variable, u is a per user variable.
	if (!isset($s)) {
		$s = 0;
		$sess->register('s');
	}
?>
	<ul>
	<li>Per Session Data: <?php echo ++$s ?>
	<br>Session ID: <?php echo $sess->id ?>
	<li>If this page works correctly, then you have a correctly configured <?php echo $sys_name;?>_Session class.
	</ul>
	<p>[ <a href="<?php $sess->pself_url()?>">Reload</a> ] this page to increment the counter.
	<p><b>File Permissions</b>
	<ul>
<?php
	/* File permissions for system config */
	$mode = fileperms($sysconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"red\">System configuration file $sysconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-r--r- and try again!</font>\n";
		} else {
			echo "<li><font color=\"green\">System configuration file $sysconfile has correct ".get_perms($mode)." permissions.</font>\n";
		}
	}

	/* File permissions for database config */
	$mode = fileperms($dbconfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"red\">Database configuration file $dbconfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-r--r-- and try again!</font>\n";
		} else {
			echo "<li><font color=\"green\">Database configuration file $dbconfile has correct ".get_perms($mode)." permissions.</font>\n";
		}
	}

	/* File permissions for PHPLIB prepend */
	$mode = fileperms($prependfile);
	if ($mode) {
		if (($mode & 00666) == 00666) {
			echo "<li><font color=\"red\">PHPlib prepend file $prependfile has incorrect ".get_perms($mode)." permissions.\n";
			echo "<br>Please change permissions to rw-r--r--!</font>\n";
		} else {
			echo "<li><font color=\"green\">PHPlib prepend file $prependfile has correct ".get_perms($mode)." permissions.</font>\n";
		}
	}
?>
	</ul>
	<p><b>Congratulations!</b>
	<ul>
	<li><?php echo $sys_name;?> is correctly installed.
	<br>Now visit the <a href="<?php echo $sys_url;?>"><?php echo $sys_name;?></a> homepage.
	</ul>
	<p>[ <a href="install.php">Go back</a> ]
