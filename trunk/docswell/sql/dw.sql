# phpMyAdmin MySQL-Dump
# version 2.2.3
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# Host: db.berlios.de
# Generation Time: Apr 05, 2002 at 10:18 AM
# Server version: 3.23.37
# PHP Version: 3.0.18
# Database : `docswell`
# --------------------------------------------------------

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

#
# Dumping data for table `FORMATDEF`
#

INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (1, 'HTML', 'HyperText Markup Language');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (2, 'HTML (single)', 'HyperText Markup Language as a single Page');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (3, 'PS', 'PostScript');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (4, 'PDF', 'Portable Document Format');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (5, 'TXT', 'Plain Text');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (6, 'HTML (tar.gz)', 'HyperText Markup Language gzipped tar archive');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (7, 'HTML (tar.bz2)', 'HyperText Markup Language bzipped tar archive');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (8, 'HTML (zip)', 'HyperText Markup Language zipped archive');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (9, 'PS (gz)', 'PostScript gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (10, 'PS (zip)', 'PostScript zipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (11, 'PS (bz2)', 'PostScript bzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (12, 'TXT (gz)', 'Plan text gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (13, 'TXT (bz2)', 'Plan Text bzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (14, 'TXT (zip)', 'Plain Text zipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (15, 'Docbook', 'SGML-based Docbook');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (16, 'Docbook (gz)', 'SGML-based Docbook gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (17, 'DVI', 'DVI');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (18, 'DVI (gz)', 'DVI gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (19, 'SGML', 'Standard Generalized Markup Language');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (20, 'SGML (gz)', 'Standard Generalized Markup Language gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (21, 'SGML (tar.gz)', 'Standard Generalized Markup Language gzipped tar archive');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (22, 'XML', 'Extendable Markup Language');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (23, 'XML (tar.gz)', 'Extendable Markup Language gzipped tar archive');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (24, 'Hardcover', 'Hardcover');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (25, 'Paperback', 'Paperback');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (26, 'Paper', 'Paper');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (27, 'Softcover', 'Softcover');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (28, 'Texinfo', 'Texinfo');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (29, 'LaTex', 'LaTex');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (30, 'PDF (gz)', 'Portable Document Format gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (31, 'PDF (bz2)', 'Portable Document Format bzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (32, 'doc (pdb)', 'DOC PalmPilot');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (33, 'isilo (pdb)', 'iSilo PalmPilot');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (34, 'chm', 'Windows HTML Help');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (35, 'HTML (gz)', 'HTML gzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (36, 'HTML (bz2)', 'HTML bzipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (37, 'HTML (printable)', 'HyperText Markup Language as printable');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (38, 'SGML (zip)', 'Standard Generalized Markup Language zipped');
INSERT INTO FORMATDEF (ID, NAME, KOMMENTAR) VALUES (39, 'Texinfo (gz)', 'Texinfo gzipped');
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

#
# Dumping data for table `KATEGORIE`
#

INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1091, 'Other (human) Languages', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (3, 'System Administration and Configuration', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (4, 'Hardware', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (5, 'Networking', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (7, 'Programming', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1092, 'Miscellaneous', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (11, 'Computer Technique', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1098, 'General', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (14, 'Free Software/Open Source', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1, 'Categories', 0,  NULL);
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1014, 'The Linux OS', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1015, 'Getting Started', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1016, 'Switching from Other Operating Systems', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1017, 'Distributions', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1018, 'Installation', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1019, 'Kernel', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1020, 'Boot Loaders and Booting the OS', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1021, 'Parallel Processing', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1022, 'Partitions and Filesystems', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1023, 'RAID', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1024, 'Printing', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1025, 'Shell', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1026, 'Using Linux', 1014, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1027, 'Configuration', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1028, 'Benchmarking', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1029, 'Clustering', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1030, 'Backup', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1031, 'Recovery', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1032, 'Security', 3, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1033, 'General', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1034, 'Platforms', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1035, 'Video Cards', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1036, 'CPUs / Architectures', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1037, 'CD-ROM / DVD-ROM Drives', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1038, 'Optical Disks', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1039, 'Keyboard and Console', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1040, 'Digital Cameras', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1041, 'Graphic Tablets', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1042, 'Diskettes', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1043, 'Hard Disks', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1044, 'Jaz and ZIP Drives', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1045, 'Mice', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1046, 'Modems', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1047, 'SCSI', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1048, 'Serial Ports', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1049, 'MIDI / Sound Cards', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1050, 'Tape Drives', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1051, 'Touchscreens', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1052, 'UPS', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1053, 'Wireless', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1054, 'Miscellaneous', 4, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1055, 'General', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1056, 'Protocols', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1057, 'Dial-up', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1058, 'DNS', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1059, 'Virtual Private Networks', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1060, 'Bridging', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1061, 'Routing', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1062, 'Security', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1063, 'Telephony / Satellite', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1064, 'Miscellaneous', 5, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1065, 'Applications / GUI / Multimedia', 1, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1066, 'Installing Applications', 1065, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1067, 'User Applications', 1065, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1068, 'Server Applications', 1065, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1069, 'GUI / Window Managers', 1065, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1070, 'Multimedia', 1065, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1071, 'DBMS / Databases', 1068, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1072, 'Mail', 1068, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1073, 'Usenet Network News', 1068, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1074, 'HTTP / FTP', 1068, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1075, 'Miscellaneous', 1068, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1076, 'X Window System', 1069, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1077, 'Window Managers', 1069, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1078, 'Fonts', 1069, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1079, 'Audio', 1070, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1080, 'Video', 1070, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1081, 'General', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1082, 'Compilers', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1083, 'Languages', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1084, 'Libraries', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1085, 'Interfaces / API / Protocols', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1086, 'Security', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1087, 'Tools', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1088, 'Version Control', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1089, 'DBMS / Databases', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1090, 'Miscellaneous', 7, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1093, 'Language Support', 1091, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1094, 'Using Specific Languages', 1091, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1095, 'Authoring / Documentation', 1092, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1096, 'Linux Advocacy / Getting (and Staying) Involved', 1092, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1097, 'Hobbies and Special Interests', 1092, '');
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1099, 'Sound Cards', 4,  NULL);
INSERT INTO KATEGORIE (ID, NAME, PARENT_ID, KOMMENTAR) VALUES (1100, 'Desktop Environments', 1069, '');
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

#
# Dumping data for table `SPRACHEDEF`
#

INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('1', 'German');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('2', 'English');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('3', 'French');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('4', 'Spanish');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('5', 'Portuguese');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('6', 'Swedish');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('7', 'Czech');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('8', 'Dutch');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('9', 'Hungarian');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('10', 'Italian');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('11', 'Japanese');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('12', 'Korean');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('13', 'Polish');
INSERT INTO SPRACHEDEF (ID, SPRACHE) VALUES ('14', 'Finnish');
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

#
# Dumping data for table `TYPDEF`
#

INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (2, 'FAQ', 'Frequently asked Questions with Answers');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (3, 'HOWTO', 'Tutorial and information on various features of a system');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (4, 'Mini-HOWTO', 'Information on short, specific subjects');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (5, 'Guide', 'Complete information about a subject');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (6, 'Book', 'Book about a specific topic');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (9, 'Magazine', 'Magazines, Journals and Columns');
INSERT INTO TYPDEF (ID, NAME, KOMMENTAR) VALUES (10, 'Standard/License', 'Standards or Licenses');
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

#
# Dumping data for table `auth_user`
#

INSERT INTO auth_user VALUES ('c8a174e0bdda2011ff798b20f219adc5', 'oldfish', 'oldfish', 'Administrator', 'root@localhost', 20020405192013, 20010401162518, 'user,editor,admin');
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

