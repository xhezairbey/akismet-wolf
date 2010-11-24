<?php
/**
 * The Akismet spam fighting plugin provides the option of blocking spam comments from appearing on your blog.
 *
 *
 * @author Arian Xhezairi <arian@xhezairi.com>
 * @version 0.1.0
 * @requires Wolf version 0.6.0
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 License
 * @copyright Arian Xhezairi, 2010
**/

$pdo   = Record::getConnection();
$table = TABLE_PREFIX . "comment";

if (preg_match('/^mysql/', DB_DSN)) {
  /* Schema for MySQL */
  $pdo->exec("ALTER TABLE $table ADD `is_spam` INT( 1 ) NULL AFTER `is_approved`");
} else {
  /* Otherwise assume SQLite */
  $pdo->exec("ALTER TABLE $table ADD `is_spam` INT( 1 ) NULL AFTER `is_approved`");
}

// Check if the plugin's settings already exist and create them if not.
if (Plugin::getSetting('akismet_api_key', 'akismet') === false) {
	//Store Akismet Settings into Database
	$settings = array('akismet_api_key' => 'put your api key', 'akismet_blog_url' => URL_PUBLIC, 'commentsperpage' => 15);
	Plugin::setAllSettings($settings, 'akismet');
	Flash::set('success', __('Akismet Plugin Enabled!'));	
} else {
	Flash::set('success', __('Akismet Plugin Activated!'));
}
