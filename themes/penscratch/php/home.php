<?php foreach ($content as $page): ?>
	<article id="post-<?php echo $page->position(); ?>" class="post-<?php echo $page->position(); ?> post type-post status-publish format-standard hentry category-<?php echo $page->categoryMap(true);?>">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php echo $page->permalink(); ?>" rel="bookmark"><?php echo $page->title(); ?></a></h1>
		</header><!-- .entry-header -->
		<?php if ($page->coverImage()): ?>
		<div class="entry-thumbnail">
			<a href="<?php echo $page->permalink(); ?>"><img alt="" class="attachment-penscratch-2-featured size-penscratch-2-featured wp-post-image" data-image-size="penscratch-2-featured" height="300" src="<?=$page->coverImage();?>" width="656"></a>
		</div>
		<?php endif ?>
		<div class="entry-meta">
			<span class="posted-on"><a href="<?php echo $page->permalink(); ?>" rel="bookmark"><time class="entry-date published" datetime="<?php echo date ('c', strtotime($page->dateRaw())) ?>"><?php echo $page->date() ?></time></a></span><span class="byline"><span class="author vcard"><span class="sep"> ~ </span><?=$page->user('firstName');?></span></span>
			<span class="sep"> ~ </span><span class="comments-link"><a href="<?php echo $page->permalink(); ?>#disqus_thread">Comment</a></span>
		</div><!-- .entry-meta -->
		<div class="entry-content">
			<?php echo $page->contentBreak(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
<?php endforeach ?>

<?php if (Paginator::numberOfPages()>1): ?>
<nav class="navigation posts-navigation" role="navigation">
	<h2 class="screen-reader-text">Navigation</h2>
	<div class="nav-links">
	<?php if (Paginator::showNext()) : ?>
		<div class="nav-previous">
			<a href="<?php echo Paginator::nextPageUrl() ?>">Older Posts</a>
		</div>
	<?php endif ?>
	<?php if (Paginator::showPrev()) : ?>
		<div class="nav-next">
			<a href="<?php echo Paginator::previousPageUrl() ?>">Newer Posts</a>
		</div>
	<?php endif ?>
	</div>
</nav>
<?php endif ?>