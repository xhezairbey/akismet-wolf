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
<h1><?php echo __('Settings'); ?></h1>
<form action="<?php echo get_url('plugin/akismet/save'); ?>" method="post">
  <fieldset style="padding: 0.5em;">
    <legend style="padding: 0.5em 0.5em 0em 0.5em; font-weight: bold;"><?php echo __('Akismet settings'); ?></legend>
      <table class="fieldset" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td class="label"><label for="akismet_api_key"><?php echo __('Your Akismet Api Key'); ?>: </label></td>
          <td class="field">
  				<input class="textinput" size="25" name="settings[akismet_api_key]" type="text" value="<?php echo $settings['akismet_api_key']; ?>" /> <?php echo verifyKey(); ?></td>
          <td class="help"><?php echo __('Your Akismet API Key. You can <a href="http://akismet.com/get/">get one</a> for free'); ?></td>
        </tr>
        <tr>
          <td class="label"><label for="akismet_blog_url"><?php echo __('Your blog/site URL'); ?>: </label></td>
          <td class="field">
	  			<input class="textinput" size="25" name="settings[akismet_blog_url]" type="text" value="<?php echo $settings['akismet_blog_url']; ?>" /></td>
          <td class="help"><?php echo __('Your blog URL, with a trailing slash at the end.'); ?></td>
        </tr>
        <tr>
          <td class="label"><label for="akismet_commentsperpage"><?php echo __('Comments per page'); ?>: </label></td>
          <td class="field">
    			<input class="textinput" size="25" name="settings[commentsperpage]" type="text" value="<?php echo $settings['commentsperpage']; ?>" /></td>
          <td class="help"><?php echo __('Number of spam comments to list per page.'); ?></td>
        </tr>
      </table>
  </fieldset>
  <p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
  </p>
</form>
