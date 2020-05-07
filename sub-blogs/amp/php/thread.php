<header class="header h_m h_m_1"> <div class="hamb-mnu"> <div class="cntr"> <div class="head h_m_w"> <div class="logo"> <div class="amp-logo"> <h1><?php echo $content['topicTitle'] ?></h1> </div> </div> <div class="clearfix"></div> </div> </div> </div> </header> <div class="content-wrapper"> <div class="p-m-fl"> </div> <div class="sp cntr"><div id="bbpress-forums"> <div class="bbp-breadcrumb"><p><a href="<?php echo $this->site_url() ?>" class="bbp-breadcrumb-home"><?php echo $L->get( 'forum-home' ) ?></a> <span class="bbp-breadcrumb-sep">›</span> <a href="<?php echo $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] ?>" class="bbp-breadcrumb-forum"><?php echo $L->get( 'forum-nav' ) ?></a> <span class="bbp-breadcrumb-sep">›</span> <span class="bbp-breadcrumb-current"><?php echo $content['topicTitle'] ?></span></p></div>

<?php if ( empty( $content ) ) : ?>

<article id="post-0" class="vce-page post-0 forum type-forum status-publish hentry">
<p>Nothing Found</p>
</article>

<?php else : 
if ( $content['currentUser']['canBrowse'] ) : ?>
<ul id="forums-list-0" class="bbp-forums">
<?php if ( empty( $content['list'] ) ) : ?>
<li class="bbp-forum-info">Nothing Found</li>
<?php else : ?>
<li class="bbp-header"> <ul class="forum-titles">
<li class="bbp-forum-info">Forum</li> <!--<li class="bbp-forum-topic-count">Topics</li>--> <li class="bbp-forum-reply-count">Replies</li><!--<li class="bbp-forum-freshness">Freshness</li>--> </ul></li>
<?php foreach ( $content['list'] as $topicKey => $topic ) : ?><ul id="bbp-topic-<?php echo $topicKey ?>" class="loop-item-0 user-id-2 bbp-parent-forum-<?php echo $topicKey ?> odd post-<?php echo $topicKey ?> <?php echo ( $topic['isSticky'] ? 'sticky' : '' ) ?> topic type-topic status-publish hentry">
	<li class="bbp-topic-title">

		<a class="bbp-topic-permalink" href="<?php echo $topic['url'] ?>"><?php echo $topic['title'] ?></a>

		<p class="bbp-topic-meta">
			<span class="bbp-topic-started-by">Started by: <a href="<?php echo $topic['postStarter']['profileURL'] ?>" title="View <?php echo $topic['postStarter']['nickcame'] ?>&#039;s profile" class="bbp-author-link"><span  class="bbp-author-avatar"><img src="<?php echo $topic['postStarter']['avatar'] ?>" width="14" height="14" alt="<?php echo $topic['postStarter']['nickcame'] ?>" class="avatar avatar-14 wp-user-avatar wp-user-avatar-14 alignnone photo" /></span><span  class="bbp-author-name"><?php echo $topic['postStarter']['nickcame'] ?></span></a> on <?php echo $topic['date'] ?></span>
		</p>
	</li>
<!--
	<li class="bbp-topic-voice-count">3</li>
-->
	<li class="bbp-topic-reply-count"><?php echo $topic['topicReplies'] ?></li>
<?php if ( !empty( $topic['lastReply'] ) ) : ?>
<br />
	<li class="bbp-topic-freshness">
		Last post: <a href="<?php echo $topic['lastReply']['topicURL'] ?>" title="<?php echo $topic['lastReply']['title'] ?>"><?php echo $topic['lastReply']['dateNice'] ?></a>
	</li>
<?php endif ?>
</ul><!-- #bbp-topic-<?php echo $topicKey ?> --><?php endforeach ?>
<li class="bbp-footer"> <div class="tr"> <p class="td colspan4"> </p> </div> </li> <?php endif ?></ul><?php endif ?>
<?php endif ?></div> </div></div>