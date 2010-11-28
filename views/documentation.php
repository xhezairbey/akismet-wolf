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
?>
<h3>Introduction</h3>
<p>The Akismet Plugin for Wolf CMS is a way to integrate the popular Akismet anti-spam service in order to catch spam comments and stop them from showing in your site's pages.</p>
<p>It is thought to be used alongside Wolf CMS Comment Plugin, which means that Comment Plugin should already be enabled. (duh!)</p>
<p></p>
<h3>Configuration</h3>
<p>Before you use Akismet Plugin in your site, you need to configure two required settings, an Akismet API Key and your blog/site URL with a trailing slash at the end of it. You can get an API key at <a href="http://akismet.com/get/" title="Get an API Key">http://akismet.com/get/</a>.</p>
<p>Check out the <a href="<?php echo get_url('plugin/akismet/settings'); ?>">Settings</a> page of the plugin for configuration options.</p>
<p></p>
<h3>Using the Akismet plugin</h3>
<p>The Akismet plugin tab you see here, displays something like: "Akismet (5)". This means there are 5 caught spam comments waiting in the spam queue for your approval or deletion.</p>
<p>Clicking the Akismet tab, you will have listed all the comments that were marked as spam and are currently in the queue. From there, you may choose two different options:
</p>
<ul>
  <li>1) <strong>Delete</strong>: for deleting a specific comment. This will remove the comment from the database.</li>
  <li>2) <strong>Ham (Approve)</strong>: if you want to to approve a false positive, also known as ham. Choosing this option, follows an immediate approval of the comment.</li>
</ul>
<p></p>
<h3>Additional Notes</h3>
<p>Normally after activation, Akismet Plugin provides two main functions, Spam check and and Ham submition.</p>
<p>For more information please check the official Akismet Wolf CMS Plugin's <a href="http://wp.xhezairi.com/code/akismet-wolf/" title="Akismet Plugin for Wolf CMS">release page</a>.</p>

<p><strong>Note:</strong> When you disable the akismet plugin, the plugin records and settings stored in database will remain intact.<br /> If you decide to uninstall it, however, all the settings stored in the database related to Akismet Plugin will be removed and cannot be retrieved.</p>
<p></p>
<h3>License</h3>
<p>This plugin has been made available under the GNU GPL3 or later.</p>
<p>Copyright (C) 2010 Arian Xhezairi &lt;arian@xhezairi.com&gt;/p>
<p>Please read the full license statement at <a href="http://www.gnu.org/licenses/gpl.html">GNU GPL3 License</a> page.</p>
<p><em><small>The Akismet Class used in this plugin to invoke all the Akismet Service API functionality is a work of <a href="http://www.achingbrain.net/">Alex Potsides</a>. The icons used in the Sidebar are a creation of <a href="http://www.woothemes.com/2009/09/woofunction/" title="Get the WooFunction Web Design Icon Set">WeFunction</a>, as such are propriaty of their own authors.</small></em></p>
