USE docswell;

#
# Table structure for table `AUTOR`
#

CREATE TABLE AUTOR (
  ID int(11) NOT NULL auto_increment,
  VORNAME varchar(100) default NULL,
  NACHNAME varchar(100) NOT NULL default '',
  EMAIL varchar(100) default NULL,
  PRIMARY KEY  (ID),
  KEY NACHNAME_INDEX (NACHNAME)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `AUTOR_DOKUMENT`
#

CREATE TABLE AUTOR_DOKUMENT (
  id int(10) unsigned NOT NULL auto_increment,
  AUTOR_ID int(10) unsigned NOT NULL default '0',
  DOKUMENT_ID int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (id),
  KEY id (id)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `DOKUMENT`
#

CREATE TABLE DOKUMENT (
  ID int(11) unsigned NOT NULL auto_increment,
  TITEL varchar(250) NOT NULL default '',
  BESCHREIBUNG text,
  ERSTELLUNGSDATUM datetime NOT NULL default '0000-00-00 00:00:00',
  AENDERUNGSDATUM datetime default NULL,
  TYP int(10) unsigned NOT NULL default '0',
  COUNTER int(10) unsigned NOT NULL default '0',
  SPRACHE varchar(100) NOT NULL default '',
  KATEGORIE int(10) unsigned NOT NULL default '0',
  BEWERTUNG int(5) unsigned default '0',
  BEWVONANZP int(10) unsigned default '0',
  ANGELEGTVON varchar(50) NOT NULL default 'nobody',
  STATUS varchar(5) NOT NULL default 'A',
  BILD varchar(100) default NULL,
  BILD_REFERENZ varchar(100) NOT NULL default '0',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `FORMAT`
#

CREATE TABLE FORMAT (
  DOKUID int(10) unsigned NOT NULL default '0',
  FORMATID int(10) unsigned NOT NULL default '0',
  LINK tinytext NOT NULL,
  KEY DOKUID (DOKUID,FORMATID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `FORMATDEF`
#

CREATE TABLE FORMATDEF (
  ID int(10) unsigned NOT NULL auto_increment,
  NAME varchar(100) NOT NULL default '',
  KOMMENTAR text,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `KATEGORIE`
#

CREATE TABLE KATEGORIE (
  ID int(10) unsigned NOT NULL auto_increment,
  NAME varchar(150) NOT NULL default '',
  PARENT_ID int(10) unsigned NOT NULL default '1',
  KOMMENTAR tinytext,
  PRIMARY KEY  (ID),
  UNIQUE KEY ID (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `KOMMENTAR`
#

CREATE TABLE KOMMENTAR (
  ID int(11) NOT NULL auto_increment,
  KOMMENTAR text,
  DOKUMENTID int(11) NOT NULL default '0',
  DATUM timestamp(14) NOT NULL,
  AUTOR varchar(200) default NULL,
  SUBJECT varchar(200) NOT NULL default '',
  PRIMARY KEY  (ID),
  KEY DOKUMENT_INDEX (DOKUMENTID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `PENDING`
#

CREATE TABLE PENDING (
  ID int(11) unsigned NOT NULL auto_increment,
  DOKID int(11) default '0',
  TITEL varchar(250) NOT NULL default '',
  BESCHREIBUNG text,
  ERSTELLUNGSDATUM datetime NOT NULL default '0000-00-00 00:00:00',
  AENDERUNGSDATUM datetime default NULL,
  TYP int(10) unsigned NOT NULL default '0',
  COUNTER int(10) unsigned NOT NULL default '0',
  SPRACHE varchar(100) NOT NULL default '',
  KATEGORIE int(10) unsigned NOT NULL default '0',
  BEWERTUNG int(5) unsigned default '0',
  BEWVONANZP int(10) unsigned default '0',
  ANGELEGTVON varchar(50) NOT NULL default 'nobody',
  STATUS varchar(5) NOT NULL default 'N',
  BILD varchar(100) default NULL,
  BILD_REFERENZ varchar(100) NOT NULL default '0',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `PENDING_ATR_DKMNT`
#

CREATE TABLE PENDING_ATR_DKMNT (
  AUTOR_ID int(10) unsigned NOT NULL default '0',
  DOKUMENT_ID int(10) unsigned NOT NULL default '0',
  PENDING_ID int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `PENDING_FORMAT`
#

CREATE TABLE PENDING_FORMAT (
  DOKUID int(10) unsigned NOT NULL default '0',
  FORMATID int(10) unsigned NOT NULL default '0',
  LINK tinytext NOT NULL,
  PENDING_ID int(10) unsigned NOT NULL default '0',
  KEY DOKUID (DOKUID,FORMATID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `SPRACHEDEF`
#

CREATE TABLE SPRACHEDEF (
  ID tinyint(3) unsigned NOT NULL auto_increment,
  SPRACHE varchar(100) NOT NULL default '',
  PRIMARY KEY  (ID),
  UNIQUE KEY ID (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `TYPDEF`
#

CREATE TABLE TYPDEF (
  ID int(10) unsigned NOT NULL auto_increment,
  NAME varchar(100) NOT NULL default '',
  KOMMENTAR text NOT NULL,
  PRIMARY KEY  (ID),
  UNIQUE KEY ID (ID)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `active_sessions`
#

CREATE TABLE active_sessions (
  sid varchar(32) NOT NULL default '',
  name varchar(32) NOT NULL default '',
  val text,
  changed varchar(14) NOT NULL default '',
  PRIMARY KEY  (name,sid),
  KEY changed (changed)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `auth_user`
#

CREATE TABLE auth_user (
  user_id varchar(32) NOT NULL default '',
  username varchar(32) NOT NULL default '',
  password varchar(32) NOT NULL default '',
  realname varchar(64) NOT NULL default '',
  email_usr varchar(128) NOT NULL default '',
  modification_usr timestamp(14) NOT NULL,
  creation_usr timestamp(14) NOT NULL,
  perms varchar(255) default NULL,
  PRIMARY KEY  (user_id),
  UNIQUE KEY k_username (username)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table `faq`
#

CREATE TABLE faq (
  faqid int(8) unsigned NOT NULL auto_increment,
  language varchar(24) NOT NULL default '',
  question blob NOT NULL,
  answer blob NOT NULL,
  PRIMARY KEY  (faqid)
) TYPE=MyISAM;

