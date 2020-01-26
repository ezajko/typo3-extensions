#
# Table structure for table 'tt_address'
#
CREATE TABLE tt_address (
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
  faculty int(11) DEFAULT '0' NOT NULL,
  field_of_expertise varchar(255) DEFAULT '' NOT NULL,
  phone2 varchar(30) DEFAULT '' NOT NULL,
  phone3 varchar(30) DEFAULT '' NOT NULL,
  email2 varchar(255) DEFAULT '' NOT NULL,
  email3 varchar(255) DEFAULT '' NOT NULL,
  np_phone tinyint(4) DEFAULT '0' NOT NULL,
  np_phone2 tinyint(4) DEFAULT '0' NOT NULL,
  np_phone3 tinyint(4) DEFAULT '0' NOT NULL,
  np_email tinyint(4) DEFAULT '0' NOT NULL,
  np_email2 tinyint(4) DEFAULT '0' NOT NULL,
  np_email3 tinyint(4) DEFAULT '0' NOT NULL,
  np_mobile tinyint(4) DEFAULT '0' NOT NULL,
  caption_phone varchar(255) DEFAULT '' NOT NULL,
  caption_phone2 varchar(255) DEFAULT '' NOT NULL,
  caption_phone3 varchar(255) DEFAULT '' NOT NULL,
  caption_email varchar(255) DEFAULT '' NOT NULL,
  caption_email2 varchar(255) DEFAULT '' NOT NULL,
  caption_email3 varchar(255) DEFAULT '' NOT NULL,
  caption_mobile varchar(255) DEFAULT '' NOT NULL,
  xing varchar(255) DEFAULT '' NOT NULL,
  speaking_time text,
  regular_courses text,
  quicklinks int(11) DEFAULT '0' NOT NULL,
  downloads int(11) DEFAULT '0' NOT NULL,
  languages text,
  content_elements int(11) DEFAULT '0' NOT NULL,
  contactfunction int(11) DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'tx_dkdfuascontacts_domain_model_link'
#
CREATE TABLE tx_dkdfuascontacts_domain_model_link (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
  t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	parent int(11) DEFAULT '0' NOT NULL,
	title tinytext,
	description text,
	uri text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);


#
# Table structure for table 'tx_dkdfuascontacts_domain_model_contactfunction'
#
CREATE TABLE tx_dkdfuascontacts_domain_model_contactfunction (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumtext,
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
  t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	title tinytext,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tt_address_id int(11) DEFAULT '0' NOT NULL
);
