<?php
/*
 * The Akismet spam fighting plugin provides the option of blocking spam comments from appearing on your blog.
 *
 * @author Arian Xhezairi <arian@xhezairi.com>
 * @version 0.2.0
 * @requires Wolf version 0.6.0
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 License
 * @copyright Arian Xhezairi, 2010
*/

Plugin::setInfos(array(
  'id'          => 'akismet',
  'title'       => 'Akismet', 
  'description' => 'Fight spam comments by harnessing the power of Akismet.', 
  'version'     => '0.2.0',
  'license'     => 'GPL',
  'author'      => 'Arian Xhezairi',
  'website'     => 'http://www.xhezairi.com/',
  'update_url'  => 'http://www.xhezairi.com/plugin-versions.xml',
  'require_wolf_version' => '0.6.0',
  'type'        => 'backend'
));

// Root location where Akismet plugin lives.
define('AKISMET_ROOT', URI_PUBLIC.'wolf/plugins/akismet/');

// Load the Akismet class into the system.
AutoLoader::addFile('Akismet', CORE_ROOT.'/plugins/akismet/lib/Akismet.php');

// Add the Akismet Tab.
Plugin::addController('akismet', 'Akismet', 'administrator', true);

// Observe Events
Observer::observe('comment_after_add', 'spamCheck');
Observer::observe('view_backend_list_plugin', 'spam_comment_display_count');
Observer::observe('plugin_after_enable', 'akismet_admin_warning');

/*
 * Returns the number of spam comments.
 *
 * @return int Number of comments waiting for in spam queue.
*/
function spam_comments_count() {
  return (int) count(Comment::find(array('where' => 'is_spam=1')));
}

/*
 * Display the number of spam comments.
 *
 * @return string Total comments in spam queue.
*/
function spam_comment_display_count(&$plugin_name, &$plugin) {
  if ($plugin_name == 'akismet') {
    $plugin->label .=' <span id="spam-queue">('.spam_comments_count().')</span>';
  }
}

function akismet_get_key() {
	global $akismet_api_key;
	if ( !empty($akismet_api_key) )
		return $akismet_api_key;
	return Plugin::getSetting('akismet_api_key', 'akismet');
}

function akismet_get_blog() {
	global $akismet_blog_url;
	if ( !empty($akismet_blog_url) )
		return $akismet_blog_url;
	return Plugin::getSetting('akismet_blog_url', 'akismet');
}

function akismet_stats_display() {
  $url = "http://".akismet_get_key().".web.akismet.com/1.0/user-stats.php?blog=".akismet_get_blog()."";
  ?>
  <iframe src="<?php echo $url; ?>" width="100%" height="900px" frameborder="0" id="akismet-stats-frame"></iframe>
  <?php
}
