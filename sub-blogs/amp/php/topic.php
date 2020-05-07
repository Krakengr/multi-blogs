<?php $url = '<a href="' . $content['lastUpdate']['url'] . '" title="View ' . $content['lastUpdate']['nickname'] . '&#039;s profile" class="bbp-author-link"><span  class="bbp-author-name">' . $content['lastUpdate']['nickname'] . '</span></a>';
?><body class="body single-post <?php echo $content['topicID'] ?> post-id-<?php echo $content['topicID'] ?> singular-<?php echo $content['topicID'] ?> amp-single topic"> <header class="header h_m h_m_1"> <input type="checkbox" id="offcanvas-menu" class="tg" /> <div class="hamb-mnu"> <div class="cntr"> <div class="head h_m_w"> <div class="logo"> <div class="amp-logo"> <h1><?php echo $content['topicTitle'] ?></h1> </div> </div> <div class="clearfix"></div> </div> </div> </div> </header> <div class="content-wrapper"> <div class="sp cntr"><div id="bbpress-forums"> <div class="bbp-breadcrumb"><p><a href="<?php echo $this->site_url() ?>" class="bbp-breadcrumb-home"><?php echo $L->get( 'forum-home' ) ?></a> <span class="bbp-breadcrumb-sep">›</span> <a href="<?php echo $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] ?>" class="bbp-breadcrumb-forum"><?php echo $L->get( 'forum-nav' ) ?></a> <span class="bbp-breadcrumb-sep">›</span> <a href="<?php echo $content['parent']['url'] ?>" class="bbp-breadcrumb-thread"><?php echo $content['parent']['title'] ?></a> <span class="bbp-breadcrumb-sep">›</span> <span class="bbp-breadcrumb-current"><?php echo $content['topicTitle'] ?></span></p></div> <div class="bbp-template-notice info"><p class="bbp-topic-description"><?php echo sprintf( $L->get( 'topic-has-replies' ), $content['numReplies'] ) . '. ' . sprintf( $L->get( 'topic-last-updated' ), $content['lastUpdate']['niceTime'], $url ) ?></p></div> <div class="bbp-pagination"> <!--<div class="bbp-pagination-count"> Viewing 1 post (of 1 total) </div>--> <div class="bbp-pagination-links"> </div> </div>
<ul id="topic-<?php echo $content['topicID'] ?>-replies" class="forums bbp-replies">
<?php if ( !empty( $content['replies'] ) ) : ?>
<li class="bbp-header"> <div class="bbp-reply-author">Author</div> <div class="bbp-reply-content"> Posts </div> </li>
<?php 
foreach ( $content['replies'] as $id => $reply ) : ?>
<li class="bbp-body"> <div id="post-<?php echo $reply['id'] ?>" class="bbp-reply-header"> <div class="bbp-meta"> <span class="bbp-reply-post-date"><?php echo $reply['date'] ?></span> <a href="#post-<?php echo $reply['id'] ?>" class="bbp-reply-permalink">#<?php echo $reply['id'] ?></a> <span class="bbp-admin-links"></span> </div> </div> <div class="odd bbp-parent-forum-155 bbp-parent-topic-155 bbp-reply-position-1 user-id-5 topic-author post-155 topic type-topic status-publish hentry">
<div class="bbp-reply-author"> <a href="<?php echo $reply['userUrl'] ?>" title="View <?php echo $reply['userNick'] ?>&#039;s profile" class="bbp-author-avatar" rel="nofollow"><amp-img alt="" src="<?php echo $reply['avatar'] ?>" class="avatar avatar-80 photo amp-wp-enforced-sizes" height="80" width="80" layout="intrinsic"></amp-img></a><br /><a href="<?php echo $reply['userUrl'] ?>" title="View <?php echo $reply['userNick'] ?>&#039;s profile" class="bbp-author-name" rel="nofollow"><?php echo $reply['userNick'] ?></a><br><div class="bbp-author-role"><?php echo $reply['role'] ?></div> </div><!-- .bbp-reply-author -->
<div class="bbp-reply-content">

		<?php echo $reply['post'] ?>

<?php if ( !empty( $reply['modified'] ) ) : ?>
<ul id="bbp-topic-revision-log-<?php echo $reply['id'] ?>" class="bbp-topic-revision-log">

	<li id="bbp-topic-revision-log-<?php echo $reply['id'] ?>-item-627" class="bbp-topic-revision-log-item">
		This topic was modified 4 years, 11 months ago by <a href="https://demo.mekshq.com/voice/?bbp_user=3" title="View Lisa Scholfield&#039;s profile" class="bbp-author-link"><span  class="bbp-author-avatar"><img src="https://mksdmcdn-9b59.kxcdn.com/voice/wp-content/uploads/2014/11/meks_2-32x32.jpg" width="14" height="14" alt="Lisa Scholfield" class="avatar avatar-14 wp-user-avatar wp-user-avatar-14 alignnone photo" /></span><span  class="bbp-author-name">Lisa Scholfield</span></a>.
	</li>

</ul>
<?php endif ?>
	
	</div><!-- .bbp-reply-content --> </div> </li><?php endforeach ?>
<?php else : ?>
<li>Nothing found</li>
<?php endif ?><!--
<li class="bbp-footer"> <div class="bbp-reply-author">Author</div> <div class="bbp-reply-content"> Posts </div> </li>--> </ul><!--<div class="bbp-pagination"> <div class="bbp-pagination-count"> Viewing 1 post (of 1 total) </div> <div class="bbp-pagination-links"> </div> </div> <div id="no-reply-155" class="bbp-no-reply"> <div class="bbp-template-notice"> <p>You must be logged in to reply to this topic.</p> </div> </div>--> </div> </div></div>