<?php

######################################################################
# DocsWell: Document Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# The DocsWell Project Page
#
# It also shows the number of apps in each one
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
###################################################################### 

require("header.inc");

?>

<!-- content -->

<P><H2>DocsWell</H2>

<P>DocsWell is an announce and retrieval system for documents.

<P>It is based in <A HREF="http://www.php.net">PHP</A> and uses <A HREF="http://www.mysql.com">MySQL</A> as its database system. DocsWell depends on
the <A HREF="http://phplib.netuse.de/">PHPLib library</A> (version 7.2 or
later). Future versions may have database independence, but this is
not yet supported. We are still working on it. Only if you want to have
diary and weekly mailing lists with the announcements, you should also have
Mailman installed in your box.

<P>You can see a fully working example of the DocsWell system at BerliOS
DocsWell by visiting <A HREF="http://docswell.berlios.de">http://docswell.berlios.de</A>. A close look at it will show you what
you can do with DocsWell. BerliOS DocsWell has at this moment more
than 750 documents inserted and has been the main reason why we have
made this software.

<P>BerliOS DocsWell is part of the BerliOS project at GMD FOKUS. Please, have
a look at <A HREF="http://www.berlios.de">http://www.berlios.de</A> for further information.

<P>DocsWell can be easily translated into different
languages. If you see that DocsWell does not have support in your
language, you're gladly invited to <A HREF="translating.php3">help us with the
internationalization</A> of DocsWell by sending us your translation.

<P>You can download the latest version of DocsWell (sources and documentation) at:
<A HREF="http://developer.berlios.de/projects/docswell">http://developer.berlios.de/projects/docswell</A>

<P>DocsWell Features:
<UL>
<LI>Different type of users (nonauthorized users, users, editors and
administrators) with different functions
<LI>Advanced configurability from a single file
<LI>Simple, intuitive use of the system
<LI>Session management with and without cookies
<LI>Through-the-web document reviewing and administration for editors
<LI>Through-the-web administration of documents, authors, documet categories and types
<LI>Dynamic order of documents by date (default), author, or document category
<LI>"true" software counter for docs downloads.
<LI>Multilingual support
<LI>XML Backend (RDF-document format)
<LI>Daily and Weekly automatic Newsletters
<LI>Comments and ratings on documents
<LI>FAQ
<LI>"intelligent" document validation for editors
<LI>EMail advice for editors when documents are inserted or updated
<LI>EMail advice for administrators when new users are registered
<LI>Graphical statistics
<LI>Web browser independence
<LI>Cache avoidance
<LI>Documentation for further development and/or adjustment
</UL>

<P>&nbsp;

<!-- end content -->

<?php
require("footer.inc");
?>
