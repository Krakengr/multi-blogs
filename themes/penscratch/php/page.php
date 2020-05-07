<?php 
	$tags = ( ( !$url->notFound() && !$page->isStatic() ) ? $page->tags(true) : '' );
?>
<article class="post-<?php echo $page->position() ?> <?php echo ( ( !$url->notFound() && !$page->isStatic() ) ? ' post type-post' : ' page type-page') ?> status-publish format-standard <?php echo ( ( !$url->notFound() && !$page->isStatic() && $page->coverImage() ) ? 'has-post-thumbnail' : '' ) ?> hentry <?php if ( !empty( $page->categoryKey() ) ) : ?>category-<?php echo $page->categoryKey() ?> <?php endif?> <?php if ( !empty($tags) && is_array($tags) ) : ?>tag-<?=implode(" tag-", array_keys($tags));?><?php endif;?>" id="post-<?php echo $page->position() ?>">

<?php Theme::plugins('pageBegin'); ?>
						<header class="entry-header">
							<h1 class="entry-title"><?php echo $page->title() ?></h1>
							<?php if ( !$url->notFound() && !$page->isStatic() ) : ?>
							<div class="entry-meta">
								<span class="posted-on"><time class="entry-date published" datetime="<?php echo date ('c', strtotime($page->dateRaw())) ?>"><?php echo postDate() ?></time></span> <span class="byline"><span class="author vcard"><span class="sep">~</span> <?php echo $page->user('nickname') ?></span></span>
							</div>
						<?php endif ?>
						</header>
						<div class="entry-content">
							<?php echo $page->content() ?>
						</div>
					<?php if ( !$url->notFound() && !$page->isStatic() ) : ?>
						<footer class="entry-footer">
							<span class="cat-links">Posted in <a href="<?php echo DOMAIN_CATEGORIES . $page->categoryKey() ?>" rel="category tag"><?php echo $page->category() ?></a></span> <?php if( $page->type() == "published" && !empty($tags) ) :
									$num_tags = count( $tags );
									$num = 0;
							?><span class="tags-links"><?php foreach($tags as $tagKey=>$tagName) :?><a href="<?php echo DOMAIN_TAGS.$tagKey;?>" rel="tag"><?=$tagName;?></a><?=($num = $num_tags) ? '' : ',';?>
					<?php endforeach; endif; ?></span>
						</footer>
						
						<?php if ( authorAbout() ) : ?>
						<div class="entry-author">
							<div class="author-avatar"><img alt='' class='avatar avatar-60 photo' height='60' src='https://2.gravatar.com/avatar/<?php echo md5( $page->user('email') ) ?>?s=96&d=mm' srcset='https://2.gravatar.com/avatar/<?php echo md5( $page->user('email') ) ?>?s=192&d=mm 2x' width='60'></div>
							<div class="author-heading">
								<h2 class="author-title">Published by <span class="author-name"><?php echo $page->user('nickname') ?></span></h2>
							</div>
							<p class="author-bio"><?php echo authorAbout() ?></p>
						</div>
					<?php endif; //authorAbout ?>
					
					<?php endif; //notFound  ?>
					
					<?php Theme::plugins('pageEnd'); ?>
					</article>
				
				<?php
					if ( !$url->notFound() && !$page->isStatic() ) :
	
						$nxt = ( !empty( nextPrev()['next'] ) ? buildPage(nextPrev()['next']) : '' );
						$prv = ( !empty( nextPrev()['prev'] ) ? buildPage(nextPrev()['prev']) : '' );
						
						if ( !empty( $nxt ) || !empty( $prv ) ) :
				?>
					<nav class="navigation post-navigation" role="navigation">
						<h2 class="screen-reader-text">Browse Posts</h2>
						<div class="nav-links">
						<?php if (!empty($prv)): ?>
							<div class="nav-previous">
								<a href="<?=$prv->permalink();?>" rel="prev"><span class="meta-nav">&lsaquo; Previous</span><?=$prv->title();?></a>
							</div>
						<?php endif ?>
						<?php if ( !empty( $nxt ) ): ?>
							<div class="nav-next">
								<a href="<?=$nxt->permalink();?>" rel="next"><span class="meta-nav">Next &rsaquo;</span><?=$nxt->title();?></a>
							</div>
						<?php endif ?>
						</div>
					</nav>
					<?php endif ?>
					
					
					<?php if ( $page->allowComments() && disqusCode() ) :?>
					<div class="dcl-disqus-thread" id="comments">
						<div id="disqus_thread"></div>
					</div>
				<script>

				var disqus_config = function () {
				this.page.url = '<?php echo $page->permalink() ?>';
				this.page.identifier = '<?php echo $page->key() ?>';
				};

				(function() {
				var d = document, s = d.createElement('script');
				s.src = 'https://<?php echo disqusCode() ?>.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
				})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				<?php endif ?>
				
				<?php endif ?>