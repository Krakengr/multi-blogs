<?php $postdate = ( ( isset( $langDetails['dateFormat'] ) && !empty( $langDetails['dateFormat'] ) ) ? date( $langDetails['dateFormat'], strtotime( $page->dateRaw() ) ) : $page->date() ); ?>
<article class="post">
    <header class="post-header">
        <h1 class="post-title"><?php echo $page->title() ?></h1>
            <section class="post-meta">
                <p class="author">by <?=$page->user('firstName');?></p>
                <time datetime="<?php echo date ('c', strtotime( $page->dateRaw() ) ) ?>"><?php echo $postdate ?></time>
            </section>
    </header>
    <section class="post-content">
	<?php if ( $page->coverImage() ): ?>
<amp-img width="575" height="373" src="<?php echo $page->coverImage(); ?>" alt=""></amp-img>
<?php endif ?>
  
		<?php echo $page->content(); ?>
		
		<a href="<?php echo $permalink; ?>#disqus_thread" class="button add-comment">Add Comment</a>
		
		<?php if ( checkKey( $ampSettings, 'adslot' ) ) : ?>
		
		<amp-auto-ads type="adsense"
			data-ad-client="<?php echo $ampSettings['adslot'] ?>">
		</amp-auto-ads>


		<amp-ad width="100vw" height=320
		  type="adsense"
		  data-ad-client="<?php echo $ampSettings['adclient'] ?>"
		  data-ad-slot="<?php echo $ampSettings['adslot'] ?>"
		  data-auto-format="rspv"
		  data-full-width>
		<div overflow></div>
	</amp-ad>
<?php endif;?>
    </section>
	<?php /*if (!empty($disqus_code)) : ?>
	<div id="disqus_thread"></div>
<script>
window.addEventListener('message', receiveMessage, false);
function receiveMessage(event)
{
    if (event.data) {
        var msg;
        try {
            msg = JSON.parse(event.data);
        } catch (err) {
            // Do nothing
        }
        if (!msg)
            return false;

        if (msg.name === 'resize') {
            window.parent.postMessage({
              sentinel: 'amp',
              type: 'embed-size',
              height: msg.data.height
            }, '*');
        }
    }
}
</script>
<script>
    var disqus_config = function () {
        this.page.url = '<?php echo $page->permalink() ?>';
		this.page.identifier = '<?=$page->key();?>';
    };
    (function() {
        var d = document, s = d.createElement('script');

        s.src = '//<?=$disqus_code;?>.disqus.com/embed.js';

        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<?php endif;*/?>
</article>

<?php if ( checkKey( $ampSettings, 'adslot' ) ) : ?>
		<amp-ad width="100vw" height=320
		  type="adsense"
		  data-ad-client="<?php echo $ampSettings['adclient'] ?>"
		  data-ad-slot="<?php echo $ampSettings['adslot'] ?>"
		  data-auto-format="rspv"
		  data-full-width>
		<div overflow></div>
	</amp-ad>
<?php endif ?>