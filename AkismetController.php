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

class AkismetController extends PluginController {

  private static function _checkPermission() {
    AuthUser::load();
    if ( !AuthUser::isLoggedIn() ) {
      redirect(get_url('login'));
    }
  }

  function __construct() {
    self::_checkPermission();
    $this->setLayout('backend');
    $this->assignToLayout('sidebar', new View('../../plugins/akismet/views/sidebar'));
  }

  /*
  * Verify API Key.
  * @return message on boolean value.
  */
  function verifyKey() {
    $akismet = new Akismet(akismet_get_blog(), $settings['akismet_api_key']);
    if($akismet->isKeyValid()) {
      // api key is okay
      echo "Valid Key!";
    } else {
      // api key is invalid
      echo "Invalid Key!";
    }
  }

  /*
  * Check if comment is spam.
  * If True set comment is_spam and is_approved values.
  */
  function spamCheck(&$comment) {
    if (is_null($comment)) return;

    (int)$cpid = $comment->page_id;
    $pid = Page::linkById($cpid);

    $akismet = new Akismet(akismet_get_blog(), akismet_get_key());
    $akismet->setCommentAuthor($comment->author_name);
    $akismet->setCommentAuthorEmail($comment->author_email);
    $akismet->setCommentAuthorURL($comment->author_link);
    $akismet->setCommentContent($comment->body);
    $akismet->setPermalink($pid);

    if($akismet->isCommentSpam()) {
      $comment->is_spam = 1; // flag the comment as spam
      $comment->is_approved = 0; // remove from approved comments
      $comment->save();
    }
  }

  /*
  * Mark spam comment as ham.
  */
  function ham($id) {
    if ($comment = Record::findByIdFrom('Comment', $id)) {

    (int)$cpid = $comment->page_id;
    $pid = Page::linkById($cpid);

    $akismet = new Akismet(akismet_get_blog(), akismet_get_key());
    $akismet->setCommentAuthor($comment->author_name);
    $akismet->setCommentAuthorEmail($comment->author_email);
    $akismet->setCommentAuthorURL($comment->author_link);
    $akismet->setCommentContent($comment->body);
    $akismet->setUserIP($comment->ip);
    $akismet->setPermalink($pid);
    $akismet->submitHam();

      $comment->is_spam = 0;
      $comment->is_approved = 1;
      if ($comment->save()) Flash::set('success', __('Spam comment has been marked as ham!'));

    } else Flash::set('error', __('Spam comment not found!'));

    redirect(get_url('plugin/akismet'));
  }

  /*
  * Mark a regular comment as spam.
  */
  function spam($id) {	
    if ($comment = Record::findByIdFrom('Comment', $id)) {

    (int)$cpid = $comment->page_id;
    $pid = Page::linkById($cpid);
	
    $akismet = new Akismet(akismet_get_blog(), akismet_get_key());
    $akismet->setCommentAuthor($comment->author_name);
    $akismet->setCommentAuthorEmail($comment->author_email);
    $akismet->setCommentAuthorURL($comment->author_link);
    $akismet->setCommentContent($comment->body);
    $akismet->setUserIP($comment->ip);
    $akismet->setPermalink($pid);
    $akismet->submitSpam();

      $comment->is_spam = 1;
      $comment->is_approved = 0;
      if ($comment->save()) Flash::set('success', __('Comment has been marked as spam!'));

    } else Flash::set('error', __('Comment not found!'));

    redirect(get_url('plugin/comment/index'));
  }

  /*
  * Delete spam comment.
  */
  function delete($id) {
    if ($comment = Record::findByIdFrom('Comment', $id)) {
      if ($comment->delete()) {
        Flash::set('success', __('Spam Comment has been deleted!'));
        Observer::notify('spam_comment_deleted', $comment);
      }
      else {
        Flash::set('error', __('Spam Comment has not been deleted!'));
      }
    }	else Flash::set('error', __('Spam Comment not found!'));
		
    redirect(get_url('plugin/akismet'));
  }

  function index($page = 0) {
    $this->display('akismet/views/index', array(
      'comments' => Comment::findAll(array('where' => 'is_spam=1')),
      'page' => $page
    ));
  }

  function documentation() {
    $this->display('akismet/views/documentation');
  }
	
  function stats() {
    $this->display('akismet/views/stats');
  }

  function settings() {
    $this->display('akismet/views/settings', array('settings' => Plugin::getAllSettings('akismet')));
  }

  /*
  * Save Akismet settings.
  */
  function save() {
    if (isset($_POST['settings'])) {

    $settings = $_POST['settings'];
    foreach ($settings as $key => $value) {
      $settings[$key] = mysql_escape_string($value);
    }

      $ret = Plugin::setAllSettings($settings, 'akismet');
      if ($ret) Flash::set('success', __('The settings have been saved.'));
      else Flash::set('error', 'An error occured trying to save the settings.');

    } else Flash::set('error', 'Could not save settings, no settings found.');

    redirect(get_url('plugin/akismet/settings'));
  }

} //end AkismetController
