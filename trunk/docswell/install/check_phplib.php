<?php
	/* PHPlib tests */
	$track_vars = isset($HTTP_GET_VARS);
?>
	<h3>PHPlib configuration</h3>

	<ul>
    	<li>track_vars: <?php echo status($track_vars) ?></li>
    	<?php if (!$track_vars) { $some_no=1; ?>
        	<li><b><font color="red">PHPlib will not work correctly with track_vars disabled. Enable it in your config file before continuing.</font></b></li>
    	<?php } ?>
        <li>I am now going to check if PHPlib is installed and the path is set correctly.<br>If an error occures, then you have to install PHPlib and/or adjust the path to PHPlib directory in include/prepend.php3</li>
	<?php
	require("./include/prepend.php3");
	$phplib = function_exists('page_open');
	?>
    	<li>PHPlib (is page_open() defined): <?php echo status($phplib) ?></li>
    	<?php if ($phplib) { ?>
        	<li>I am now going to create a <?php echo $sys_name;?>_Session class.<br>If an error occures, then you do not have defined class <?php echo $sys_name;?>_Session in include/local.inc. Fix it before proceeding.</li>
        	<?php $sess = @new DocsWell_Session;
        	if ($sess): ?>
            		<li><B><font color="green">Created a <?php echo $sys_name;?>_Session instance successfully.</font></B>.</li>
        	<?php endif; ?>
        <?php } ?>
	</ul>
	<p>[ <a href="install.php">Go back</a> ] [ <a href="install.php?action=create_dbusr">Next</a> ]
