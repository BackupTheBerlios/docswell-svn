<?php
	/* PHPLIB tests */
	$phplib = function_exists('page_open');
	$track_vars = isset($HTTP_GET_VARS);
?>
	<h3>PHPlib configuration</h3>

	<ul>
    	<li>track_vars: <?php echo status($track_vars) ?></li>
    	<?php if (!$track_vars) { $some_no=1; ?>
        	<li><b><font color="red">PHPLIB will not work correctly with track_vars disabled. Enable it in your config file before continuing.</font></b></li>
    	<?php } ?> 
    	<li>PHPLIB (is page_open() defined): <?php echo status($phplib) ?></li>
    	<?php if ($phplib) { ?>
        	<li>I am now going to try to create a DocsWell_Session class. If this line is the last thing you see, then you do not have class DocsWell_Session defined in include/local.inc. Fix that before proceeding.</li>
        	<?php $sess = @new DocsWell_Session;
        	if ($sess): ?>
            	<li><B><font color="green">Created a DocsWell_Session instance successfully.</font></B>.</li>
        	<?php endif; ?>
    	<?php } ?>
	</ul>
	<p>[ <a href="install.php">Go back</a> ] [ <a href="install.php?action=create_dbusr">Next</a> ]
