== CHANGELOG ==

* 0.2.0 Release - * * 2010

+ Added two new methods, verifyKey() for API key validation and purge() for emptying all the spam in the queue.
+ Added API Key validation notificator with color and text in Settings page.
+ Added Empty Spam Queue button in spam listing page (main page).
+ Added an extra functionality additional documentation page.
+ Added documentation comments for some functions.
- Fixed Typos through in and out all plugin files.
. Moved spamCheck, verifyKey and purge methods over to AkismetController.php for more MVC adherance.

* 0.1.0 - Initial Public Release - 19 Sep. 2010

== WHAT IT IS ==

The Akismet Plugin for Wolf CMS is a way to integrate the popular Akismet anti-spam service in order to catch spam comments and stop them from appearing in your site's pages.

This akismet plugin provides the following features:
- Check for SPAM in the submitted comments and report to Akismet Service.
- List Spam makred comments and filter them out from regular comments
- Mark false spam marked comments as ham and report to Akismet Service.
- Delte SPAM comments from the database
- EXTRA: mark comments AS SPAM and report to Akismet Service

== HOW TO USE IT ==

* Using this plugin requires you to first enabled Wolf CMS Comment Plugin.
* Enable Akismet Plugin from SETTINGS page in Wolf CMS Administration Panel
* Go to Akismet Plugin Settings and provide an API Key in the respective field.
* Fill in your desired blog/site URL in the respective field. Don't forget to include a trailing slash at the end of it.
* Set a desired number to list spam comments per page.

== EXTRA FUNCTIONALITY ==

* To enable an additional function that is bundled in the Akismet Plugin
please check the official public release page for further instructions, at http://www.xhezairi.com/code/akismet-wolf.html

== LICENSE ==

Copyright 2010, Arian Xhezairi. <arian@xhezairi.com>, www.xhezairi.com

This plugin is licensed under the GPLv3 License.
<http://www.gnu.org/licenses/gpl.html>