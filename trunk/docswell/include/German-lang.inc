<?php

######################################################################
# DocsWell: Documents Announcement & Retrieval System
# ===================================================================
#
# Copyright (c) 2001 by
#                Lutz Henckel (lutz.henckel@fokus.gmd.de) and
#                Gregorio Robles (grex@scouts-es.org)
#
# BerliOS DocsWell: http://docswell.berlios.de
# BerliOS - The OpenSource Mediator: http://www.berlios.de
#
# German translation
# translated by Lutz Henckel <lutz.henckel@fokus.gmd.de>
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 or later of the GPL.
######################################################################

switch($phrase) {

// Top strip
     case "Home": $tmp = "Heim"; break;
     case "About us": $tmp = "&Uuml;ber uns"; break;
     case "Partners": $tmp = "Partner"; break;
     case "Contact": $tmp = "Kontakt"; break;

     case "Logged in": $tmp = "Eingeloggt als"; break;
     case "Expires": $tmp = "Endet"; break;
     case "Not Logged in": $tmp = "Nicht eingeloggt"; break;

// Top title
     case "Documents Announcement &amp; Retrieval System":  $tmp = "Dokumenten Ank&uuml;ndigung &amp; Recherche"; break;

     case "Category does not exist": $tmp = "Kategorie existiert nicht"; break;

// Menue bar
     case "Recent Docs": $tmp = "Neueste Dok."; break;
     case "Q&amp;A": $tmp = "F&amp;A"; break;
     case "Login": $tmp = "Einloggen"; break;
     case "Logout": $tmp = "Ausloggen"; break;
     case "New User": $tmp = "Neuer Benutzer"; break;
     case "Forgot Password": $tmp = "Passwort vergessen"; break;
     case "Change User": $tmp = "Benutzer &auml;ndern"; break;
     case "Users": $tmp = "Benutzer"; break;

     case "Documents": $tmp = "Dokumente"; break;
     case "Docs Index": $tmp = "Dok.-Index"; break;
     case "New Doc": $tmp = "Neues Dok."; break;
     case "Update Doc": $tmp = "Aktualisiere Dok."; break;
     case "Pending Apps": $tmp = "Prüfe Anw.";break;
     case "Deleted Apps": $tmp = "Gelöschte Anw.";break;
     case "Modified Apps": $tmp = "Modifizierte Anw.";break;

     case "Backend": $tmp = "$phrase"; break;
     case "Statistics": $tmp = "Statistiken"; break;

     case "Administration": $tmp = "Administration"; break;
     case "Types": $tmp = "Typen"; break;
     case "Categories": $tmp = "Kategorien"; break;
     case "Formats": $tmp = "Formate"; break;
     case "Languages": $tmp = "Sprachen"; break;
     case "Authors": $tmp = "Autoren"; break;
     case "Advanced Search": $tmp = "Erweiterte Suche"; break;
     case "Document Search": $tmp = "Suche in Dok."; break;
     case "Check Date": $tmp = "Prüfe Datum"; break;

     case "Verify new": $tmp = "Neuzugänge"; break;
     case "Verify modified": $tmp = "Geänderte"; break;
     case "Delete entry": $tmp = "Löschen"; break;

     case "Search": $tmp = "Suche"; break;
     case "Search for": $tmp = "Suchen nach"; break;
     case "all": $tmp = "alle"; break;
     case "Language": $tmp = "Sprache"; break;
     case "Go": $tmp = "Los"; break;
     case "From user": $tmp = "Von Benutzer"; break;

// Languages
	 case "English": $tmp = "Englisch"; break;
	 case "German": $tmp = "Deutsch"; break;
	 case "Spanish": $tmp = "Spanisch"; break;

// sorted by
	 case "sorted by": $tmp = "sortiert nach"; break;
	 case "Date": $tmp = "Datum"; break;
	 case "Author": $tmp = "Autor"; break;
	 case "Category": $tmp = "Kategorie"; break;

// FAQ
     case "Frequently Asked Questions": $tmp = "Oft gestellte Fragen"; break;
     case "Question": $tmp = "Frage"; break;
     case "Answer": $tmp = "Antwort"; break;

// Docs update
     case "Comment": $tmp = "Kommentar"; break;
     case "Review": $tmp = "Review"; break;
     case "Update": $tmp = "Aktualisieren"; break;
     case "Delete": $tmp = "Entfernen"; break;
     case "Undelete": $tmp = "Wiederherstellen"; break;
     case "Last updated": $tmp = "Letzte &Auml;nderung"; break;
     case "Show original entry": $tmp = "Original Eintrag anzeigen"; break;

// Docs not yet reviewed
     case "Waiting for Review by an Editor": $tmp = "Wartet auf Überprüfung durch einen Editor"; break;

// Docs by identifier
     case "Document": $tmp = "Dokument"; break;
     case "Others by Author": $tmp = "Anderes vom Autor"; break;
     case "Others from the authors": $tmp = "Anderes von den Autoren"; break;
     case "has not yet been reviewed by a $GLOBALS[sys_name] Editor.<br> Please, be patient. It will be surely done in the next time.": $tmp = "wurde noch nicht von einem $GLOBALS[sys_name] Editor überprüft.<br> Bitte haben Sie noch etwas Geduld. In n&auml;chster Zeit wird dies bestimmt geschehen."; break;
     case "is modified": $tmp = "ist modifiziert"; break;
     case "is deleted": $tmp = "ist gelöscht"; break;
     case "Added Date": $tmp = "Hinzugef&uuml;gt am"; break;

// User registration
     case "Register as a new User": $tmp = "Registrierung als neuer Benutzer"; break;
     case "Username": $tmp = "Benutzername"; break;
     case "Password": $tmp = "Passwort"; break;
     case "Confirm Password": $tmp = "Passwort bestätigen"; break;
     case "Realname": $tmp = "Name"; break;
     case "Register": $tmp = "Registrieren"; break;
     case "User Registration": $tmp = "Benutzerregistrierung"; break;
     case "Congratulations": $tmp = "Gratulation"; break;
     case "You have registered on $GLOBALS[sys_name]": $tmp = "Sie haben sich bei $GLOBALS[sys_name] registriert"; break;
     case "Your new username is": $tmp = "Ihr neuer Benutzername ist"; break;
     case "You are now being sent a confirmation email to verify your email address": $tmp = "Es wurde eine Bestätigung per E-Mail an Sie gesendet, um Ihre E-Mail-Adresse zu überprüfen"; break;
     case "Visiting the link sent to you in this email will activate your account": $tmp = "Wenn Sie die in dieser E-Mail gesendete Seite besuchen wird Ihre Benutzerkennung freigeschaltet"; break;
     case "Thank you for registering on the $GLOBALS[sys_name] Site. In order": $tmp = "Danke für Ihre Registrierung bei $GLOBALS[sys_name]. Um Ihre"; break;
     case "to complete your registration, visit the following URL": $tmp = "Registrierung abzuschließen, besuchen Sie die folgende URL"; break;
     case "Enjoy the site": $tmp = "Wir hoffen, dass Ihnen $GLOBALS[sys_name] gefällt"; break;
     case " -- the $GLOBALS[sys_name] crew": $tmp = " -- die $GLOBALS[sys_name] Crew"; break;
     case "Verification of Registration": $tmp = "Verifikation der Registrierung"; break;
     case "Your account is now activated. Please login": $tmp = "Ihre Benutzerkennung ist jetzt freigeschaltet. Bitte loggen Sie sich ein"; break;

// Forget password / Remind me
     case "Register as a new User": $tmp = "Registrierung als neuer Benutzer"; break;
     case "Remind me": $tmp = "Erinnern"; break;
     case "Your Username and Password for $GLOBALS[sys_name] is": $tmp = "Ihr Benutzername und Passwort für $GLOBALS[sys_name] ist"; break;
     case "Please keep this e-mail for further reference": $tmp = "Bitte bewahren Sie diese E-Mail zur späteren Referenzierung auf"; break;
     case "You will get your Password by e-mail in a couple of minutes": $tmp = "Sie erhalten Ihr Passwort per E-Mail in wenigen Minuten"; break;

// Change User Parameters
     case "Change User Parameters": $tmp = "Änderung der Benutzerdaten"; break;
     case "Remind me": $tmp = "Erinnerung"; break;
     case "Modification": $tmp = "Modifiziert"; break;
     case "Creation": $tmp = "Hinzugef&uuml;gt am"; break;
     case "Permission": $tmp = "Rechte"; break;
     case "Change": $tmp = "Ändern"; break;
     case "Password and/or E-Mail Address of": $tmp = "Passwort und/oder E-Mail-Adresse von"; break;
     case "is changed": $tmp = "wurden geändert"; break;

// Docs by category
     case "Homepage": $tmp = "Homepage"; break;
     case "Download": $tmp = "Download"; break;
     case "Changelog": $tmp = "Changelog"; break;
     case "Comments": $tmp = "Kommentare"; break;
     case "Type": $tmp = "Typ"; break;
     case "Updated": $tmp = "Aktualisiert"; break;
     case "Created": $tmp = "Erzeugt"; break;
     case "Stable": $tmp = "Stabil"; break;
     case "Development": $tmp = "Entwicklung"; break;
     case "License": $tmp = "Lizenz"; break;

// New Doc
     case "New Document": $tmp = "Neues Dokument"; break;
     case "Title": $tmp = "Titel"; break;
     case "Description": $tmp = "Beschreibung"; break;
     case "Date of creation<br> for this entry": $tmp = "Erstellungsdatum<br> für diesen Eintrag"; break;
     case "Date of last update": $tmp = "Datum der letzten Änderung"; break;
     case "multiselection possible": $tmp = "Mehrfachauswahl möglich"; break;
     case "Insert new language": $tmp = "Neue Sprache anlegen"; break;
     case "Insert new type": $tmp = "Neuen Typ anlegen"; break;
     case "Insert new format": $tmp = "Neues Format anlegen"; break;
     case "Insert new category": $tmp = "Neue Kategorie anlegen"; break;
     case "Insert new author": $tmp = "Neuen Autor anlegen"; break;
     case "Please enter a link for each format": $tmp = "Bitte für jedes Format einen Link angeben"; break;
     case "Please enter the titel of the document": $tmp = "Bitte geben Sie einen Titel für das Dokument ein"; break;
     case "The titel is to short": $tmp = "Der Titel ist zu kurz"; break;
     case "Please enter a description for this document": $tmp = "Bitte geben Sie eine Beschreibung für das Dokument ein"; break;
     case "The description is to short": $tmp= "Die Beschreibung ist zu kurz"; break;
     case "Please enter the date of creation": $tmp = "Bitte das Erstellungsdatum für diesen Eintrag eingeben"; break;
     case "Wrong day format": $tmp = "Der Tag hat ein falsches Format"; break;
     case "Wrong month format": $tmp = "Der Monat hat ein falsches Format"; break;
     case "Wrong year format": $tmp = "Das Jahr hat ein falsches Format"; break;
     case "Please enter the date of last update": $tmp = "Bitte das Datum der letzten Änderung eingeben"; break;
     case "Please select at least one format": $tmp = "Bitte wählen Sie min. ein Format aus"; break;
     case "Please enter a link for the format": $tmp = "Bitte geben Sie einen Link ein, für das Format"; break;
     case "Please enter a absolute link for the format": $tmp = "Bitte geben Sie einen absoluten Link ein, für das Format";break;
     case "Can not find new entry in DB": $tmp = "Kann den neuen Eintrag nicht in der DB finden"; break;
     case "Done successfully": $tmp = "Erfolgreich"; break;
     case "Image": $tmp = "Bild"; break;
     case "Wrong file format. Only jpg, gif or png allowed.": $tmp = "Falsches Datei Format. Es sind nur jpg, gif oder png Datein erlaubt."; break;
     case "Could not write new file.":	$tmp = "Konnte Datei nicht schreiben."; break;
     case "Image saved": $tmp = "Bild gespeichert"; break;  
     case "Please specify an image": $tmp = "Bitte Bild angeben"; break;
     case "at": $tmp = "um"; break;
     case "o'clock": $tmp = "Uhr"; break;
     case "Please enter the time of creation": $tmp = "Bitte geben Sie die Uhrzeit der Erstellung dieses Eintrages an"; break;
     case "Wrong hour format": $tmp = "Falsches Stundenformat"; break;
     case "Wrong minute format": $tmp = "Falsches Minutenformat"; break;
     case "Wrong second format": $tmp = "Falsches Sekundenformat"; break;
     case "(hh:mm:ss)": $tmp = "(hh:mm:ss)"; break;
     case "Please enter the time of modification": $tmp = "Bitte geben Sie die Zeit der letzten &Auml;nderung ein"; break;
     case "or take image from document": $tmp = "oder Bild von einem vorhanden Dokument &uuml;bernehmen"; break;
     case "Select category": $tmp = "Kategorie ausw&auml;hlen"; break;
	
  
// Update doc
     case "Update an existing document": $tmp = "Aktualiseren eines existierenden Dokuments"; break;
     case "select another one": $tmp = "neues und zwar"; break;

// New language
     case "Please enter a new language": $tmp = "Bitte geben Sie eine Sprache ein"; break;
     case "This language already exists": $tmp = "Diese Sprache existiert bereits"; break;
     
// New Type 
     case "Type": $tmp = "Typ"; break;
     case "This type already exists": $tmp = "Dieser Typ existiert bereits"; break;
     case "Please insert a new type": $tmp = "Bitte geben Sie einen neuen Typ ein"; break;
     case "Please enter a description": $tmp = "Bitte geben Sie eine Beschreibung ein"; break;
     
// New Format
     case "Format": $tmp = "Format"; break;
     case "Please insert a new format": $tmp = "Bitte geben Sie ein neues Format ein"; break;
     case "This format already exists": $tmp = "Dieses Format existiert bereits"; break;
     
// New Category
     case "New category": $tmp = "Neue Kategorie"; break;
     case "Category": $tmp = "Kategorie"; break;
     case "Please insert a new category": $tmp = "Bitte geben Sie eine neue Kategorie ein"; break;
     case "This category already exists": $tmp = "Diese Kategorie existiert bereits"; break;

// New Author
     case "First name": $tmp = "Vorname"; break;
     case "Last name": $tmp = "Nachname"; break;
     case "E-Mail": $tmp ="E-Mail"; break;
     case "Please enter a last name": $tmp = "Bitte geben Sie einen Nachnamen ein"; break;
     case "This author already exists": $tmp = "Diese Autor existiert bereits"; break;
     case "Author Administration": $tmp = "Administration der Autoren"; break;
     case "Insert Author": $tmp = "Autor einf&uuml;gen"; break;
     case "This email already exists": $tmp = "Diese E-Mail Adresse existiert bereits"; break;
     case "Change author": $tmp = "Autor &auml;ndern"; break;
     case "Change author e-mail": $tmp = "Autoren E-Mail &auml;ndern"; break;
     case "New e-mail": $tmp = "Neue E-Mail"; break;
     case "Delete entry?": $tmp = "Eintrag wirklich l&ouml;schen?"; break;
     case "Can not delete author because there are still active documents from this author": $tmp = "Autor kann nicht gel&ouml;scht werden, da es immer noch aktive Dokumente von diesem Autor gibt"; break;
     case "Delete author": $tmp = "Autor l&ouml;schen"; break;
     
// Verify new docs
     case "Verify new document": $tmp = "Neuzugänge überprüfen"; break;
     case "All new documents": $tmp = "Alle Neuzugänge"; break;
     case "Pending doc entry deleted": $tmp = "Temporären Eintrag gelöscht"; break;
     case "Announcements": $tmp = "Ankündigungen"; break;
     case "active": $tmp = "aktiv"; break;
     case "pending": $tmp = "wartend"; break;
     case "deleted": $tmp = "gelöscht"; break;
     case "Check": $tmp = "Prüfen"; break;
     case "No image": $tmp = "Kein Bild"; break;
     case "keep": $tmp = "beibehalten"; break;
     case "delete": $tmp = "entfernen"; break;
     
// Check updates
     case "All updated documents": $tmp = "Alle geänderten Einträge"; break;
     case "Verify updated document": $tmp = "Änderungen freigeben"; break;

// Delete entries
     case "Delete an entry": $tmp = "Einen Eintrag löschen"; break;
     case "View entry": $tmp = "Eintrag anzeigen"; break;
     case "Entry status set to deleted": $tmp = "Eintragsstatus auf \"gelöscht\" gesetzt."; break;

// Comment
     case "Your Comment about": $tmp = "Ihr Kommentar zu"; break;
     case "Subject": $tmp = "Thema"; break;
     case "Comment": $tmp = "Kommentar"; break;
     case "Send": $tmp = "Senden"; break;
     case "Posted on": $tmp = "Erstellt am"; break;
     case "Delete this comment? (please, think there's no way for undoing comment deletion)": $tmp = "Diesen Kommentar löschen? (Bitte bedenken Sie, dass der Kommentar nicht wiederhergestellt werden kann)"; break;
     case "Comment deleted": $tmp = "Kommentar gelöscht"; break;
     case "Selected Comment was deleted": $tmp = "Ausgewählter Kommentar wurde gelöscht"; break;

// Login
     case "$GLOBALS[sys_name] Login": $tmp = "Bei $GLOBALS[sys_name] Einloggen"; break;
     case "Welcome to $GLOBALS[sys_name]": $tmp = "Willkommen bei $GLOBALS[sys_name]"; break;
     case "You are logged in as": $tmp = "Sie sind eingeloggt als"; break;
     case "with": $tmp = "mit"; break;
     case "permission": $tmp = "Rechten"; break;
     case "Your authentication is valid until": $tmp = "Ihre Authentifizierung ist gültig bis"; break;

// Logout
     case "You have been logged in as": $tmp = "Sie waren eingeloggt als"; break;
     case "Your authentication was valid until": $tmp = "Ihre Authentifizierung war gültig bis"; break;
     case "This is all over now. You have been logged out": $tmp = "Dies ist nun vorbei. Sie haben sich ausgeloggt"; break;

// User admin
     case "User Administration": $tmp = "Administration der Benutzer"; break;
     case "Action": $tmp = "Aktion"; break;
     case "Delete": $tmp = "Löschen"; break;
     case "Create User": $tmp = "Benutzer Erzeugen"; break;
     case "User Creation": $tmp = "Benutzer einrichten"; break;
     case "created": $tmp = "eingerichtet"; break;
     case "User Change": $tmp = "Benutzer Ändern"; break;
     case "User Deletion": $tmp = "Benutzer Löschen"; break;
     case "is deleted": $tmp = "wurden gelöscht"; break;

// Category admin
     case "Category Administration": $tmp = "Administration der Kategorien"; break;
     case "Insert Category": $tmp = "Kategorie hinzufügen"; break;
     case "Rename Category": $tmp = "Kategorie umbenennen"; break;
     case "Change Category Description": $tmp = "Kategoriebeschreibung ändern"; break;
     case "Delete Category": $tmp = "Kategorie löschen"; break;
     case "New Category": $tmp = "Neue Kategorie"; break;
     case "New Category Name": $tmp = "Neuer Kategoriename"; break;
     case "New Category Description": $tmp = "Neue Kategoriebeschreibung"; break;
     case "Category": $tmp = "Kategorie"; break;
     case "Warning!": $tmp = "Warnung!"; break;
     case "If you press another time the Delete-button you will alter": $tmp = "Wenn Sie den Löschen-Knopf ein weiteres Mal drücken, dann wirkt sich dies aus auf"; break;
     case "documents that have actually category": $tmp = "Dokumente der Kategorie"; break;
     case "with Description": $tmp = "mit Beschreibung"; break;
     case "has a new Description:": $tmp = "bekam eine neue Beschreibung:"; break;
     case "has been added succesfully": $tmp = "wurde hinzugefügt"; break;
     case "has been renamed to": $tmp = "wurde umbenannt in"; break;
     case "Deletion succesfully completed.": $tmp = "Erfolgreich gelöscht."; break;

// Type admin
     case "Type Administration": $tmp = "Administration der Typen"; break;
     case "Insert Type": $tmp = "Typ hinzufügen"; break;
     case "Rename Type": $tmp = "Typ umbenennen"; break;
     case "Change Type Description": $tmp = "Typbeschreibung ändern"; break;
     case "Delete Type": $tmp = "Typ löschen"; break;
     case "New Type": $tmp = "Neuer Typ"; break;
     case "License URL": $tmp = "Lizenz-URL"; break;
     case "New Type Name": $tmp = "Neuer Typname"; break;
     case "New Type Description": $tmp = "Neue Typbeschreibung"; break;
     case "Type": $tmp = "Typ"; break;

// Format admin
     case "Format Administration": $tmp = "Administration der Formate"; break;
     case "Insert Format": $tmp = "Format hinzufügen"; break;
     case "Rename Format": $tmp = "Format umbenennen"; break;
     case "Change Format Description": $tmp = "Formatbeschreibung ändern"; break;
     case "Delete Format": $tmp = "Format löschen"; break;
     case "New Format": $tmp = "Neues Format"; break;
     case "New Format Name": $tmp = "Neuer Formatname"; break;
     case "New Format Description": $tmp = "Neue Formatbeschreibung"; break;
     case "Format": $tmp = "Format"; break;

// Language admin
     case "Language Administration": $tmp = "Administration der Sprachen"; break;
     case "Insert Language": $tmp = "Sprache hinzufügen"; break;
     case "Rename Language": $tmp = "Sprache umbenennen"; break;
     case "Delete Language": $tmp = "Sprache löschen"; break;
     case "New Language": $tmp = "Neue Sprache"; break;
     case "New Language Name": $tmp = "Neuer Sprachname"; break;
     case "Language": $tmp = "Sprache"; break;
     case "Insert": $tmp = "Eintragen"; break;
     case "Rename": $tmp = "Umbenennen"; break;
     case "documents that have actually language": $tmp = "Dokumente in der Sprache"; break;

// License admin
     case "License Administration": $tmp = "Lizenzadministration"; break;
     case "Insert License": $tmp = "Lizenz hinzufügen"; break;
     case "Rename License": $tmp = "Lizenz umbenennen"; break;
     case "Change License URL": $tmp = "Lizenz-URL ändern"; break;
     case "Delete License": $tmp = "Lizenz löschen"; break;
     case "New License": $tmp = "Neue Lizenz"; break;
     case "License URL": $tmp = "Lizenz-URL"; break;
     case "New License Name": $tmp = "Neuer Lizenzname"; break;
     case "New License URL": $tmp = "Neue Lizenz-URL"; break;
     case "License": $tmp = "Lizenz"; break;

// FAQ admin
    case "Frequently Asked Questions Administration": $tmp = "Administration der häufig gestellten Fragen"; break;
    case "Enter a New Frequently Asked Question": $tmp = "Erstellen einer neuen häufig gestellten Frage"; break;
    case "New Frequently Asked Question": $tmp = "Neue häufig gestellte Frage"; break;
    case "Modify a Frequently Asked Question": $tmp = "Ändern einer häufig gestellte Frage"; break;
    case "Do you really want to delete this FAQ? There is no way for undeletion.": $tmp = "Wollen Sie diese Frage wirklich löschen? Bedenken Sie, dass es keine Möglichkeit gibt, dies wieder rückgängig zu machen."; break;
    case "Create": $tmp = "Erstelle"; break;
    case "The FAQ has been deleted": $tmp = "Die Frage wurde gelöscht"; break;
    case "The following FAQ has been modified": $tmp = "Die folgende Frage wurde geändert"; break;
    case "The following FAQ has been inserted": $tmp = "Die folgende Frage wurde erstellt"; break;
    case "Modify": $tmp = "Ändern"; break;
    case "Yes, Delete": $tmp = "Ja, löschen"; break;
    case "No, Just Modify": $tmp = "Nein, nur ändern"; break;
    
// Comment admin
    case "Comment deteted": $tmp = "Kommentar gelöscht"; break;
    case "Selected Comment was deteted": $tmp = "Ausgewählter Kommentar wurde gelöscht"; break;

// Status admin
    case "Check status": $tmp = "Status pr&uuml;fen"; break;
    case "Document and category check": $tmp = "Dokumenten- und Kategorie-Konsistenzpr&uuml;fung"; break;
    case "Documents with categories that have further sub-categories (documents should only hang on leaves)": $tmp = "Dokumente die sich in Kategorien befinden, die weitere Unterkategorien besitzen ( Dokumenten-Kategorien sollten immer &quot;Bl&auml;tter&quot; sein )."; break;
    case "No documents found": $tmp = "Keine Dokumente vorhanden"; break;
    case "Documents with deleted category": $tmp = "Dokumente mit gel&ouml;schter Kategorie"; break;
    case "All deleted documents": $tmp = "Alle gel&ouml;schten Dokumente"; break;

// Announcements
    case "by": $tmp = "von"; break;
    case "on": $tmp = "am"; break;
    case "hits": $tmp = "Zugriffe"; break;
    case "Document": $tmp = "Dokument"; break;
    
// Rating
    case "Rating" : $tmp = "Bewertung"; break;
    case "Rate It" : $tmp = "Bewerten"; break;
    case "Good" : $tmp = "Gut"; break;
    case "OK" : $tmp = "Ok"; break;
    case "Bad" : $tmp = "Schlecht"; break;

// Time-based Navigation
    case "previous": $tmp = "vorige"; break;
    case "Top": $tmp = "Top"; break;
    case "next": $tmp = "nächste"; break;
    case "Docs": $tmp = "Dokumente"; break;

// Search
    case "No Documents found": $tmp = "Keine Dokumente gefunden"; break;

// Docs by user
     case "Docs of User": $tmp = "Dok. des Benutzers"; break;
     case "No Docs of User exist": $tmp = "Es existiert kein Dokument des Benutzers"; break;

// Deleted or modified docs
     case "Is deleted": $tmp = "Ist gelöscht"; break;
     case "Is modified": $tmp = "Ist modifiziert"; break;

// Users
    case "No": $tmp = "Nr"; break;
    case "All": $tmp = "Alle"; break;

// Developers
    case "Names": $tmp = "Namen"; break;
    case "Unknown": $tmp = "Unbekannt"; break;

// Licences
     case "Apps": $tmp = "Anw."; break;

// Check Date
     case "All dates are consistent": $tmp = "Alle Daten sind konsistent"; break;

// Newsletter
     case "Subscribe Newsletter": $tmp = "Newsletter abonnieren"; break;
     case "Subscribe daily Newsletter": $tmp = "Täglichen Newsletter abonnieren"; break;
     case "Subscribe weekly Newsletter": $tmp = "Wöchentlichen Newsletter abonnieren"; break;
     case "Subscribe": $tmp = "Abonnieren"; break;
     case "Send newsletter": $tmp = "Sende Newsletter"; break;
     case "Newsletter was sent at ": $tmp = "Newsletter wurde gesendet am "; break;
     case "You have subscribed to $GLOBALS[sys_name] daily Newsletter": $tmp = "Sie haben den täglichen $GLOBALS[sys_name] Newsletter abonniert"; break;
     case "You have subscribed to $GLOBALS[sys_name] weekly Newsletter": $tmp = "Sie haben den wöchentlichen $GLOBALS[sys_name] Newsletter abonniert"; break;
     case "Daily Newsletter": $tmp = "Tägl. Newsletter"; break;
     case "Weekly Newsletter": $tmp = "Wöchtl. Newsl."; break;
     case "daily": $tmp = "täglich"; break;
     case "weekly": $tmp = "wöchentlich"; break;

// Errors
     case "Access denied": $tmp = "Zugriff verweigert"; break;
     case "Error": $tmp = "Fehler"; break;
     case "does not exist": $tmp = "existiert nicht"; break;
     case "Change User Parameters failed": $tmp = "Änderung der Benutzerdaten ist fehlgeschlagen"; break;
     case "No Application ID specified": $tmp = "Keine Anwendungs-ID angegeben"; break;
     case "No Application Name specified": $tmp = "Kein Anwendungsname angegeben"; break;
     case "No Document found": $tmp = "Kein Dokument gefunden"; break;
     case "Please select": $tmp = "Bitte wählen Sie"; break;
     case "Parameter missing": $tmp = "Parameter fehlt"; break;
     case "and": $tmp = "und"; break;
     case "User": $tmp = "Benutzer"; break;
     case "already exists": $tmp = "existiert bereits"; break;
     case "Please select a different Username": $tmp = "Bitte wählen Sie einen anderen Benutzernamen"; break;
     case "Please enter": $tmp = "Bitte angeben:"; break;
     case "Either your Username or E-Mail Address is unknown": $tmp = "Entweder Ihr Benutzername oder E-Mail-Adresse ist unbekannt"; break;
     case "Please try again": $tmp = "Bitte versuchen Sie es nochmal"; break;
     case "If you are not yet a registered User, please select": $tmp = "Wenn Sie noch kein registrierter Benutzer sind, wählen Sie bitte"; break;
     case "Verification of Registration failed": $tmp = "Verifikation der Registrierung ist fehlgeschlagen"; break;
     case "User Change failed": $tmp = "Benutzer ändern ist fehlgeschlagen"; break;
     case "Registration of new User failed": $tmp = "Registrierung des neuen Benutzers ist fehlgeschlagen"; break;
     case "Database error": $tmp = "Datenbankfehler"; break;
     case "Database Access failed": $tmp = "Datenbankzugriff ist fehlgeschlagen"; break;
     case "User Deletion failed": $tmp = "Benutzer Löschen ist fehlgeschlagen"; break;
     case "No more Docs for this day": $tmp = "Keine weiteren Dokumente für diesen Tag"; break;
     case "Either your Username or Password are invalid": $tmp = "Entweder Ihr Benutzername oder Passwort ist falsch"; break;
     case "The passwords are not identical": $tmp = "Die Passworte sind nicht identisch"; break;
     case "Please try again": $tmp = "Bitte versuchen Sie es nochmal"; break;
     case "License description is not available": $tmp = "Lizenzbeschreibung ist nicht verfügbar"; break;

// Document types
     case "Document Types": $tmp = "Dokumenttypen"; break;
     case "Journal": $tmp = "Journal"; break;
     case "Magazine": $tmp = "Magazin"; break;
     case "Guide": $tmp = "Handbuch"; break;
     case "Column": $tmp = "Kolumne"; break;
     case "Book": $tmp = "Buch"; break;
     case "Study": $tmp = "Studie"; break;
     case "more": $tmp = "mehr"; break;

// Categories
     case "Operating System": $tmp = "Betriebssystem"; break;
     case "System Administration and Configuration": $tmp = "System-Administration und Konfiguration"; break;
     case "Networking": $tmp = "Kommunikation"; break;
     case "Applications": $tmp = "Anwendungen"; break;
     case "Programming": $tmp = "Programmierung"; break;

// If no translation available, keep the original phrase
     default: $tmp = "$phrase"; break;
}

//echo "---->$tmp<---";
?>
