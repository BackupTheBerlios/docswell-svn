	<h3>DocsWell Database Connection</h3>
	<ul>
    	<li>I am now going to try to create a DB_DocsWell database connection. If this line is the last thing that you see then you should look at these points and fix them before proceeding:
		<ul>
			<li>Have you introduced the correct database parameters (<i>Host</i>, <i>Database</i> name, <i>User</i> name and <i>Password</i>) in the include/local.inc file?
        	<li>Have you created the database structures in the database? (you've got them in the <i>sql</i> subdirectory)
			<li>Is your database running? ;-)
		</ul>
<?php
        	$db = new DB_DocsWell;
        	if ($db->query("SELECT * FROM DOKUMENT")): ?>
			<li><b><font color="green">Created a DB_DocsWell database connection successfully.</font></b></li>
        	<?php endif; ?>

	</ul>
	<p>[ <a href="install.php">Go back</a> ] [ <a href="install.php?action=check_session">Next</a> ]
