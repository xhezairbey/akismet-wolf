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
<p class="button"><a href="<?php echo get_url('plugin/akismet/'); ?>">
  <img src="<?php echo AKISMET_ROOT;?>images/comment.png" align="middle" alt="page icon" /> <?php echo __('Spam Comments'); ?></a>
</p>
<p class="button"><a href="<?php echo get_url('plugin/akismet/settings'); ?>">
  <img src="<?php echo AKISMET_ROOT;?>images/settings.png" align="middle" alt="page icon" /> <?php echo __('Settings'); ?></a>
</p>
<p class="button"><a href="<?php echo get_url('plugin/akismet/stats/'); ?>">
  <img src="<?php echo AKISMET_ROOT;?>images/activity.png" align="middle" alt="page icon" /> <?php echo __('Spam Statistics'); ?></a>
</p>
<p class="button"><a href="<?php echo get_url('plugin/akismet/documentation/'); ?>">
  <img src="<?php echo AKISMET_ROOT;?>images/info.png" align="middle" alt="page icon" /> <?php echo __('Documentation'); ?></a>
</p>
