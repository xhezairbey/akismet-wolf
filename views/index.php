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
<h1><?php echo __('Spam'); ?></h1>
<div class="purge-button"><a href="<?php echo get_url('plugin/akismet/purge/'); ?>">Empty Spam Queue</a></div>
<br />
<!--<div id="comments-def">
    <div class="comment"><?php echo __('Comments'); ?></div>
    <div class="modify"><?php echo __('Actions'); ?></div>
</div>-->
<?php
global $__CMS_CONN__;
$sql = "SELECT COUNT(*) FROM ".TABLE_PREFIX."comment WHERE is_spam = 1";
$stmt = $__CMS_CONN__->query($sql);
$comments_count = $stmt->fetchColumn();
$stmt->closeCursor();

if (isset($page)) $CurPage = $page; 
else $CurPage = 0;

$rowspage = Plugin::getSetting('commentsperpage', 'akismet');
$start = $CurPage * $rowspage;

$totalrecords = $comments_count;
$sql = "SELECT comment.is_spam, comment.id, comment.page_id, comment.author_name, comment.author_email, comment.author_link, comment.body, comment.created_on, page.title FROM " . TABLE_PREFIX . "comment AS comment, " . TABLE_PREFIX .
    "page AS page WHERE comment.is_spam = 1 AND comment.page_id = page.id LIMIT " . $start . "," . $rowspage;

$stmt = $__CMS_CONN__->prepare($sql);
$stmt->execute();
$lastpage = ceil($totalrecords / $rowspage);
if($comments_count <= $rowspage) { $lastpage = 0; } else { $lastpage = abs($lastpage - 1); }
?>
<?php if ($comments_count > 0): ?>
<table class="allspam">
	<thead id="comment-table-header">
    <tr>
      <th scope="col" id="checkbox" class="column-cb check-column"><input type="checkbox"></th>
      <th scope="col" id="comment-author" class="column-author">Author</th>
      <th scope="col" id="comment-body" class="column-body">Comment</th>
      <th scope="col" id="comment-post" class="column-post">In Post</th>
    </tr>
  </thead>
	<tbody id="the-comment-list" class="the-comment-list">
	<?php while ($comment = $stmt->fetchObject()): ?>
    <tr class="<?php echo odd_even(); ?> spam">
      <th scope="row" class="check-column"><input type="checkbox" name="delete_comments[]" value="<?php echo $comment->id; ?>"></th>
      <td class="comment-author"><strong><?php echo $comment->author_name; ?></strong> (<?php echo $comment->author_email; ?>)<br /><?php echo $comment->author_link; ?></td>
      <td class="comment-body"><em><?php echo date('D, j M Y', strtotime($comment->created_on)); ?></em><br /><?php echo $comment->body; ?></td>
      <td class="comment-post"><?php echo Page::linkById(6); ?></td>
    </tr>
	<?php endwhile; ?>
</tbody>
</table>
<?php else: ?>
<h6><strong><?php echo __('You must be very lucky, no spam comments found at this time.'); ?></strong></h6>
<?php endif; ?>
<br />
          <div class="infos">

              <a href="<?php echo get_url('plugin/akismet/ham/' . $comment->id); ?>"><?php echo __('Ham (Approve)'); ?></a> | 
              <a href="<?php echo get_url('plugin/akismet/delete/' . $comment->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete it?'); ?>');"><?php echo __('Delete'); ?></a>
          </div>

<div class="pagination">

<?php

if ($CurPage == $lastpage) {
  $next = '<span class="disabled">Next Page</span>';
} else {
  $nextpage = $CurPage + 1;
  $next = '<a href="' . get_url('plugin/akismet/index/') . '' . $nextpage . '">Next Page</a>';
}

if ($CurPage == 0) {
  $prev = '<span class="disabled">Previous Page</span>';
} else {
  $prevpage = $CurPage - 1;
  $prev = '<a href="' . get_url('plugin/akismet/index/') . '' . $prevpage . '">Previous Page</a>';
}

if ($CurPage != 0) {
  echo "<a href=" . get_url('plugin/akismet/index/') . "0>First Page</a>\n ";
} else {
  echo "<span class=\"disabled\">First Page</span>";
}
  echo $prev;
    for ($i = 0; $i <= $lastpage; $i++) {
      if ($i == $CurPage)
        echo '<span class="current">' . $i . '</span';
      else
        echo " <a href=" . get_url('plugin/akismet/index/') . "$i>$i</a>\n";
      }
        echo $next;
          if ($CurPage != $lastpage) {
            echo "\n<a href=" . get_url('plugin/akismet/index/') . "$lastpage>Last Page</a>&nbsp&nbsp;";
          } else {
            echo "<span class=\"disabled\">Last Page</span>";
          }
?>
</div>
