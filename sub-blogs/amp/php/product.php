<div class="content-wrapper">
<header class="post-header">
        <h1 class="post-title"><?php echo $page->title() ?></h1>
    </header>
	<article class="ampwc-container product-single">
	<div class="amp-wp-content breadcrumb"> <ul id="breadcrumbs" class="breadcrumbs"><li class="item-home"><a class="bread-link bread-home" href="<?php echo $this->site_url() ?>" title="<?php echo $L->get( 'forum-home' ) ?>"><?php echo $L->get( 'forum-home' ) ?></a></li><li class="item-cat item-custom-post-type-product"><a class="bread-cat bread-custom-post-type-product" href="<?php echo $this->site_url() . ( !empty( $uri['lang'] ) ? $uri['lang'] . '/' : '' ) . $uri['blog'] ?>" title="<?php echo $L->get( 'tab-shop' ) ?>"><?php echo $L->get( 'tab-shop' ) ?></a></li><li class="item-cat item-cat-15 item-cat-<?php echo $content['categoryKey'] ?>"><a class="bread-cat bread-cat-15 bread-cat-<?php echo $content['categoryKey'] ?>" href="<?php echo $content['categoryURL'] ?>" title="<?php echo $content['category'] ?>"><?php echo $content['category'] ?></a></li></ul></div>
	<?php /*<amp-state id="product"><script type="application/json">{"product":{"id":624,"name":"Denim Shirt","parmalink":"http:\/\/ampforwp.magazine3.com\/product\/belt\/","is_on_sale":true,"slug":"belt","status":"publish","featured":false,"catalog_visibility":"visible","sku":"woo-belt","currency":"&pound;","price":20,"regular_price":"20.00","sale_price":"20.00","date_on_sale_from":null,"date_on_sale_to":null,"total_sales":3,"manage_stock":false,"stock_quantity":null,"stock_status":"instock","backorders":"no","weight":"1.2","length":"12","width":"2","height":"1.5","product_type":"simple","rating":"0","add_cart_text":"Add to cart","add_cart_url":"\/product\/belt\/amp\/?add-to-cart=624","cart_url":"http:\/\/ampforwp.magazine3.com\/cart\/"},"id":624,"attributes":[],"variant_attributes":[],"regular_price":[],"sale_price":[],"product_image":"https:\/\/i0.wp.com\/ampforwp.magazine3.com\/wp-content\/uploads\/2017\/12\/denim-shirt.jpg?fit=566%2C849","image":[],"bigImage":[["https:\/\/i0.wp.com\/ampforwp.magazine3.com\/wp-content\/uploads\/2017\/12\/denim-shirt.jpg?fit=566%2C849",566,849,false]],"gallery":[["https:\/\/i0.wp.com\/ampforwp.magazine3.com\/wp-content\/uploads\/2017\/12\/denim-shirt.jpg?fit=566%2C849",566,849,false]],"selectedImage":0,"selectedqty":1,"minqty":1,"maxqty":15}</script></amp-state>
   <amp-state id="wc_product_cart"><script type="application/json">{"cartvalue":1}</script></amp-state>
   <amp-state id="img_prev_next"><script type="application/json">{"images":["https:\/\/i0.wp.com\/ampforwp.magazine3.com\/wp-content\/uploads\/2017\/12\/denim-shirt.jpg?fit=566%2C849"],"next_img":1,"prev_img":0}</script></amp-state>*/?>
<div class="ampwc-wrapper amp-wp-content">
        <div class="gallery-big-image">
                <amp-img  src="<?php echo $content['image'] ?>" width="566" class="show fadeIn" [class]="(+product.selectedImage)==0 ? 'show fadeIn' : 'hide'" height="849" layout=responsive></amp-img> 
                        <!--<div class="sale">
            <span>Sale!</span>
        </div><!-- /.sale -->
         
    </div><!-- /.gallery-big-image -->
	<?php if ( !empty( $content['images'] ) ) : ?>
        <div class="gallery-multi-images">
        <amp-selector name="color" layout="container" [selected]="product.selectedImage" on="select:AMP.setState({
                    product: {
                      selectedImage: event.targetOption,
                    }
                  })">
            <ul class="p0 m1">
	<?php foreach ( $content['images'] as $image ) : ?>
        <li>
        <div class="small-image">        
           <amp-img src="<?php echo $image['url'] ?>"
                    option="0" 
                    selected=""
                    width="566"
                    height="849"
                    layout=responsive>
            </amp-img>
        </div>
        </li>
	<?php endforeach ?>
                </ul>
    </amp-selector>
    </div><!-- /.gallery-small-images -->
	<?php endif ?>
	<?php if ( !empty( $content['price'] ) ) : ?>
	<div class="price">
        <?php if ( !empty( $content['priceReg'] ) ) : ?><del><span class="woocommerce-Price-amount amount"><?php echo $content['priceReg']['priceFormatted'] ?></span></del><?php endif ?> <ins><span class="woocommerce-Price-amount amount"><?php echo $content['price']['priceFormatted'] ?></span></ins>
    </div><!-- /.price -->
	
        <div style="clear:both"></div>
                <form id="order" method="POST" action-xhr="#" target="_top">
                <div class="add-tocart-field"><div class="total-price">
                                    <span>&pound;</span><span [text]="abs((<?php echo $content['price']['price'] ?>*(+product.selectedqty))).toFixed(2)"><?php echo $content['price']['price'] ?></span>
                            </div><!-- /.total-price -->
            <div class="addtional-field">
                            <span class="subb" tabindex="2" role="click" on="tap:AMP.setState({
                                product:{
                                        selectedqty: (product.selectedqty==product.minqty? 1: product.selectedqty)-1
                                     }
                })">-</span>
                <span class="numb" [text]="product.selectedqty">1</span>
                <span class="addi" tabindex="2" role="click" on="tap:AMP.setState({
                                product:{
                                        selectedqty: ( product.selectedqty == product.maxqty ? 1 : product.selectedqty)+1
                                     }
                })">+</span>                <input type="hidden" name="quantity" value="1" [value]="product.selectedqty">
                <input type="hidden" name="cart_url" value="">
                <input type="hidden" name="form-type" value=" Add to Cart ">
                <input type="hidden" name="add-to-cart" value="624">
                <input type="hidden" name="product_id" value="624">
                
            </div> 
                      <div class="cart-field">
                                <input type="submit" class="ampstart-btn caps"  name="add-to-cart-text" value="Add to cart">
                        </div><!-- /.cart-field -->
        </div><!-- /.add-tocart-field -->
        </form>
		<?php endif ?>
                <div class="sku">
            <span>SKU:woo-belt                   
            </span>
        </div><!-- /.sku -->
        
        <div class="categories-list">
     <span> Categories: </span>
            <ul>
            <span><a href="<?php echo $content['categoryURL'] ?>" ><?php echo $content['category'] ?></a></span>                
            </ul>
        </div><!-- /.categories-list -->
        
                        <div class="stock-status">
            <span>
    Stock: instock           </span> 
        </div><!-- /.stock-status -->         
                        <div class="product_tabs">       
          <amp-selector role="tablist" layout="container" class="ampTabContainer ampstart-headerbar-nav" keyboard-select-mode="select">
              
              <div role="tab" class="tabButton h4 ampstart-nav-item" selected option="a">
                <span>
                  Description                </span>
              </div>
              <div role="tabpanel" class="tabContent p1 p">
                  <h2>Description</h2>
				  <?php echo $content['content'] ?>
              </div>
             
              <div role="tab" class="tabButton h4 ampstart-nav-item"  option="a">
                <span>
                  Additional information                </span>
              </div>
              <div role="tabpanel" class="tabContent p1 p">
                  <h2>Additional information</h2>
<table width="100%"><tr><th>Weight</th>
<td class="product_weight">1.2 kg</td>
</tr><tr><th>Dimensions</th>
<td class="product_dimensions">12 × 2 × 1.5 cm</td>
</tr></table>              </div>
             
              <div role="tab" class="tabButton h4 ampstart-nav-item"  option="a">
                <span>
                  Reviews (<?php echo $content['reviewsNum'] ?>)                </span>
              </div>
              <div role="tabpanel" class="tabContent p1 p">
                  <?php if ( !empty( $content['reviews'] ) ) : ?>
					<ol class="commentlist">
			<?php foreach( $content['reviews'] as $id => $review ) : ?>
				<li class="review even thread-even depth-1" id="li-comment-<?php echo $id ?>">

	<div id="comment-<?php echo $id ?>" class="comment_container">
		<div class="comment-text">
			<div class="star-rating" role="img" aria-label="Rated <?php echo $review['rating'] ?> out of 5"><span style="width:<?php echo ceil( 20 * $review['rating'] ) ?>%">Rated <strong class="rating"><?php echo $review['rating'] ?></strong> out of 5</span></div>
	<p class="meta">
		<strong class="woocommerce-review__author"><?php echo $review['author'] ?> </strong>
				<span class="woocommerce-review__dash">&ndash;</span> <time class="woocommerce-review__published-date" datetime="<?php echo $review['dateC'] ?>"><?php echo $review['date'] ?></time>
	</p>

<div class="description"><p><?php echo $review['post'] ?></p>
</div>
		</div>
	</div>
</li><!-- #comment-<?php echo $id ?> -->
<?php endforeach ?>
			</ol>
<?php endif ?>
<div class="clear"></div>

              </div>
                      </amp-selector>
        </div>
                   </div><!-- /.shipping -->
<?php if ( !empty( $content['related'] ) ) : ?>
        <div class="related-products">
        <h3> Related Products </h3>
	<?php foreach( $content['related'] as $key => $rel ) : ?>
        <div class="prodcuts-list">
            <div class="product-image">
                <a href="<?php echo $rel['url'] ?>" title="<?php echo htmlspecialchars( $rel['title'] ) ?>">
                <amp-img  src="<?php echo $rel['image'] ?>" layout=responsive width="300" height="300">
                </amp-img></a>
			</div><!-- /.product-image -->
            <div class="product-details">
                <a href="<?php echo $rel['url'] ?>" class="product-title"><?php echo $rel['title'] ?></a>
                    <div class="star-rating">
					<?php if ( !empty( $rel['totalRates'] ) ) :
						for( $i=0; $i < ( int )$rel['totalRates']; $i++ ) : ?><span class='star-icon'>☆</span><?php endfor ?>
					<?php endif ?>
					 </div><!-- /.review -->
					 <?php if ( !empty( $rel['price'] ) ) : ?>
					 <div class="price">
                    <<?php if ( !empty( $rel['priceReg'] ) ) : ?><del><span class="woocommerce-Price-amount amount"><?php echo $rel['priceReg']['priceFormatted'] ?></span></del><?php endif ?> <span class="woocommerce-Price-amount amount"><?php echo $rel['price']['priceFormatted'] ?></span>
                </div><!-- /.price --><?php endif ?>
            </div><!-- /.product-details -->
        </div><!-- /.products-list -->
<?php endforeach ?>
            </div><!-- /.related - products -->
	<?php endif ?>
    </div>		 <div class="amp-woocommerce-container">	</article>

		</div>