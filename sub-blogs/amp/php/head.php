	<meta charset="utf-8">

    <?php //echo Theme::metaTags('title'); ?>
	<?php //echo Theme::metaTags('description'); ?>
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	
	<title><?php echo htmlspecialchars( $page->title() ) ?> | <?php echo htmlspecialchars( siteName() ) ?></title>
	
	<meta name="description" content="<?php echo htmlspecialchars( $page->description() ) ?>">

    <?php //echo Theme::favicon('img/favicon.png'); ?>
    
	<?php //Theme::plugins('siteHead'); ?>
	<link rel="canonical" href="<?php echo $permalink ?>" />
	
	<!-- Open Graph Tags -->
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo htmlspecialchars( $page->title() ) ?>" />
	<meta property="og:url" content="<?php echo $permalink; ?>" />
	<meta property="og:description" content="<?php echo htmlspecialchars( substr( strip_tags( $page->description() ), 0, 150 ) ) ?>" />
	<meta property="article:published_time" content="<?php echo date ( 'c', strtotime( $page->dateRaw() ) ) ?>" />
	<?php if ($page->dateModified()): ?>
	<meta property="article:modified_time" content="<?php echo date ( 'c', strtotime( $page->dateModified() ) ) ?>" />
	<?php endif ?>
	<meta property="og:site_name" content="<?php echo htmlspecialchars( siteName() ) ?>" />
	
	<?php if ($page->coverImage()): ?>
	<meta property="og:image" content="<?php echo $page->coverImage(); ?>" />
	<?php list($img_width, $img_height) = @getimagesize($page->coverImage());
		if ( !empty($img_width) && !empty($img_height) ) :?>
	<meta property="og:image:width" content="<?=$img_width;?>" />
	<meta property="og:image:height" content="<?=$img_height;?>" />
	<?php endif ?>
	<?php endif ?>
	
	<meta property="og:locale" content="<?php echo themeLocale() ?>" />
	<meta name="twitter:text:title" content="<?php echo htmlspecialchars( $page->title() ) ?>" />
	
	<?php if ($page->coverImage()): ?>
	<meta name="twitter:image" content="<?php echo $page->coverImage() ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<?php endif ?>
	<!-- End Open Graph Tags -->
	
	<!-- <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "headline": "<?php echo htmlspecialchars( $page->title() ) ?>",
      "image": [
        "<?php echo $page->coverImage(); ?>"
      ],
      "datePublished": "<?php echo date ('c', strtotime( $page->dateRaw() ) ) ?>"
    }
    </script>-->
	<?php if ( isThread() ) : ?>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript><style amp-custom> body{font-family:'Arial', 'Helvetica', 'sans-serif';font-size:16px;line-height:1.25}ol, ul{list-style-position:inside}p, ol, ul, figure{margin:0 0 1em;padding:0}a, a:active, a:visited{text-decoration:none;color:#005be2}body a:hover{color:rgba(0,0,0,0)}pre{white-space:pre-wrap}.left{float:left}.right{float:right}.hidden, .hide, .logo .hide{display:none}.screen-reader-text{border:0;clip:rect(1px, 1px, 1px, 1px);clip-path:inset(50%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;word-wrap:normal}.clearfix{clear:both}blockquote{background:#f1f1f1;margin:10px 0 20px 0;padding:15px}blockquote p:last-child{margin-bottom:0}.amp-wp-unknown-size img{object-fit:contain}.amp-wp-enforced-sizes{max-width:100%}html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}*,*:after,*:before{box-sizing:border-box;-ms-box-sizing:border-box;-o-box-sizing:border-box}.alignright{float:right;margin-left:10px}.alignleft{float:left;margin-right:10px}.aligncenter{display:block;margin-left:auto;margin-right:auto;text-align:center}amp-iframe{max-width:100%;margin-bottom:20px}amp-wistia-player{margin:5px 0px}.wp-caption{padding:0}figcaption,.wp-caption-text{font-size:12px;line-height:1.5em;margin:0;padding:.66em 10px .75em;text-align:center}amp-carousel > amp-img > img{object-fit:contain}.amp-carousel-container{position:relative;width:100%;height:100%}.amp-carousel-img img{object-fit:contain}amp-instagram{box-sizing:initial}figure.aligncenter amp-img{margin:0 auto}.cntr{max-width:1100px;margin:0 auto;width:100%;padding:0px 20px}@font-face{font-family:'icomoon';font-display:swap;font-style:normal;font-weight:normal;src:local('icomoon'), local('icomoon'), url('fonts/icomoon.ttf')}header .cntr{max-width:1100px}.h_m{position:static;background:rgba(255,255,255,1);border-bottom:1px solid;border-color:rgba(0,0,0,0.12);padding:0 0 0 0;margin:0 0 0 0}.content-wrapper{margin-top:0px}.h_m_w{width:100%;clear:both;display:inline-flex;height:60px}.icon-src:before{content:"\e8b6";font-family:'icomoon';font-size:23px}.isc:after{content:"\e8cc";font-family:'icomoon';font-size:20px}.h-ic a:after, .h-ic a:before{color:rgba(51,51,51,1)}.h-ic{margin:0px 10px;align-self:center}.amp-logo a{line-height:0;display:inline-block;color:rgba(51,51,51,1)}.logo h1{margin:0;font-size:17px;font-weight:700;text-transform:uppercase;display:inline-block}.h-srch a{line-height:1;display:block}.amp-logo amp-img{margin:0 auto}@media(max-width:480px){.h-sing{font-size:13px}}.logo{z-index:2;flex-grow:1;align-self:center;text-align:center;line-height:0}.h-1{display:flex;order:1}.h-nav{order:-1;align-self:center}.h-ic:last-child{margin-right:0}.lb-t{position:fixed;top:-50px;width:100%;width:100%;opacity:0;transition:opacity .5s ease-in-out;overflow:hidden;z-index:9;background:rgba(20,20,22,0.9)}.lb-t img{margin:auto;position:absolute;top:0;left:0;right:0;bottom:0;max-height:0%;max-width:0%;border:3px solid white;box-shadow:0px 0px 8px rgba(0,0,0,.3);box-sizing:border-box;transition:.5s ease-in-out}a.lb-x{display:block;width:50px;height:50px;box-sizing:border-box;background:tranparent;color:black;text-decoration:none;position:absolute;top:-80px;right:0;transition:.5s ease-in-out}a.lb-x:after{content:"\e5cd";font-family:'icomoon';font-size:30px;line-height:0;display:block;text-indent:1px;color:rgba(255,255,255,0.8)}.lb-t:target{opacity:1;top:0;bottom:0;left:0;z-index:2}.lb-t:target img{max-height:100%;max-width:100%}.lb-t:target a.lb-x{top:25px}.lb img{cursor:pointer}.lb-btn form{position:absolute;top:200px;left:0;right:0;margin:0 auto;text-align:center}.lb-btn .s{padding:10px}.lb-btn .icon-search{padding:10px;cursor:pointer}.amp-search-wrapper{width:80%;margin:0 auto;position:relative}.overlay-search:before{content:"\e8b6";font-family:'icomoon';font-size:24px;position:absolute;right:0;cursor:pointer;top:4px;color:rgba(255,255,255,0.8)}.amp-search-wrapper .icon-search{cursor:pointer;background:transparent;border:none;display:inline-block;width:30px;height:30px;opacity:0;position:absolute;z-index:100;right:0;top:0}.lb-btn .s{padding:10px;background:transparent;border:none;border-bottom:1px solid #504c4c;width:100%;color:rgba(255,255,255,0.8)}.m-ctr{background:rgba(20,20,22,0.9)}.tg, .fsc{display:none}.fsc{width:100%;height:-webkit-fill-available;position:absolute;cursor:pointer;top:0;left:0;z-index:9}.tg:checked + .hamb-mnu > .m-ctr{margin-left:0;border-right:1px solid}.tg:checked + .hamb-mnu > .m-ctr .c-btn{position:fixed;right:5px;top:5px;background:rgba(20,20,22,0.9);border-radius:50px}.m-ctr{margin-left:-100%;float:left}.tg:checked + .hamb-mnu > .fsc{display:block;background:rgba(0,0,0,.9);height:100%}.t-btn, .c-btn{cursor:pointer}.t-btn:after{content:"\e5d2";font-family:"icomoon";font-size:28px;display:inline-block;color:rgba(51,51,51,1)}.c-btn:after{content:"\e5cd";font-family:"icomoon";font-size:20px;color:rgba(255,255,255,0.8);line-height:0;display:block;text-indent:1px}.c-btn{float:right;padding:15px 5px}.m-ctr{transition:margin 0.3s ease-in-out}.m-ctr{width:90%;height:100%;position:absolute;z-index:99;padding:2% 0% 100vh 0%}.m-menu{display:inline-block;width:100%;padding:2px 20px 10px 20px}.m-scrl{overflow-y:scroll;display:inline-block;width:100%;max-height:94vh}.m-menu .amp-menu .toggle:after{content:"\e313";font-family:'icomoon';font-size:25px;display:inline-block;top:1px;padding:5px;transform:rotate(270deg);right:0;left:auto;cursor:pointer;border-radius:35px;color:rgba(255,255,255,0.8)}.m-menu .amp-menu li.menu-item-has-children:after{display:none}.m-menu .amp-menu li ul{font-size:14px}.m-menu .amp-menu{list-style-type:none;padding:0}.m-menu .amp-menu > li a{color:rgba(255,255,255,0.8);padding:12px 7px;margin-bottom:0;display:inline-block}.menu-btn{margin-top:30px;text-align:center}.menu-btn a{color:#fff;border:2px solid #ccc;padding:15px 30px;display:inline-block}.amp-menu li.menu-item-has-children>ul>li{width:100%}.m-menu .amp-menu li.menu-item-has-children>ul>li{padding-left:0;border-bottom:1px solid;margin:0px 10px}.m-menu .link-menu .toggle{width:100%;height:100%;position:absolute;top:0px;right:0;cursor:pointer}.m-menu .amp-menu .sub-menu li:last-child{border:none}.m-menu .amp-menu a{padding:7px 15px}.m-menu > li{font-size:17px}.amp-menu .toggle:after{position:absolute}.m-menu .toggle{float:right}.m-menu input{display:none}.m-menu .amp-menu [id^=drop]:checked + label + ul{display:block}.m-menu .amp-menu [id^=drop]:checked + .toggle:after{transform:rotate(360deg)}.hamb-mnu ::-webkit-scrollbar{display:none}.p-m-fl{width:100%;border-bottom:1px solid rgba(0, 0, 0, 0.05);background:}.p-menu{width:100%;text-align:center;margin:0px auto;padding:0px 25px 0px 25px}.p-menu ul li{display:inline-block;margin-right:21px;font-size:12px;line-height:20px;letter-spacing:1px;font-weight:400;position:relative}.p-menu ul li a{color:;padding:12px 0px 12px 0px;display:inline-block}.p-menu input{display:none}.p-menu .amp-menu .toggle:after{display:none}.p-menu{white-space:nowrap}@media(max-width:768px){.p-menu{overflow:scroll}}.hmp{margin-top:34px;display:inline-block;width:100%}.fbp{width:100%;display:flex;flex-wrap:wrap;margin:15px 15px 20px 15px}.fbp-img a{display:block;line-height:0}.fbp-c{flex:1 0 100%}.fbp-img{flex-basis:calc(65%);margin-right:30px}.fbp-cnt{flex-basis:calc(31%)}.fbp-cnt .loop-category{margin-bottom:12px}.fsp-cnt .loop-category{margin-bottom:7px}.fsp-cnt .loop-category li{font-weight:500}.fbp-cnt h2{margin:0px;font-size:32px;line-height:38px;font-weight:700}.fbp-cnt h2 a{color:#191919}.fbp-cnt .amp-author{padding-left:6px}.fbp:hover .author-name a{text-decoration:underline}.fbp-cnt .author-details a{color:#808080}.fbp-cnt .author-details a:hover{color:#005be2}.loop-wrapper{display:flex;flex-wrap:wrap;margin:-15px}.loop-category li{display:inline-block;list-style-type:none;margin-right:10px;font-size:10px;font-weight:600;letter-spacing:1.5px}.loop-category li a{color:#555;text-transform:uppercase}.loop-category li:hover a{color:rgba(0,0,0,0)}.fbp-cnt p, .fsp-cnt p{color:#444;font-size:13px;line-height:1.5;letter-spacing:0.10px;word-break:break-word}.fbp:hover h2 a, .fsp:hover h2 a{color:rgba(0,0,0,0)}.fsp h2 a, .fsp h3 a{color:#191919}.fsp{margin:15px;flex-basis:calc(33.33% - 30px)}.fsp-img{margin-bottom:10px}.fsp h2, .fsp h3{margin:0px 0px 5px 0px;font-size:20px;line-height:1.4;font-weight:500}.at-dt{font-size:11px;color:#757575;margin:12px 0px 9px 0px;display:inline-flex}.pt-dt{font-size:11px;color:#757575;margin:8px 0px 0px 0px;display:inline-flex}.arch-tlt{margin:30px 0px 30px;display:inline-block;width:100%}.amp-archive-title, .amp-loop-label{font-weight:600}.amp-archive-desc{font-size:14px;margin:8px 0px 0px 0px;color:#333;line-height:20px}.author-img amp-img{border-radius:50%;margin:0px 12px 10px 0px;display:block;width:50px}.author-img{float:left}.amp-sub-archives{margin:10px 0px 0px 10px}.amp-sub-archives ul li{list-style-type:none;display:inline-block;font-size:12px;margin-right:10px;font-weight:500}.amp-sub-archives ul li a{color:#005be2}.loop-pagination{margin:20px 0px 20px 0px}.right a, .left a{background:#005be2;padding:8px 22px 12px 25px;color:#fff;line-height:1;border-radius:46px;font-size:14px;display:inline-block}.right a:hover, .left a:hover{color:rgba(0,0,0,0)}.right a:after{content:"»";display:inline-block;padding-left:6px;font-size:20px;line-height:20px;height:20px;position:relative;top:1px}.left a:before{content:"«";display:inline-block;padding-right:6px;font-size:20px;line-height:20px;height:20px;position:relative;top:-1px}.cntn-wrp.srch p{margin:30px 0px 30px 0px}.cntn-wrp.srch{font-size:18px;color:#000;line-height:1.7;word-wrap:break-word;font-family:'Arial', 'Helvetica', 'sans-serif'}@media(max-width:1110px){.amppb-fluid .col{max-width:95%}.sf-img .wp-caption-text{width:100%;padding:10px 40px}.fbp-img{flex-basis:calc(64%)}.fbp-img amp-img img{width:100%}.fbp-cnt h2{font-size:28px;line-height:34px}}@media(max-width:768px){.fbp-img{flex-basis:calc(100%);margin-right:0}.hmp{margin:0}.fbp-cnt{float:none;width:100%;margin-left:0px;margin-top:10px;display:inline-block}.fbp-cnt .loop-category{margin-bottom:5px}.fbp{margin:15px}.fbp-cnt p{margin-top:8px}.fsp{flex-basis:calc(100% - 30px)}.fsp-img{width:40%;float:left;margin-right:20px}.fsp-cnt{width:54%;float:left}.at-dt{margin:10px 0px 0px 0px}.hmp .loop-wrapper{margin-top:0}.arch-tlt{margin:20px 0px}.amp-loop-label{font-size:16px}.loop-wrapper h2{font-size:24px;font-weight:600}}@media(max-width:480px){.cntr.b-w{padding:0px}.at-dt{margin:7px 0px 0px 0px}.right, .left{float:none;text-align:center}.right{margin-bottom:30px}.fsp-img{width:100%;float:none;margin-right:0px}.fsp-cnt{width:100%;float:none;padding:0px 15px 0px 14px}.fsp{border:none;padding:0}.fbp-cnt{margin:0;padding:12px}.tg:checked + .hamb-mnu > .m-ctr .c-btn{position:fixed;right:5px;top:35px}}@media(max-width:425px){.hmp .loop-wrapper{margin:0}.hmp .fbp{margin:0px 0px 15px 0px}.hmp .fsp{flex-basis:calc(100% - 0px);margin:15px 0px}.amp-archive-title, .amp-loop-label{padding:0 20px}.amp-sub-archives{margin:10px 0px 0px 30px}.author-img{padding-left:20px}.amp-archive-desc{padding:0px 20px}.loop-pagination{margin:15px 0px 15px 0px}}@media(max-width:375px){.fbp-cnt p, .fsp-cnt p{line-height:19px;letter-spacing:0}}@media(max-width:320px){.right a, .left a{padding:10px 30px 14px}}.m-srch #amp-search-submit{cursor:pointer;background:transparent;border:none;display:inline-block;width:30px;height:30px;opacity:0;position:absolute;z-index:100;right:0;top:0}.m-srch .amp-search-wrapper{border:1px solid rgba(255,255,255,0.8);background:rgba(255,255,255,0.8);width:100%;border-radius:60px}.m-srch .s{padding:10px 15px;border:none;width:100%;color:rgba(20,20,22,0.9);background:rgba(255,255,255,0.8);border-radius:60px}.m-srch{border-top:1px solid;padding:20px}.m-srch .overlay-search:before{color:rgba(20,20,22,0.9);padding-right:10px;top:6px}.cp-rgt{font-size:11px;line-height:1.2;color:rgba(255,255,255,0.8);padding:20px;text-align:center;border-top:1px solid}.cp-rgt a{color:rgba(255,255,255,0.8);border-bottom:1px solid rgba(255,255,255,0.8);margin-left:10px}.cp-rgt .view-non-amp{display:none}a.btt:hover{cursor:pointer}@media(max-width:768px){.sdbr-right{width:100%}.b-w .hmp, .arch-psts{width:100%;padding:0}.b-w, .arch-dsgn{display:block}.b-w .fsp, .arch-psts .fsp{flex-basis:calc(100%)}}.footer{margin-top:80px}.f-menu ul li .sub-menu{display:none}.f-menu ul li{display:inline-block;margin-right:20px}.f-menu ul li a{padding:0;color:#575656}.f-menu ul > li:hover a{color:rgba(0,0,0,0)}.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px}.rr{font-size:12px;color:rgba(136,136,136,1)}.rr span{margin:0 10px 0 0px}.f-menu ul li.menu-item-has-children:hover > ul{display:none}.f-menu ul li.menu-item-has-children:after{display:none}.f-w{display:inline-flex;width:100%;flex-wrap:wrap;margin:15px -15px 0px}.f-w-f2{text-align:center;border-top:1px solid rgba(238,238,238,1);padding:50px 0 50px 0}.w-bl{margin-left:0;display:flex;flex-direction:column;position:relative;flex:1 0 22%;margin:0 15px 30px;line-height:1.5;font-size:14px}.w-bl h4{font-size:12px;font-weight:500;margin-bottom:20px;text-transform:uppercase;letter-spacing:1px;padding-bottom:4px}.w-bl ul li{list-style-type:none;margin-bottom:15px}.w-bl ul li:last-child{margin-bottom:0}.w-bl ul li a{text-decoration:none}.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none}.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none}.w-bl table{border-collapse:collapse;margin:0 0 1.5em;width:100%}.w-bl tr{border-bottom:1px solid #eee}.w-bl th, .w-bl td{text-align:center}.w-bl td{padding:0.4em}.w-bl th:first-child, .w-bl td:first-child{padding-left:0}.w-bl thead th{border-bottom:2px solid #bbb;padding-bottom:0.5em;padding:0.4em}.w-bl .calendar_wrap caption{font-size:14px;margin-bottom:10px}.w-bl form{display:inline-flex;flex-wrap:wrap;align-items:center}.w-bl .search-submit{text-indent:-9999px;padding:0;margin:0;background:transparent;line-height:0;display:inline-block;opacity:0}.w-bl .search-button:after{content:"\e8b6";font-family:'icomoon';font-size:23px;display:inline-block;cursor:pointer}.w-bl .search-field{border:1px solid #ccc;padding:6px 10px}.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px}.f-menu ul li{display:inline-block;margin-right:20px}.f-menu .sub-menu{display:none}.rr{font-size:13px;color:rgba(136,136,136,1)}@media(max-width:768px){.footer{margin-top:60px}.w-bl{flex:1 0 22%}.f-menu ul li{margin-bottom:10px}}@media(max-width:480px){.footer{margin-top:50px}.f-w-f2{padding:25px 0px}.f-w{display:block;margin:15px 0px 0px}.w-bl{margin-bottom:40px}.w-bl{flex:100%}.w-bl ul li{margin-bottom:11px}.f-menu ul li{display:inline-block;line-height:1.8;margin-right:13px}.f-menu .amp-menu > li a{padding:0;font-size:12px;color:#7a7a7a}.rr{margin-top:15px;font-size:11px}}@media(max-width:425px){.footer{margin-top:35px}.w-bl h4{margin-bottom:15px}}.content-wrapper a, .breadcrumb ul li a, .srp ul li, .rr a{transition:all 0.3s ease-in-out 0s}[class^="icon-"], [class*=" icon-"]{font-family:'icomoon';speak:none;font-style:normal;font-weight:normal;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}@media (min-width:768px){.wp-block-columns{display:flex}.wp-block-column{max-width:50%;margin:0px 10px}}amp-facebook-like{max-height:28px;top:6px;margin-right:-5px}a.readmore-rp{font-size:13px}.m-s-i li a.s_telegram{background:#d0d0d0;padding:0px 2px;border-radius:2px}.cntn-wrp h1, .cntn-wrp h2, .cntn-wrp h3, .cntn-wrp h4, .cntn-wrp h5, h6{margin-bottom:5px}.cntn-wrp h1{font-size:32px}.cntn-wrp h2{font-size:27px}.cntn-wrp h3{font-size:24px}.cntn-wrp h4{font-size:20px}.cntn-wrp h5{font-size:17px}.cntn-wrp h6{font-size:15px}figure.amp-featured-image{margin:10px 0}amp-img.amp-wp-enforced-sizes[layout=intrinsic] > img, .amp-wp-unknown-size > img{object-fit:contain}.rtl amp-carousel{direction:ltr}.rtl .amp-menu .toggle:after{left:0;right:unset}.sharedaddy li{display:none}sub{vertical-align:sub;font-size:small}sup{vertical-align:super;font-size:small}.btt{position:fixed;bottom:20px;right:20px;background:rgba(71, 71, 71, 0.5);color:#fff;border-radius:100%;width:50px;height:50px}.btt:hover{color:#fff;background:#474747}.btt:before{content:'\25be';display:block;font-size:35px;font-weight:600;color:#fff;transform:rotate(180deg);text-align:center;line-height:1.5}.has-text-align-left{text-align:left}.has-text-align-right{text-align:right}.has-text-align-center{text-align:center}#bbpress-forums{margin-top:30px}.bbp-forums{width:100%;display:inline-block;margin-top:50px}.bbp-forums li, .bbp-topics li, .bbp-replies li{list-style-type:none}#bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer{background:#f3f3f3;border-top:1px solid #eee;font-weight:bold;padding:10px;text-align:center;display:inline-block;width:100%;line-height:1.5}#bbpress-forums li.bbp-header{background:#eaeaea;color:#555}li.bbp-forum-info, li.bbp-topic-title{float:left;text-align:left;width:55%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{float:left;text-align:center;width:10%}#bbpress-forums ul.odd{background-color:#fbfbfb;display:inline-block;width:100%}.bbp-body ul{padding:10px;display:inline-block;width:100%}#bbpress-forums .bbp-forum-info .bbp-forum-content, #bbpress-forums p.bbp-topic-meta{font-size:11px;margin:15px 0 5px;padding:0;word-wrap:break-word}li.bbp-forum-freshness, li.bbp-topic-freshness{text-align:center;float:left;width:22%}.bbp-topic-freshness-author amp-img{display:inline-block;vertical-align:middle}#bbpress-forums a{color:}.subscription-toggle, .bbp-pagination, .favorite-toggle{background:transparent;clear:both;margin-bottom:20px;overflow:hidden;font-size:12px}div.bbp-template-notice.info{border:#cee1ef 1px solid;background-color:#f0f8ff;margin:15px 0px 0px}#bbpress-forums div.bbp-template-notice a{color:#555;display:inline-block}.bbpress.blog-post .section-text p{font-size:15px}#bbpress-forums fieldset.bbp-form{border:1px solid #d6d6d6;padding:10px 20px;margin-bottom:10px}#bbpress-forums fieldset.bbp-form legend{padding:5px;line-height:1.4}legend{margin-bottom:20px}div.bbp-template-notice, div.indicator-hint{border-width:1px;border-style:solid;padding:0 0.6em;margin:5px 0 15px;border-radius:3px;background-color:#ffffe0;border-color:#e6db55;color:#000;clear:both}div.bbp-template-notice p{padding:15px 5px;font-size:14px;color:#666;line-height:1.5}.bbp-topic-started-by, .bbp-topic-started-by a{display:inline-block;vertical-align:middle}.form-group{padding-bottom:7px;position:relative}.bbp-form label{font-size:15px;font-weight:bold;color:#444;margin-bottom:10px;display:inline-block}.bbp-form input{width:100%;border:none;border-bottom:1px solid #ccc;margin-bottom:20px;padding:10px}.bbp-form textarea{width:100%;border:1px solid #ccc;margin-bottom:20px;padding:20px}#bbpress-forums fieldset.bbp-form select{margin:0 0 20px;padding:10px}.bbp-form #bbp_topic_subscription{display:inline-block;width:15px;margin-bottom:4px}.bbp-submit-wrapper{margin-top:15px;float:right;clear:both}.button.submit{background:;border:none;padding:15px 30px;color:#fff;text-transform:uppercase;letter-spacing:0.5px;border-radius:3px;cursor:pointer}.bbp-topic-tags{float:right;font-size:14px;margin-bottom:20px;color:#555}#bbpress-forums li.bbp-header .bbp-reply-author, #bbpress-forums li.bbp-footer .bbp-reply-author{float:left;margin:0;padding:0;width:120px}#bbpress-forums li.bbp-header .bbp-reply-content, #bbpress-forums li.bbp-footer .bbp-reply-content{margin-left:140px;padding:0;text-align:left;font-size:13px}li.bbp-header div.bbp-reply-content span#subscription-toggle, li.bbp-header div.bbp-reply-content span#favorite-toggle{float:right;font-weight:500}#bbpress-forums div.bbp-reply-header{background-color:#f4f4f4}div.bbp-reply-header, li.bbp-body div.hentry{margin-bottom:0;overflow:hidden;padding:18px 8px 18px 8px}#bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results{font-size:12px;color:#555}span.bbp-admin-links{float:right;color:#ddd}#bbpress-forums span.bbp-admin-links a{color:#bbb;font-weight:normal;font-size:10px;text-transform:uppercase;text-decoration:none}#bbpress-forums .bbp-reply-header a.bbp-reply-permalink{float:right;margin-left:10px;color:#ccc}div.bbp-reply-header{border-top:1px solid #ddd;clear:both}#bbpress-forums div.odd, #bbpress-forums ul.odd{background-color:#fbfbfb}#bbpress-forums div.bbp-reply-author{float:left;text-align:center;width:115px}.bbp-reply-author amp-img{margin:0 auto}#bbpress-forums div.bbp-reply-content{margin-left:130px;padding:12px 12px 12px 0;text-align:left;font-size:15px}.bbp-reply-author .bbp-author-role{margin-top:15px}.bbp-reply-author .bbp-reply-ip{margin-top:8px}.bbp-pagination-count{margin-top:20px}@media (max-width:480px){li.bbp-forum-info, li.bbp-topic-title{width:36%}li.bbp-forum-freshness, li.bbp-topic-freshness{width:27%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{width:18%}div.bbp-reply-header, li.bbp-body div.hentry{padding:10px 8px 10px 8px}span.bbp-admin-links{clear:left;float:left;margin-top:7px}#bbpress-forums .bbp-body div.bbp-reply-author{text-align:left;width:100%}#bbpress-forums .bbp-body div.bbp-reply-content{margin:20px 10px 10px;padding:0;display:inline-block;width:100%}.bbp-reply-author amp-img{float:left;margin-right:20px}.bbp-reply-author .bbp-author-role{margin-top:10px}.bbp-topic-tags{float:left}}@media(max-width:320px){.forum-titles li.bbp-forum-info, .forum-titles li.bbp-topic-title{width:100%;text-align:center}li.bbp-forum-info, li.bbp-topic-title{width:100%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{width:25%}li.bbp-forum-freshness, li.bbp-topic-freshness{width:50%}#bbpress-forums li.bbp-body li.bbp-forum-topic-count, #bbpress-forums li.bbp-body li.bbp-forum-reply-count, #bbpress-forums li.bbp-body li.bbp-forum-freshness, #bbpress-forums li.bbp-body li.bbp-topic-voice-count, #bbpress-forums li.bbp-body li.bbp-topic-reply-count, #bbpress-forums li.bbp-body li.bbp-topic-freshness{margin-top:7px}#bbpress-forums li.bbp-header .bbp-reply-author, #bbpress-forums li.bbp-footer .bbp-reply-author{width:80px}#bbpress-forums li.bbp-header .bbp-reply-content, #bbpress-forums li.bbp-footer .bbp-reply-content{margin-left:70px}}.amp-logo amp-img{width:190px}.amp-menu input{display:none}.amp-menu li.menu-item-has-children ul{display:none}.amp-menu li{position:relative;display:block}.amp-menu > li a{display:block}.icon-widgets:before{content:"\e1bd"}.icon-search:before{content:"\e8b6"}.icon-shopping-cart:after{content:"\e8cc"}.cach-btns{display:flex;margin:0 auto;width:100%;justify-content:center}.cach-btns > a:nth-child(1){margin-right:30px}a.btn-txt{font-size:20px;border-radius:0px;color:#fff;background:#2cbf55;display:inline-block;padding:10px 20px 10px 20px;width:166px;font-weight:400;box-sizing:initial;border-radius:30px}@media(max-width:480px){.cach-btns{display:inline-block;margin:0 auto;width:100%;text-align:center}a.btn-txt{width:90%}.cach-btns > a:nth-child(1){margin:0px 0px 20px 0px}}</style>
	<?php elseif ( isTopic() ) : ?>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript><style amp-custom> body{font-family:'Arial', 'Helvetica', 'sans-serif';font-size:16px;line-height:1.25}ol, ul{list-style-position:inside}p, ol, ul, figure{margin:0 0 1em;padding:0}a, a:active, a:visited{text-decoration:none;color:#005be2}body a:hover{color:rgba(0,0,0,0)}pre{white-space:pre-wrap}.left{float:left}.right{float:right}.hidden, .hide, .logo .hide{display:none}.screen-reader-text{border:0;clip:rect(1px, 1px, 1px, 1px);clip-path:inset(50%);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;word-wrap:normal}.clearfix{clear:both}blockquote{background:#f1f1f1;margin:10px 0 20px 0;padding:15px}blockquote p:last-child{margin-bottom:0}.amp-wp-unknown-size img{object-fit:contain}.amp-wp-enforced-sizes{max-width:100%}html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}*,*:after,*:before{box-sizing:border-box;-ms-box-sizing:border-box;-o-box-sizing:border-box}.alignright{float:right;margin-left:10px}.alignleft{float:left;margin-right:10px}.aligncenter{display:block;margin-left:auto;margin-right:auto;text-align:center}amp-iframe{max-width:100%;margin-bottom:20px}amp-wistia-player{margin:5px 0px}.wp-caption{padding:0}figcaption,.wp-caption-text{font-size:12px;line-height:1.5em;margin:0;padding:.66em 10px .75em;text-align:center}amp-carousel > amp-img > img{object-fit:contain}.amp-carousel-container{position:relative;width:100%;height:100%}.amp-carousel-img img{object-fit:contain}amp-instagram{box-sizing:initial}figure.aligncenter amp-img{margin:0 auto}.cntr{max-width:1100px;margin:0 auto;width:100%;padding:0px 20px}@font-face{font-family:'icomoon';font-display:swap;font-style:normal;font-weight:normal;src:local('icomoon'), local('icomoon'), url('../fonts/icomoon.ttf')}header .cntr{max-width:1100px}.h_m{position:static;background:rgba(255,255,255,1);border-bottom:1px solid;border-color:rgba(0,0,0,0.12);padding:0 0 0 0;margin:0 0 0 0}.content-wrapper{margin-top:0px}.h_m_w{width:100%;clear:both;display:inline-flex;height:60px}.icon-src:before{content:"\e8b6";font-family:'icomoon';font-size:23px}.isc:after{content:"\e8cc";font-family:'icomoon';font-size:20px}.h-ic a:after, .h-ic a:before{color:rgba(51,51,51,1)}.h-ic{margin:0px 10px;align-self:center}.amp-logo a{line-height:0;display:inline-block;color:rgba(51,51,51,1)}.logo h2{margin:0;font-size:17px;font-weight:700;text-transform:uppercase;display:inline-block}.h-srch a{line-height:1;display:block}.amp-logo amp-img{margin:0 auto}@media(max-width:480px){.h-sing{font-size:13px}}.logo{z-index:2;flex-grow:1;align-self:center;text-align:center;line-height:0}.h-1{display:flex;order:1}.h-nav{order:-1;align-self:center}.h-ic:last-child{margin-right:0}.lb-t{position:fixed;top:-50px;width:100%;width:100%;opacity:0;transition:opacity .5s ease-in-out;overflow:hidden;z-index:9;background:rgba(20,20,22,0.9)}.lb-t img{margin:auto;position:absolute;top:0;left:0;right:0;bottom:0;max-height:0%;max-width:0%;border:3px solid white;box-shadow:0px 0px 8px rgba(0,0,0,.3);box-sizing:border-box;transition:.5s ease-in-out}a.lb-x{display:block;width:50px;height:50px;box-sizing:border-box;background:tranparent;color:black;text-decoration:none;position:absolute;top:-80px;right:0;transition:.5s ease-in-out}a.lb-x:after{content:"\e5cd";font-family:'icomoon';font-size:30px;line-height:0;display:block;text-indent:1px;color:rgba(255,255,255,0.8)}.lb-t:target{opacity:1;top:0;bottom:0;left:0;z-index:2}.lb-t:target img{max-height:100%;max-width:100%}.lb-t:target a.lb-x{top:25px}.lb img{cursor:pointer}.lb-btn form{position:absolute;top:200px;left:0;right:0;margin:0 auto;text-align:center}.lb-btn .s{padding:10px}.lb-btn .icon-search{padding:10px;cursor:pointer}.amp-search-wrapper{width:80%;margin:0 auto;position:relative}.overlay-search:before{content:"\e8b6";font-family:'icomoon';font-size:24px;position:absolute;right:0;cursor:pointer;top:4px;color:rgba(255,255,255,0.8)}.amp-search-wrapper .icon-search{cursor:pointer;background:transparent;border:none;display:inline-block;width:30px;height:30px;opacity:0;position:absolute;z-index:100;right:0;top:0}.lb-btn .s{padding:10px;background:transparent;border:none;border-bottom:1px solid #504c4c;width:100%;color:rgba(255,255,255,0.8)}.m-ctr{background:rgba(20,20,22,0.9)}.tg, .fsc{display:none}.fsc{width:100%;height:-webkit-fill-available;position:absolute;cursor:pointer;top:0;left:0;z-index:9}.tg:checked + .hamb-mnu > .m-ctr{margin-left:0;border-right:1px solid}.tg:checked + .hamb-mnu > .m-ctr .c-btn{position:fixed;right:5px;top:5px;background:rgba(20,20,22,0.9);border-radius:50px}.m-ctr{margin-left:-100%;float:left}.tg:checked + .hamb-mnu > .fsc{display:block;background:rgba(0,0,0,.9);height:100%}.t-btn, .c-btn{cursor:pointer}.t-btn:after{content:"\e5d2";font-family:"icomoon";font-size:28px;display:inline-block;color:rgba(51,51,51,1)}.c-btn:after{content:"\e5cd";font-family:"icomoon";font-size:20px;color:rgba(255,255,255,0.8);line-height:0;display:block;text-indent:1px}.c-btn{float:right;padding:15px 5px}.m-ctr{transition:margin 0.3s ease-in-out}.m-ctr{width:90%;height:100%;position:absolute;z-index:99;padding:2% 0% 100vh 0%}.m-menu{display:inline-block;width:100%;padding:2px 20px 10px 20px}.m-scrl{overflow-y:scroll;display:inline-block;width:100%;max-height:94vh}.m-menu .amp-menu .toggle:after{content:"\e313";font-family:'icomoon';font-size:25px;display:inline-block;top:1px;padding:5px;transform:rotate(270deg);right:0;left:auto;cursor:pointer;border-radius:35px;color:rgba(255,255,255,0.8)}.m-menu .amp-menu li.menu-item-has-children:after{display:none}.m-menu .amp-menu li ul{font-size:14px}.m-menu .amp-menu{list-style-type:none;padding:0}.m-menu .amp-menu > li a{color:rgba(255,255,255,0.8);padding:12px 7px;margin-bottom:0;display:inline-block}.menu-btn{margin-top:30px;text-align:center}.menu-btn a{color:#fff;border:2px solid #ccc;padding:15px 30px;display:inline-block}.amp-menu li.menu-item-has-children>ul>li{width:100%}.m-menu .amp-menu li.menu-item-has-children>ul>li{padding-left:0;border-bottom:1px solid;margin:0px 10px}.m-menu .link-menu .toggle{width:100%;height:100%;position:absolute;top:0px;right:0;cursor:pointer}.m-menu .amp-menu .sub-menu li:last-child{border:none}.m-menu .amp-menu a{padding:7px 15px}.m-menu > li{font-size:17px}.amp-menu .toggle:after{position:absolute}.m-menu .toggle{float:right}.m-menu input{display:none}.m-menu .amp-menu [id^=drop]:checked + label + ul{display:block}.m-menu .amp-menu [id^=drop]:checked + .toggle:after{transform:rotate(360deg)}.hamb-mnu ::-webkit-scrollbar{display:none}.p-m-fl{width:100%;border-bottom:1px solid rgba(0, 0, 0, 0.05);background:}.p-menu{width:100%;text-align:center;margin:0px auto;padding:0px 25px 0px 25px}.p-menu ul li{display:inline-block;margin-right:21px;font-size:12px;line-height:20px;letter-spacing:1px;font-weight:400;position:relative}.p-menu ul li a{color:;padding:12px 0px 12px 0px;display:inline-block}.p-menu input{display:none}.p-menu .amp-menu .toggle:after{display:none}.p-menu{white-space:nowrap}@media(max-width:768px){.p-menu{overflow:scroll}}pre{padding:30px 15px;background:#f7f7f7;white-space:pre-wrap;;font-size:14px;color:#666666;border-left:3px solid;border-color:#005be2;margin-bottom:20px}.cntn-wrp{font-family:'Arial, Helvetica, sans-serif'}table{display:-webkit-box;overflow-x:auto;word-break:normal}.author-tw:after{font-family:icomoon;content:"\e942";color:#fff;background:#1da1f2;padding:4px;border-radius:3px;margin:0px 5px;text-decoration:none}.author-tw:hover{text-decoration:none}.artl-cnt table{margin:0 auto;text-align:center;width:100%}p.nocomments{padding:10px;color:#fff}.tl-exc{font-size:16px;color:#444;margin-top:10px;line-height:20px}.amp-category span:nth-child(1){display:none}.amp-category span a, .amp-category span{color:#005be2;font-size:12px;font-weight:500;text-transform:uppercase}.amp-category span a:hover{color:rgba(0,0,0,0)}.amp-category span:after{content:"/";display:inline-block;margin:0px 5px 0px 5px;position:relative;top:1px;color:rgba(0, 0, 0, 0.25)}.amp-category span:last-child:after{display:none}.sp{width:100%;margin-top:20px;display:inline-block}.amp-post-title{font-size:48px;line-height:58px;color:#333;margin:0;padding-top:15px}.sf-img{text-align:center;width:100%;display:inline-block;height:auto}.sf-img figure{margin:0}.sf-img .wp-caption-text{text-align:left;margin:0 auto;color:#a1a1a1;font-size:14px;line-height:20px;font-weight:500;border-bottom:1px solid #ccc;padding:15px 0px}.sf-img .wp-caption-text:before{content:"\e412";font-family:'icomoon';font-size:24px;position:relative;top:4px;opacity:0.4;margin-right:5px}.sp-cnt{margin-top:40px;clear:both;width:100%;display:inline-block}.sp-rl{display:inline-flex;width:100%}.sp-rt{width:72%;margin-left:60px;flex-direction:column;justify-content:space-around;order:1}.sp-lt{display:flex;flex-direction:column;flex:1 0 20%;order:0;max-width:237px}.ss-ic, .sp-athr, .amp-tags, .post-date{padding-bottom:20px;border-bottom:1px dotted #ccc}.shr-txt, .athr-tx, .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{margin-bottom:12px}.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{display:block}.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{text-transform:uppercase;font-size:12px;color:#666;font-weight:400}.loop-date, .post-edit-link{display:inline-block}.post-date .post-edit-link{color:#005be2;float:right}.post-date .post-edit-link:hover{color:rgba(0,0,0,0)}.sp-athr, .amp-tags, .post-date{margin-top:20px}.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag{font-size:15px;color:#005be2;font-weight:400;line-height:1.5}.amp-tags .amp-tag:after{content:"/";display:inline-block;padding:0px 10px;position:relative;top:-1px;color:#ccc;font-size:12px}.amp-tags .amp-tag:last-child:after{display:none}.ss-ic li:before{border-radius:2px;text-align:center;padding:4px 6px}.sgl table{width:100%;margin-bottom:25px;border:1px solid #ddd;display:inline-table}.sgl th, .sgl td{padding:0.5em 1em;border:1px solid #ddd}.sgl tr:nth-child(odd) td{background:#f7f7f7}.cntn-wrp{font-size:18px;color:#000;line-height:1.7;word-break:break-word}.cntn-wrp small{font-size:11px;line-height:1.2;color:#111}.cntn-wrp p, .cntn-wrp ul, .cntn-wrp ol{margin:0px 0px 30px 0px;word-break:break-word}.cntn-wrp .wp-block-image,.wp-block-embed{margin:15px 0px}.artl-cnt ul li, .artl-cnt ol li{list-style-type:none;position:relative;padding-left:20px}.artl-cnt ul li:before{content:"";display:inline-block;width:5px;height:5px;background:#333;position:absolute;top:12px;left:0px}.artl-cnt ol li{counter-increment:step-counter}.artl-cnt ol li::before{content:counter(step-counter);font-size:16px;color:#000;position:absolute;left:0px;line-height:1.2;top:6px}.sp-rt p strong, .pg p strong{font-weight:700}@supports (-webkit-overflow-scrolling:touch){.m-ctr{overflow:initial}}@supports not (-webkit-overflow-scrolling:touch){.m-ctr{overflow:scroll}}.m-scrl{display:inline-block;width:100%;max-height:94vh}.related_link{margin-top:10px}.related_link a{color:#333}.related_link p{word-break:break-word;color:#444;font-size:13px;line-height:20px;letter-spacing:0.10px;margin-top:5px;font-weight:400}.amp-related-posts ul{list-style-type:none}.r-pf{margin-top:40px;display:inline-block;width:100%}.sp-rt .amp-author{padding:20px 20px;border-radius:0;background:#f9f9f9;border:1px solid #ececec;display:inline-block;width:100%}.sp-rt .amp-author-image{float:left}.sp-rt .author-details a{color:#222;font-size:14px;font-weight:500}.sp-rt .author-details a:hover{color:rgba(0,0,0,0);text-decoration:underline}.amp-author-image amp-img{border-radius:50%;margin:0px 12px 5px 0px;display:block;width:50px}.author-details p{margin:0;font-size:13px;line-height:20px;color:#666;padding-top:4px}#pagination{margin-top:30px;border-top:1px dotted #ccc;padding:20px 5px 0px 5px;;font-size:16px;line-height:24px;font-weight:400}.next{float:right;width:45%;text-align:right;position:relative;margin-top:10px}.next a, .prev a{color:#333}.prev{float:left;width:45%;position:relative;margin-top:10px}.prev span{text-transform:uppercase;font-size:12px;color:#666;display:block;position:absolute;top:-26px}.next span{text-transform:uppercase;font-size:12px;color:#666;display:block;font-weight:400;position:absolute;top:-26px;right:0}.next:hover a, .prev:hover a{color:rgba(0,0,0,0)}.prev:after{border-left:1px dotted #ccc;content:"";height:calc(100% - -10px);right:-50px;position:absolute;top:50%;transform:translate(0px, -50%);width:2px}.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block}.ampforwp_post_pagination p{margin:0;font-size:18px;color:#444;font-weight:500;margin-bottom:10px}.ampforwp_post_pagination p a{color:#005be2;padding:0px 10px}.sp-rt .amp-author{margin-top:5px}.cntn-wrp a{margin:10px 0px;color:#005be2}.loop-wrapper{display:flex;flex-wrap:wrap;margin:-15px}.loop-category li{display:inline-block;list-style-type:none;margin-right:10px;font-size:10px;font-weight:600;letter-spacing:1.5px}.loop-category li a{color:#555;text-transform:uppercase}.loop-category li:hover a{color:#005be2}.fsp-cnt p{color:#444;font-size:13px;line-height:20px;letter-spacing:0.10px;word-break:break-word}.fsp:hover h2 a{color:rgba(0,0,0,0)}.fsp h2 a, .fsp h3 a{color:#191919}.fsp{margin:15px;flex-basis:calc(33.33% - 30px)}.fsp-img{margin-bottom:10px}.fsp h2, .fsp h3{margin:0px 0px 5px 0px;font-size:20px;line-height:25px;font-weight:500}.fsp-cnt .loop-category{margin-bottom:8px}.fsp-cnt .loop-category li{font-weight:500}.pt-dt{font-size:11px;color:#808080;margin:8px 0px 0px 0px;display:inline-flex}blockquote{margin-bottom:20px}blockquote p{font-size:34px;line-height:1.4;font-weight:700;position:relative;padding:30px 0 0 0}blockquote p:before{content:"";border-top:8px solid #000;width:115px;line-height:40px;display:inline-block;position:absolute;top:0}@media(max-width:1110px){.cntr{width:100%;padding:0px 20px}.sp-rt{margin-left:30px}}@media(max-width:768px){.tl-exc{font-size:14px;margin-top:3px;line-height:22px}.sp-rl{display:inline-block;width:100%}.sp-lt{width:100%;margin-top:20px;max-width:100%}.sp-cnt{margin-top:15px}.r-pf h3{padding-top:20px;border-top:1px dotted #ccc}.r-pf{margin-top:20px}.sp-rt{width:100%;margin-left:0}.sp-rt .amp-author{padding:20px 15px}#pagination{margin:20px 0px 20px 0px;border-top:none}.amp-post-title{padding-top:10px}.fsp{flex-basis:calc(100% - 30px)}.fsp-img{width:40%;float:left;margin-right:20px}.fsp-cnt{width:54%;float:left}}@media(max-width:480px){.loop-wrapper{margin-top:15px}.cntn-wrp p{line-height:1.65}.rp .has_related_thumbnail{width:100%}.rlp-image{width:100%;float:none;margin-right:0px}.rlp-cnt{width:100%;float:none}.amp-post-title{font-size:32px;line-height:44px}.amp-category span a{font-size:12px}.sf-img{}.sp{margin-top:20px}.menu-btn a{padding:10px 20px;font-size:14px}.next, .prev{float:none;width:100%}#pagination{padding:10px 0px 0px}#respond{margin:0}.next a{margin-bottom:45px;display:inline-block}.prev:after{display:none}.author-details p{font-size:12px;line-height:18px}.sf-img .wp-caption-text{width:100%;padding:10px 15px}.fsp-img{width:100%;float:none;margin-right:0px}.fsp-cnt{width:100%;float:none}.fsp{border:none;padding:0}.fsp-cnt{padding:0px 15px 0px 14px}.r-pf .fsp-cnt{padding:0px}blockquote p{font-size:20px}}@media(max-width:425px){.sp-rt .amp-author{margin-bottom:10px}#pagination{margin:20px 0px 10px 0px}.fsp h2, .fsp h3{font-size:24px;font-weight:600}}@media(max-width:320px){.cntn-wrp p{font-size:16px}}.m-srch #amp-search-submit{cursor:pointer;background:transparent;border:none;display:inline-block;width:30px;height:30px;opacity:0;position:absolute;z-index:100;right:0;top:0}.m-srch .amp-search-wrapper{border:1px solid rgba(255,255,255,0.8);background:rgba(255,255,255,0.8);width:100%;border-radius:60px}.m-srch .s{padding:10px 15px;border:none;width:100%;color:rgba(20,20,22,0.9);background:rgba(255,255,255,0.8);border-radius:60px}.m-srch{border-top:1px solid;padding:20px}.m-srch .overlay-search:before{color:rgba(20,20,22,0.9);padding-right:10px;top:6px}.cp-rgt{font-size:11px;line-height:1.2;color:rgba(255,255,255,0.8);padding:20px;text-align:center;border-top:1px solid}.cp-rgt a{color:rgba(255,255,255,0.8);border-bottom:1px solid rgba(255,255,255,0.8);margin-left:10px}.cp-rgt .view-non-amp{display:none}a.btt:hover{cursor:pointer}@media(max-width:768px){.sdbr-right{width:100%}.b-w .hmp, .arch-psts{width:100%;padding:0}.b-w, .arch-dsgn{display:block}.b-w .fsp, .arch-psts .fsp{flex-basis:calc(100%)}}.footer{margin-top:80px}.f-menu ul li .sub-menu{display:none}.f-menu ul li{display:inline-block;margin-right:20px}.f-menu ul li a{padding:0;color:#575656}.f-menu ul > li:hover a{color:rgba(0,0,0,0)}.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px}.rr{font-size:12px;color:rgba(136,136,136,1)}.rr span{margin:0 10px 0 0px}.f-menu ul li.menu-item-has-children:hover > ul{display:none}.f-menu ul li.menu-item-has-children:after{display:none}.f-w{display:inline-flex;width:100%;flex-wrap:wrap;margin:15px -15px 0px}.f-w-f2{text-align:center;border-top:1px solid rgba(238,238,238,1);padding:50px 0 50px 0}.w-bl{margin-left:0;display:flex;flex-direction:column;position:relative;flex:1 0 22%;margin:0 15px 30px;line-height:1.5;font-size:14px}.w-bl h4{font-size:12px;font-weight:500;margin-bottom:20px;text-transform:uppercase;letter-spacing:1px;padding-bottom:4px}.w-bl ul li{list-style-type:none;margin-bottom:15px}.w-bl ul li:last-child{margin-bottom:0}.w-bl ul li a{text-decoration:none}.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none}.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none}.w-bl table{border-collapse:collapse;margin:0 0 1.5em;width:100%}.w-bl tr{border-bottom:1px solid #eee}.w-bl th, .w-bl td{text-align:center}.w-bl td{padding:0.4em}.w-bl th:first-child, .w-bl td:first-child{padding-left:0}.w-bl thead th{border-bottom:2px solid #bbb;padding-bottom:0.5em;padding:0.4em}.w-bl .calendar_wrap caption{font-size:14px;margin-bottom:10px}.w-bl form{display:inline-flex;flex-wrap:wrap;align-items:center}.w-bl .search-submit{text-indent:-9999px;padding:0;margin:0;background:transparent;line-height:0;display:inline-block;opacity:0}.w-bl .search-button:after{content:"\e8b6";font-family:'icomoon';font-size:23px;display:inline-block;cursor:pointer}.w-bl .search-field{border:1px solid #ccc;padding:6px 10px}.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px}.f-menu ul li{display:inline-block;margin-right:20px}.f-menu .sub-menu{display:none}.rr{font-size:13px;color:rgba(136,136,136,1)}@media(max-width:768px){.footer{margin-top:60px}.w-bl{flex:1 0 22%}.f-menu ul li{margin-bottom:10px}}@media(max-width:480px){.footer{margin-top:50px}.f-w-f2{padding:25px 0px}.f-w{display:block;margin:15px 0px 0px}.w-bl{margin-bottom:40px}.w-bl{flex:100%}.w-bl ul li{margin-bottom:11px}.f-menu ul li{display:inline-block;line-height:1.8;margin-right:13px}.f-menu .amp-menu > li a{padding:0;font-size:12px;color:#7a7a7a}.rr{margin-top:15px;font-size:11px}}@media(max-width:425px){.footer{margin-top:35px}.w-bl h4{margin-bottom:15px}}.ss-ic ul li{font-family:'icomoon';list-style-type:none;display:inline-block}.ss-ic li a{color:#fff;padding:5px;border-radius:3px;margin:0px 10px 10px 0px;display:inline-block}.ss-ic ul li .s_fb{color:#fff;background:#3b5998}.s_fb:after{content:"\e92d"}.s_tw{background:#1da1f2}.s_tw:after{content:"\e942"}.s_lk{background:#0077b5}.s_lk:after{content:"\e934"}.s_pt{background:#bd081c}.s_pt:after{content:"\e937"}.s_em{background:#b7b7b7}.s_em:after{content:"\e930"}.s_wp{background:#075e54}.s_wp:after{content:"\e946"}.s_li{background:#00cc00}.s_stk{background:#f1f1f1;display:inline-block;width:100%;padding:0;position:fixed;bottom:0;text-align:center;border:0}.s_stk ul{width:100%;display:inline-flex}.s_stk ul li{flex-direction:column;flex-basis:0;flex:1 0 5%;max-width:calc(100% - 10px);display:flex;height:40px}.s_stk li a{margin:0;border-radius:0;padding:12px}.body.single-post{padding-bottom:40px}.s_stk{z-index:99}.body.single-post .adsforwp-stick-ad, .body.single-post amp-sticky-ad{padding-bottom:45px;padding-top:5px}.body.single-post .ampforwp-sticky-custom-ad{bottom:40px;padding:3px 0px 0px}.body.single-post .afw a{line-height:0}.body.single-post amp-sticky-ad amp-sticky-ad-top-padding{height:0px}.content-wrapper a, .breadcrumb ul li a, .srp ul li, .rr a{transition:all 0.3s ease-in-out 0s}[class^="icon-"], [class*=" icon-"]{font-family:'icomoon';speak:none;font-style:normal;font-weight:normal;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.breadcrumbs{padding-bottom:8px;margin-bottom:20px}.breadcrumb ul li,.breadcrumbs span{display:inline-block;list-style-type:none;font-size:10px;text-transform:uppercase;margin-right:5px}.breadcrumb ul li a, .breadcrumbs span a, .breadcrumbs .bread-post{color:#999;letter-spacing:1px}.breadcrumb ul li a:hover, .breadcrumbs span a:hover{color:}.breadcrumbs li a:after, .breadcrumbs span a:after{content:"\e315";font-family:'icomoon';font-size:12px;display:inline-block;color:#bdbdbd;padding-left:5px;position:relative;top:1px}.breadcrumbs li:last-child a:after{display:none}@media (min-width:768px){.wp-block-columns{display:flex}.wp-block-column{max-width:50%;margin:0px 10px}}amp-facebook-like{max-height:28px;top:6px;margin-right:-5px}a.readmore-rp{font-size:13px}.m-s-i li a.s_telegram{background:#d0d0d0;padding:0px 2px;border-radius:2px}.cntn-wrp h1, .cntn-wrp h2, .cntn-wrp h3, .cntn-wrp h4, .cntn-wrp h5, h6{margin-bottom:5px}.cntn-wrp h1{font-size:32px}.cntn-wrp h2{font-size:27px}.cntn-wrp h3{font-size:24px}.cntn-wrp h4{font-size:20px}.cntn-wrp h5{font-size:17px}.cntn-wrp h6{font-size:15px}figure.amp-featured-image{margin:10px 0}amp-img.amp-wp-enforced-sizes[layout=intrinsic] > img, .amp-wp-unknown-size > img{object-fit:contain}.rtl amp-carousel{direction:ltr}.rtl .amp-menu .toggle:after{left:0;right:unset}.sharedaddy li{display:none}sub{vertical-align:sub;font-size:small}sup{vertical-align:super;font-size:small}.btt{position:fixed;bottom:55px;right:20px;background:rgba(71, 71, 71, 0.5);color:#fff;border-radius:100%;width:50px;height:50px}.btt:hover{color:#fff;background:#474747}.btt:before{content:'\25be';display:block;font-size:35px;font-weight:600;color:#fff;transform:rotate(180deg);text-align:center;line-height:1.5} .wp-block-table{min-width:240px}table.wp-block-table.alignright,table.wp-block-table.alignleft,table.wp-block-table.aligncenter{width:auto}table.wp-block-table.aligncenter{width:50%}table.wp-block-table.alignfull,table.wp-block-table.alignwide{display:table}table{display:inline-table;overflow-x:auto}table a:link{font-weight:bold;text-decoration:none}table a:visited{color:#999999;font-weight:bold;text-decoration:none}table a:active, table a:hover{color:#bd5a35;text-decoration:underline}table{font-family:Arial, Helvetica, sans-serif;color:#666;font-size:15px;text-shadow:1px 1px 0px #fff;background:#eee;margin:0px;width:95%}table th{padding:21px 25px 22px 25px;border-top:1px solid #fafafa;border-bottom:1px solid #e0e0e0;background:#ededed}table th:first-child{text-align:left;padding-left:20px}table tr:first-child th:first-child{-webkit-border-top-left-radius:3px;border-top-left-radius:3px}table tr:first-child th:last-child{-webkit-border-top-right-radius:3px;border-top-right-radius:3px}table tr{text-align:center;padding-left:20px}table td:first-child{padding-left:20px;border-left:0}table td{padding:18px;border-top:1px solid #ffffff;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;background:#fafafa;background:-webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa))}table tr.even td{background:#f6f6f6;background:-webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6))}table tr:last-child td{border-bottom:0}table tr:last-child td:first-child{-webkit-border-bottom-left-radius:3px;border-bottom-left-radius:3px}table tr:last-child td:last-child{-webkit-border-bottom-right-radius:3px;border-bottom-right-radius:3px}table tr:hover td{background:#f2f2f2;background:-webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0))}@media screen and (min-width:650px){table{display:inline-table}}.has-text-align-left{text-align:left}.has-text-align-right{text-align:right}.has-text-align-center{text-align:center}#bbpress-forums{margin-top:30px}.bbp-forums{width:100%;display:inline-block;margin-top:50px}.bbp-forums li, .bbp-topics li, .bbp-replies li{list-style-type:none}#bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer{background:#f3f3f3;border-top:1px solid #eee;font-weight:bold;padding:10px;text-align:center;display:inline-block;width:100%;line-height:1.5}#bbpress-forums li.bbp-header{background:#eaeaea;color:#555}li.bbp-forum-info, li.bbp-topic-title{float:left;text-align:left;width:55%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{float:left;text-align:center;width:10%}#bbpress-forums ul.odd{background-color:#fbfbfb;display:inline-block;width:100%}.bbp-body ul{padding:10px;display:inline-block;width:100%}#bbpress-forums .bbp-forum-info .bbp-forum-content, #bbpress-forums p.bbp-topic-meta{font-size:11px;margin:15px 0 5px;padding:0;word-wrap:break-word}li.bbp-forum-freshness, li.bbp-topic-freshness{text-align:center;float:left;width:22%}.bbp-topic-freshness-author amp-img{display:inline-block;vertical-align:middle}#bbpress-forums a{color:}.subscription-toggle, .bbp-pagination, .favorite-toggle{background:transparent;clear:both;margin-bottom:20px;overflow:hidden;font-size:12px}div.bbp-template-notice.info{border:#cee1ef 1px solid;background-color:#f0f8ff;margin:15px 0px 0px}#bbpress-forums div.bbp-template-notice a{color:#555;display:inline-block}.bbpress.blog-post .section-text p{font-size:15px}#bbpress-forums fieldset.bbp-form{border:1px solid #d6d6d6;padding:10px 20px;margin-bottom:10px}#bbpress-forums fieldset.bbp-form legend{padding:5px;line-height:1.4}legend{margin-bottom:20px}div.bbp-template-notice, div.indicator-hint{border-width:1px;border-style:solid;padding:0 0.6em;margin:5px 0 15px;border-radius:3px;background-color:#ffffe0;border-color:#e6db55;color:#000;clear:both}div.bbp-template-notice p{padding:15px 5px;font-size:14px;color:#666;line-height:1.5}.bbp-topic-started-by, .bbp-topic-started-by a{display:inline-block;vertical-align:middle}.form-group{padding-bottom:7px;position:relative}.bbp-form label{font-size:15px;font-weight:bold;color:#444;margin-bottom:10px;display:inline-block}.bbp-form input{width:100%;border:none;border-bottom:1px solid #ccc;margin-bottom:20px;padding:10px}.bbp-form textarea{width:100%;border:1px solid #ccc;margin-bottom:20px;padding:20px}#bbpress-forums fieldset.bbp-form select{margin:0 0 20px;padding:10px}.bbp-form #bbp_topic_subscription{display:inline-block;width:15px;margin-bottom:4px}.bbp-submit-wrapper{margin-top:15px;float:right;clear:both}.button.submit{background:;border:none;padding:15px 30px;color:#fff;text-transform:uppercase;letter-spacing:0.5px;border-radius:3px;cursor:pointer}.bbp-topic-tags{float:right;font-size:14px;margin-bottom:20px;color:#555}#bbpress-forums li.bbp-header .bbp-reply-author, #bbpress-forums li.bbp-footer .bbp-reply-author{float:left;margin:0;padding:0;width:120px}#bbpress-forums li.bbp-header .bbp-reply-content, #bbpress-forums li.bbp-footer .bbp-reply-content{margin-left:140px;padding:0;text-align:left;font-size:13px}li.bbp-header div.bbp-reply-content span#subscription-toggle, li.bbp-header div.bbp-reply-content span#favorite-toggle{float:right;font-weight:500}#bbpress-forums div.bbp-reply-header{background-color:#f4f4f4}div.bbp-reply-header, li.bbp-body div.hentry{margin-bottom:0;overflow:hidden;padding:18px 8px 18px 8px}#bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results{font-size:12px;color:#555}span.bbp-admin-links{float:right;color:#ddd}#bbpress-forums span.bbp-admin-links a{color:#bbb;font-weight:normal;font-size:10px;text-transform:uppercase;text-decoration:none}#bbpress-forums .bbp-reply-header a.bbp-reply-permalink{float:right;margin-left:10px;color:#ccc}div.bbp-reply-header{border-top:1px solid #ddd;clear:both}#bbpress-forums div.odd, #bbpress-forums ul.odd{background-color:#fbfbfb}#bbpress-forums div.bbp-reply-author{float:left;text-align:center;width:115px}.bbp-reply-author amp-img{margin:0 auto}#bbpress-forums div.bbp-reply-content{margin-left:130px;padding:12px 12px 12px 0;text-align:left;font-size:15px}.bbp-reply-author .bbp-author-role{margin-top:15px}.bbp-reply-author .bbp-reply-ip{margin-top:8px}.bbp-pagination-count{margin-top:20px}@media (max-width:480px){li.bbp-forum-info, li.bbp-topic-title{width:36%}li.bbp-forum-freshness, li.bbp-topic-freshness{width:27%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{width:18%}div.bbp-reply-header, li.bbp-body div.hentry{padding:10px 8px 10px 8px}span.bbp-admin-links{clear:left;float:left;margin-top:7px}#bbpress-forums .bbp-body div.bbp-reply-author{text-align:left;width:100%}#bbpress-forums .bbp-body div.bbp-reply-content{margin:20px 10px 10px;padding:0;display:inline-block;width:100%}.bbp-reply-author amp-img{float:left;margin-right:20px}.bbp-reply-author .bbp-author-role{margin-top:10px}.bbp-topic-tags{float:left}}@media(max-width:320px){.forum-titles li.bbp-forum-info, .forum-titles li.bbp-topic-title{width:100%;text-align:center}li.bbp-forum-info, li.bbp-topic-title{width:100%}li.bbp-forum-topic-count, li.bbp-topic-voice-count, li.bbp-forum-reply-count, li.bbp-topic-reply-count{width:25%}li.bbp-forum-freshness, li.bbp-topic-freshness{width:50%}#bbpress-forums li.bbp-body li.bbp-forum-topic-count, #bbpress-forums li.bbp-body li.bbp-forum-reply-count, #bbpress-forums li.bbp-body li.bbp-forum-freshness, #bbpress-forums li.bbp-body li.bbp-topic-voice-count, #bbpress-forums li.bbp-body li.bbp-topic-reply-count, #bbpress-forums li.bbp-body li.bbp-topic-freshness{margin-top:7px}#bbpress-forums li.bbp-header .bbp-reply-author, #bbpress-forums li.bbp-footer .bbp-reply-author{width:80px}#bbpress-forums li.bbp-header .bbp-reply-content, #bbpress-forums li.bbp-footer .bbp-reply-content{margin-left:70px}}.amp-logo amp-img{width:190px}.amp-menu input{display:none}.amp-menu li.menu-item-has-children ul{display:none}.amp-menu li{position:relative;display:block}.amp-menu > li a{display:block}.icon-widgets:before{content:"\e1bd"}.icon-search:before{content:"\e8b6"}.icon-shopping-cart:after{content:"\e8cc"}.cach-btns{display:flex;margin:0 auto;width:100%;justify-content:center}.cach-btns > a:nth-child(1){margin-right:30px}a.btn-txt{font-size:20px;border-radius:0px;color:#fff;background:#2cbf55;display:inline-block;padding:10px 20px 10px 20px;width:166px;font-weight:400;box-sizing:initial;border-radius:30px}@media(max-width:480px){.cach-btns{display:inline-block;margin:0 auto;width:100%;text-align:center}a.btn-txt{width:90%}.cach-btns > a:nth-child(1){margin:0px 0px 20px 0px}}</style>
	<?php elseif ( isProduct() ) : ?>
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
			
			<style amp-custom>
				@font-face {font-family: 'Poppins';font-style: normal;font-weight: 300;src: local('Poppins Light'), local('Poppins-Light'), url('../bl-plugins/sub-blogs/amp/fonts/Poppins-Light.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 400;src: local('Poppins Regular'), local('Poppins-Regular'), url('../bl-plugins/sub-blogs/amp/fonts/Poppins-Regular.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 500;src: local('Poppins Medium'), local('Poppins-Medium'), url('../bl-plugins/sub-blogs/amp/fonts/Poppins-Medium.ttf');} 
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 600;src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('../bl-plugins/sub-blogs/amp/fonts/Poppins-SemiBold.ttf'); }
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 700;src: local('Poppins Bold'), local('Poppins-Bold'), url('../bl-plugins/sub-blogs/amp/fonts/Poppins-Bold.ttf'); }
body{font-family: 'Poppins', sans-serif;font-size: 16px; line-height:1.25; }
ol, ul{ list-style-position: inside }
p, ol, ul, figure{ margin: 0 0 1em; padding: 0; }
a, a:active, a:visited{ text-decoration: none; color: #818181;}
a:hover, a:active, a:focus{}
pre{ white-space: pre-wrap;}
.left{float:left}
.right{float:right}
.hidden, .hide{ display:none }
.clearfix{ clear:both }
blockquote{ background: #f1f1f1; margin: 10px 0 20px 0; padding: 15px;}
blockquote p:last-child {margin-bottom: 0;}
.amp-wp-unknown-size img {object-fit: contain;}
.amp-wp-enforced-sizes{ max-width: 100% }
html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}
*,*:after,*:before {
box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}
.alignright {float: right;margin-left:10px;}
.alignleft {float: left;margin-right:10px;}
.aligncenter {display: block;margin-left: auto;margin-right: auto;}
amp-iframe { max-width: 100%; margin-bottom : 20px; }
amp-wistia-player {margin:5px 0px;}
.wp-caption {padding: 0;}
.wp-caption-text {font-size: 12px;line-height: 1.5em;margin: 0;padding: .66em 10px .75em;text-align: center;}
amp-carousel > amp-img > img {object-fit: contain;}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
amp-instagram{box-sizing: initial;}
@font-face {font-family: 'icomoon';font-style: normal;font-weight: normal;src:  local('icomoon'), local('icomoon'), url('../bl-plugins/sub-blogs/amp/fonts/icomoon.ttf');}
.cntr {max-width: 1100px;margin: 0 auto;width:100%;padding:0px 20px}
.wp-block-image.aligncenter amp-img {
 margin: 0 auto;
 }
header .cntr{
	max-width:1100px;
}
.h_m{
	position: static;
	background: rgba(255, 255, 255, 255);	border-bottom: 1px solid;	border-color:rgba(0,0,0,0.12);		padding: 0 0 0 0;	margin: 0 0 0 0;}
.content-wrapper{
	margin-top:0px;
} 
.h_m_w{width:100%;clear:both;display: inline-flex;height:60px;}
.h-ic a:after, .h-ic a:before{font-family: 'icomoon';font-size: 23px;color: rgba(51,51,51,1);}
.h-call a:after{content: "\e0cd";}
.h-shop a:after{align-self: center;}
.h-ic{margin:0px 10px; align-self: center;}
.amp-logo a{line-height:0;display:inline-block;color:rgba(51,51,51,1);}
.logo  h2 {margin: 0;font-size: 17px;font-weight: 700;text-transform: uppercase;display:inline-block;}
.h-srch a{line-height:1;display:block;}
.amp-logo amp-img{margin: 0 auto;}
@media(max-width:480px){ .h-sing {font-size: 13px;} }
.logo{z-index: 2;flex-grow: 1;align-self: center;text-align:center;line-height:0;}
.h-1{display:flex;order:1;}
.h-nav{order: -1;align-self: center;}
.h-ic:last-child{margin-right:0;}

.lb-t {position: fixed;top: -50px;width: 100%;width: 100%;opacity: 0;-webkit-transition: opacity .5s ease-in-out;transition: opacity .5s ease-in-out;overflow: hidden;z-index:9;background: rgba(20, 20, 22, 0.9);}
.lb-t img {margin: auto;position: absolute;top: 0;left:0;right:0;bottom: 0;max-height: 0%;max-width: 0%;border: 3px solid white;box-shadow: 0px 0px 8px rgba(0,0,0,.3);box-sizing: border-box;-webkit-transition: .5s ease-in-out;transition: .5s ease-in-out;}
a.lb-x {display: block;width:50px;height:50px;box-sizing: border-box;background: tranparent;color: black;text-decoration: none;position: absolute;top: -80px;right: 0;-webkit-transition: .5s ease-in-out;transition: .5s ease-in-out;}
a.lb-x:after {content: "\e5cd";font-family: 'icomoon';font-size: 30px;line-height: 0;display: block;text-indent: 1px;
color: rgba(255,255,255,0.8); }
.lb-t:target {opacity: 1;top: 0;bottom: 0;left:0;z-index:1;}
.lb-t:target img {max-height: 100%;max-width: 100%;}
.lb-t:target a.lb-x {top: 25px;}
.lb img{cursor:pointer;}
.lb-btn form{position: absolute;top: 200px;left: 0;right: 0;margin: 0 auto;text-align: center;}
.lb-btn #s{padding:10px;}
.lb-btn #amp-search-submit{padding:10px;cursor:pointer;}
.amp-search-wrapper{width: 80%;margin: 0 auto;position: relative;}
.overlay-search:before {content: "\e8b6";position: absolute;right:0;font-size: 24px;font-family: 'icomoon';cursor: pointer;top:4px;
color: rgba(255,255,255,0.8);}
.lb-btn #amp-search-submit {cursor: pointer;background:transparent;border: none;display: inline-block;width: 30px;height: 30px;opacity: 0;position: absolute;z-index:100;right: 0;top: 0;}
.lb-btn #s {padding: 10px;background: transparent;border: none;border-bottom: 1px solid #504c4c;width:100%;
color: rgba(255,255,255,0.8);}
.m-ctr{background: rgba(20, 20, 22, 0.9);}
.tg, .fsc{display: none;}
.fsc{width: 100%;height: -webkit-fill-available;position: absolute;cursor: pointer;top:0;left:0;}
.tg:checked + .hamb-mnu > .m-ctr {margin-left: 0;border-right: 1px solid ;}
.tg:checked + .hamb-mnu > .m-ctr .c-btn {position: fixed;right: 0px;top:0px;}
.m-ctr{margin-left: -100%;float: left;}
.tg:checked + .hamb-mnu > .fsc{display: block;background: rgba(0,0,0,.9);height:100%;}
.t-btn, .c-btn{cursor: pointer;}
.t-btn:after{content:"\e5d2";display:inline-block;font-family: "icomoon";font-size:28px;color: rgba(51,51,51,1);}
.c-btn:after{content: "\e5cd";font-family: "icomoon";font-size: 20px;color: rgba(255,255,255,0.8);line-height: 0;display: block;text-indent: 1px;}
.c-btn{float: right;padding: 20px 10px;}
.m-ctr{transition: margin 0.3s ease-in-out;}
.m-ctr{width:90%;height:100%;position: absolute;z-index:99;padding: 2% 0% 100vh 0%;}
.m-menu{display: inline-block;width: 100%;padding: 2px 20px 10px 20px;}
.m-scrl{overflow-y: auto;display: inline-block;width: 100%;overflow: scroll;max-height: 94vh;}
::-webkit-scrollbar { display: none; }
.m-menu .amp-menu .toggle:after{content: "\e313";font-family: 'icomoon';background-size: 16px;display: inline-block;top: 1px;padding: 5px;font-size:25px;transform: rotate(270deg);cursor: pointer;border-radius: 35px;color: rgba(255,255,255,0.8);}
.m-menu .amp-menu li.menu-item-has-children:after{display:none;}
.m-menu .amp-menu li ul{font-size:14px;}
.m-menu .amp-menu {list-style-type: none;padding: 0;}
.m-menu .amp-menu > li a{color: rgba(255,255,255,0.8); padding: 12px 7px;margin-bottom:0;display:inline-block;}
.menu-btn{margin-top:30px;text-align:center;}
.menu-btn a{color:#fff;border:2px solid #ccc;padding:15px 30px;display:inline-block;}
.amp-menu li.menu-item-has-children>ul>li {width:100%;}
.m-menu .amp-menu li.menu-item-has-children>ul>li{
	padding-left:0;
	border-bottom: 1px solid ;
	margin:0px 10px;
}
.m-menu .amp-menu .sub-menu li:last-child{border:none;}
.m-menu .amp-menu a {padding: 7px 15px;}
.m-menu > li{font-size:17px;}
/*New Syles*/
	.m-menu .toggle {float :right;}
	.m-menu input{display:none}
	.m-menu .amp-menu [id^=drop]:checked + label + ul{ display: block;}
	.m-menu .amp-menu [id^=drop]:checked + .toggle:after{transform:rotate(360deg);}
/*New Syles*/
.p-m-fl{width:100%;border-bottom: 1px solid rgba(0, 0, 0, 0.05);background:rgb(239, 239, 239)}
.p-menu{width:100%;text-align:center;margin: 0px auto;padding:  0px  25px 0px 25px;}
::-webkit-scrollbar {display: none;}
.p-menu ul li{display: inline-block;margin-right: 21px;font-size: 12px;line-height: 20px;letter-spacing: 1px;font-weight: 400;}
.p-menu ul li a{color:;padding: 12px 0px 12px 0px}
.p-menu input{display:none}
.p-menu .toggle {display:none }
	.p-menu .amp-menu li.menu-item-has-children:hover>ul{display:none;}
	.p-menu{overflow-x: auto;overflow-y:hidden;white-space: nowrap;}
.p-menu ul li.menu-item-has-children:after{display:none;}
@media(max-width:768px){
	.p-menu ul li.menu-item-has-children:hover > ul{display:none;}
	.p-menu{overflow-x: auto;overflow-y:hidden;white-space: nowrap;}
	.p-menu ul li.menu-item-has-children > a:after{display:none;}
}
.content-wrapper{
font-family: 'Poppins', sans-serif;}
table {
    display: -webkit-box;
    overflow-x: auto;
}
.tl-exc{font-size: 16px;color: #444;margin-top: 10px;line-height:20px;}
.amp-category span:nth-child(1) {display: none;}
.amp-category span a, .amp-category span{color: #818181;font-size: 12px;font-weight: 500;text-transform: uppercase;}
.amp-category span:after{content:"/";display:inline-block;margin:0px 5px 0px 5px;position:relative;top:1px;color:rgba(0, 0, 0, 0.25);}
.amp-category span:last-child:after{display:none;}
.sp{width:100%;margin-top:20px;display:inline-block;}
.amp-post-title{font-size:48px;line-height:58px;color: #333;margin:0;padding-top:15px;}
.sf-img {width: 100%;display: inline-block;height: auto;margin-top: 33px;}
.sf-img figure{margin:0;}
.sf-img .wp-caption-text{width: 1100px;text-align: left;margin: 0 auto;color: #a1a1a1;font-size: 14px;line-height:20px;font-weight: 500;border-bottom: 1px solid #ccc;padding: 15px 0px;}
.sf-img .wp-caption-text:before{content:"\e412";font-family: 'icomoon';position: relative;top: 4px;opacity: 0.4;font-size:24pxmargin-right: 5px;}
.sp-cnt{margin-top: 40px;clear: both;width: 100%;display: inline-block; }
.sp-rl{display:inline-flex;width:100%;}
.sp-lt{display: flex;flex-direction: column;flex: 1 0 20%;order: 0;max-width:237px;}
.sp-rt{width: 72%;margin-left: 60px;flex-direction: column;justify-content: space-around;order: 1;}
.ss-ic, .sp-athr, .amp-tags, .post-date{padding-bottom:20px;border-bottom:1px dotted #ccc;}
.shr-txt, .athr-tx, .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{margin-bottom: 12px;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{display: block;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{text-transform: uppercase;font-size: 12px;color: #666;font-weight: 400;}
.loop-date, .post-edit-link{display:inline-block;}
.post-date .post-edit-link{color: #818181;float: right;}
.sp-athr, .amp-tags, .post-date{margin-top:20px;}
.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag {font-size: 15px;color: #818181;font-weight: 400;line-height: 1.5;}
.amp-tags .amp-tag:after{content: "/";display: inline-block;padding: 0px 10px;position: relative;top: -1px;color: #ccc;font-size: 12px;}
.amp-tags .amp-tag:last-child:after{display:none;}
.ss-ic li:before{border-radius: 2px;text-align:center;padding: 4px 6px;}
.sgl table {width: 100%;margin-bottom:25px;}
.sgl td {padding: 0.5em 1em;border: 1px solid #ddd;}
.sgl tr:nth-child(odd) td {background: #f7f7f7;}

/** Pre tag Styling **/
pre {padding: 30px 15px;background: #f7f7f7;white-space: pre-wrap;;font-size: 14px;color: #666666;border-left: 3px solid;border-color: #818181;margin-bottom: 20px;}



.cntn-wrp{font-size:18px;color:#000;line-height:1.7;word-break: break-word;}
.sp-artl h1, h2, h3, h4, h5, h6{margin-bottom:5px;}
		.cntn-wrp h1 {font-size: 32px;}
			.cntn-wrp h2 {font-size: 27px;}
			.cntn-wrp h3 {font-size: 24px;}
			.cntn-wrp h4 {font-size: 20px;}
			.cntn-wrp h5 {font-size: 17px;}
			.cntn-wrp h6 {font-size: 15px;}
	.cntn-wrp p, .cntn-wrp ul, .cntn-wrp ol{margin:0px 0px 30px 0px;word-break: break-word;}
.sp-rt p strong, .pg p strong{font-weight: 700;}
.m-ctr {
position: fixed;
overflow: scroll;
}
.m-scrl {
display: inline-block;
width: 100%;
max-height: 94vh;
}
	.srp{margin-top:20px;}
	.srp .amp-related-posts amp-img{float: left;width: 100%;margin: 0px;height:100%;}
	.srp ul li{display: inline-block;line-height: 1.3;margin-bottom: 24px;list-style-type:none;width:100%;}
	.srp ul li:last-child{margin-bottom:0px;}
	.has_thumbnail:hover {opacity:0.7;}
	.has_thumbnail:hover .related_link a{color: #818181;}
.related_link{margin-top:10px;}
.related_link a{color:#333;}
.related_link p{word-break: break-word;color: #444;font-size: 13px;line-height: 20px;
letter-spacing: 0.10px;margin-top: 5px;font-weight: 400;}
.amp-related-posts ul{list-style-type:none;}
.r-pf{margin-top: 40px;display: inline-block;width: 100%;}
	.body.single-post{
	  padding-bottom:40px;
	}
.sp-rt .amp-author {padding: 20px 20px;border-radius: 0;background: #f9f9f9;border: 1px solid #ececec;display: inline-block;width: 100%;}
.sp-rt .amp-author-image{float:left;}
.sp-rt .author-details a{color: #222;font-size: 14px;font-weight: 500;}
.sp-rt .author-details a:hover{color:#005be2;text-decoration:underline;}
.amp-author-image amp-img{border-radius: 50%;margin: 0px 12px 5px 0px;display: block; width:50px;}
.author-details p{margin: 0;font-size: 13px;line-height: 20px;color: #666;padding-top: 4px;}
.breadcrumbs{padding-bottom: 8px;margin-bottom: 20px;
}
.breadcrumb ul li,.breadcrumbs span{display: inline-block;list-style-type: none;font-size: 10px;text-transform: uppercase;margin-right: 5px;}
.breadcrumb ul li a, .breadcrumbs span a{color: #999;letter-spacing: 1px;}
.breadcrumb ul li a:hover, .breadcrumbs span a:hover{color:#005be2;}
.breadcrumbs li a:after, .breadcrumbs span a:after{content: "\e315";display: inline-block;color: #bdbdbd;font-family: 'icomoon';padding-left: 5px;font-size: 12px;position: relative;top: 1px;}
.breadcrumbs li:last-child a:after {display: none;}
#pagination{margin-top: 30px;border-top: 1px dotted #ccc;padding: 20px 5px 0px 5px;;font-size: 16px;line-height: 24px;font-weight:400;}
.next{float: right;width: 45%;text-align:right;position:relative;margin-top:10px;}
.next a, .prev a{color:#333;}
.prev{float: left;width: 45%;position:relative;margin-top:10px;}
.prev span{text-transform: uppercase;font-size: 12px;color: #666;display: block;position: absolute;top: -26px;}
.next span{text-transform: uppercase;font-size: 12px;color: #666;display: block;font-weight: 400;position: absolute;top: -26px;right:0}
.next:hover a, .prev:hover a{color:#818181;}
.prev:after{border-left:1px dotted #ccc;content: "";height: calc(100% - -10px);right: -50px;position: absolute;top: 50%;transform: translate(0px, -50%);width: 2px;}
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
.ampforwp_post_pagination p{margin: 0;font-size: 18px;color: #444;font-weight: 500;margin-bottom:10px;}
.ampforwp_post_pagination p a{color:#005be2;padding:0px 10px;}
.cmts{width:100%;display:inline-block;clear:both;margin-top:40px;}
.amp-comment-button{background-color: #818181;font-size: 15px;float: none;margin: 30px auto 0px auto;text-align: center;border-radius: 3px;font-weight: 600;width:250px;}
.form-submit #submit{background-color: #005be2;font-size: 14px;text-align: center;border-radius: 3px;font-weight: 500;color: #fff;cursor: pointer;margin: 0;border: 0;padding: 11px 21px;}
#respond p {margin: 12px 0;}
.amp-comment-button a{color: #fff;display: block;padding: 7px 0px 8px 0px;}
.comment-form-comment #comment {border-color: #ccc;width: 100%;padding: 20px;}
.cmts h3{margin: 0;font-size: 12px;padding-bottom: 6px;border-bottom: 1px solid #eee;font-weight: 400;letter-spacing: 0.5px;text-transform: uppercase;color: #444;}
.cmts h3:after{content: "";display: block;width: 115px;border-bottom: 1px solid #005be2;position: relative;top: 7px;}
.cmts ul{margin-top:16px;}
.cmts ul li{list-style: none;margin-bottom: 20px;padding-bottom: 20px;border-bottom: 1px solid #eee;}
.cmts .amp-comments-wrapper ul .children{margin-left:30px; }
.cmts .comment-author.vcard .says{display:none;}
.cmts .comment-author.vcard .fn{font-size: 12px;font-weight: 500;color: #333;}
.cmts .comment-metadata{font-size: 11px;margin-top: 8px;}
.amp-comments-wrapper ul li:hover .comment-meta .comment-metadata a{color:#818181;;}
.cmts .comment-metadata a{color: #999;}
.comment-content{margin-top:6px;width:100%;display:inline-block;}
.comment-content p{font-size: 14px;color: #333;line-height: 22px;font-weight: 400;margin: 0;}
.comment-meta amp-img{float:left;margin-right:10px;border-radius:50%;width:40px;}
.sp-rt .amp-author {margin-top: 5px;}
.cntn-wrp a{margin:10px 0px;color: #818181;}
.loop-wrapper{display: flex;flex-wrap: wrap;margin: -15px;}
.loop-category li{display: inline-block;list-style-type: none;margin-right: 10px;font-size: 10px;font-weight: 600;letter-spacing: 1.5px;}
.loop-category li a{color:#555;text-transform: uppercase;}
.loop-category li:hover a{color:#005be2;}
.fsp-cnt p{color:#444;font-size:13px;line-height:20px;letter-spacing: 0.10px;word-break: break-word;}
.fsp:hover h2 a{color: #818181;}
.fsp h2 a{color:#191919;}  
.fsp{margin: 15px;flex-basis: calc(33.33% - 30px);}
.fsp-img {margin-bottom:10px;}
.fsp h2{margin:0px 0px 5px 0px;font-size:20px;line-height:25px;font-weight:500;}
.fsp-cnt .loop-category{margin-bottom:8px;}
.fsp-cnt .loop-category li {font-weight: 500;}
.pt-dt{font-size:11px;color:#808080;margin: 8px 0px 0px 0px;display: inline-flex;}
blockquote{margin-bottom:20px;}
blockquote p {font-size: 34px; line-height: 1.4; font-weight: 700; position: relative; padding: 30px 0 0 0; }
blockquote p:before {content: "";border-top: 8px solid #000;width: 115px;line-height: 40px;display: inline-block;position: absolute;top: 0;}


@media(max-width:1110px){
    .cntr{width:100%;padding:0px 20px;}
    .sp-rt {margin-left: 30px;}
}
@media(max-width:768px){
    .tl-exc {font-size: 14px;margin-top: 3px;line-height: 22px;}
    .sp-rl {display: inline-block;width: 100%;}
    .sp-lt {width: 100%;margin-top: 20px;max-width:100%;}
    .sp-cnt{margin-top: 15px;}
    .r-pf h3{padding-top:20px;border-top:1px dotted #ccc; }
    .r-pf {margin-top:20px;}
    .cmts{margin:20px 0px 20px 0px;}
    .sp-rt {width: 100%;margin-left: 0;}
    .sp-rt .amp-author {padding: 20px 15px;}
    #pagination {margin: 20px 0px 20px 0px;border-top: none;}
    .amp-post-title{padding-top:10px;}
    .fsp{flex-basis: calc(100% - 30px);}
    .fsp-img{width:40%;float:left;margin-right:20px;}
    .fsp-cnt{width:54%;float:left;}
    	    .srp .related_link{font-size:20px;line-height:1.4;font-weight:600;}
	    .rlp-image{width:200px;float:left;margin-right:15px;display: flex;flex-direction: column;}
	    .rlp-cnt{display: flex;}
    }
@media(max-width:480px){
	.loop-wrapper{margin:0;}
    .r-pf .cntr{padding:0}
    .cntn-wrp p{line-height:1.65;}
    .related_posts .has_related_thumbnail {width: 100%;}
    .rlp-image {width: 100%;float: none;margin-right: 0px;}
    .rlp-cnt {width: 100%;float: none;}
    .amp-post-title {font-size: 32px;line-height: 44px;}
    .amp-category span a {font-size: 12px;}
    .sf-img{margin-top:20px;}
    .sp{margin-top: 20px;}
    .menu-btn a{padding:10px 20px;font-size:14px;}
    .next, .prev{float: none;width: 100%;}
    #pagination {padding: 10px 0px 0px;}
    #respond {margin: 0;}
    .next a {margin-bottom: 45px;display:inline-block;}
    .prev:after{display:none;}
    .author-details p {font-size: 12px;line-height: 18px;}
    .sf-img .wp-caption-text{width:100%;padding:10px 15px;}
    .fsp-img{width:100%;float:none;margin-right:0px;}
    .fsp-cnt{width:100%;float:none;}
    .fsp{border:none; padding:0;}
    .fsp-cnt{padding: 0px 15px 0px 14px;}
    .r-pf .fsp-cnt{padding: 0px;}
     blockquote p {font-size:20px;}
     }
@media(max-width:425px){
    .sp-rt .amp-author {margin-bottom: 10px;}
    #pagination {margin: 20px 0px 10px 0px;}
    .fsp h2 {font-size: 24px;font-weight:600;}
    .r-pf h3{padding: 15px 0px 0px 15px;}
}
@media(max-width:320px){
    .cntn-wrp p {font-size: 16px;}  
}
.m-srch #amp-search-submit {
    cursor: pointer;
    background: transparent;
    border: none;
    display: inline-block;
    width: 30px;
    height: 30px;
    opacity: 0;
    position: absolute;
    z-index: 100;
    right: 0;
    top: 0;
}
.m-srch .amp-search-wrapper{
	border: 1px solid rgba(255,255,255,0.8);
	background:rgba(255,255,255,0.8);
	width:100%;
	border-radius:60px;
}
.m-srch #s{
	padding:10px 15px;
	border:none;
	width:100%;
	color:rgba(20,20,22,0.9);
	background:rgba(255,255,255,0.8);
	border-radius: 60px;
}
.m-srch{
	border-top: 1px solid ;
    padding: 20px;
}
.m-srch .overlay-search:before{
	color:rgba(20,20,22,0.9);
	padding-right:10px;
	top:6px;
}
.cp-rgt{
	font-size:11px;
	line-height:1.2;
	color:rgba(255,255,255,0.8);
	padding: 20px;
	text-align: center;
	border-top: 1px solid ;
}
.cp-rgt a{
	color:rgba(255,255,255,0.8);
	border-bottom:1px solid rgba(255,255,255,0.8);
	margin-left:10px;
}
.cp-rgt .view-non-amp{
	display:none;
}
a.btt:hover {
    cursor: pointer;
}
/*** Sidebar CSS ***/
@media(max-width:768px){
.sdbr-right{
	width:100%;
}
.b-w .hmp, .arch-psts{
	width:100%;
	padding:0;
}
.b-w, .arch-dsgn{
	display: block;
}
.b-w .fsp, .arch-psts .fsp{
    flex-basis: calc(100% - 30px);
}
}
.footer{margin-top: 80px;}
.f-menu ul li .sub-menu{display:none;}
.f-menu ul li{display:inline-block;margin-right:20px;}
.f-menu ul li a {padding:0;color:#7a7a7a;}
.f-menu ul > li:hover a{color: #818181;}
.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px;}
.rr{font-size: 12px;color: rgba(136,136,136,1);}
.rr span{margin:0 10px 0 0px}
.f-menu ul li.menu-item-has-children:hover > ul{display:none;}
.f-menu ul li.menu-item-has-children:after{display:none;}
.f-w{display: inline-flex;width: 100%;flex-wrap:wrap;}
.f-w-f2{text-align: center;border-top: 1px solid rgba(238,238,238,1);
padding: 50px 0 50px 0;
}
.w-bl{margin-left: 0;display: flex;flex-direction: column;position: relative;flex: 1 0 22%;margin:0 15px 30px;line-height:1.5;}
.w-bl h4{font-size: 12px;font-weight: 500;margin-bottom: 20px;text-transform: uppercase;letter-spacing: 1px;padding-bottom: 4px;}
.w-bl ul li, .ampforwp_wc_shortcode_title{list-style-type: none;margin-bottom: 15px;}
.w-bl ul li:last-child{margin-bottom:0;}
.w-bl ul li a{text-decoration: none;}
.w-bl .menu li .sub-menu{display:none;}

.ampforwp_wc_shortcode_title{
	margin-top: 12px;
    display: inline-block;
}
.ampforwp_wc_shortcode_excerpt{
	font-size:15px;
	line-height:1.4;
}
	.f-menu {font-size: 14px;line-height: 1.4;margin-bottom: 30px;}
	.f-menu ul li {display: inline-block;margin-right: 20px;}
	.f-menu .sub-menu{display:none;}
	.rr{font-size:13px;color: rgba(136,136,136,1);}
@media(max-width:768px){
    .footer {margin-top: 60px;}
    .w-bl{flex:1 0 22%;}
    .f-menu ul li {margin-bottom:10px;}
}
@media(max-width:480px){
    .footer {margin-top: 50px;}
        .f-w-f2 {padding: 25px 0px;}
    .f-w{display:block;}
    .w-bl{margin-bottom:40px;}
    .w-bl{flex:100%;}
    .w-bl ul li {margin-bottom: 11px;}
    .f-menu ul li {display: inline-block;line-height: 1.8;margin-right: 13px;}
    .f-menu .amp-menu > li a {padding: 0;font-size: 12px;color: #7a7a7a;}
    .rr {margin-top: 15px;font-size: 11px;
    		}
}
@media(max-width:425px){
    .footer {margin-top: 35px;}
        .w-bl h4 {margin-bottom: 15px;}
}
.ss-ic ul li{font-family: 'icomoon';list-style-type:none;display:inline-block;}
.ss-ic li a{color: #fff;padding: 5px;border-radius: 3px;margin: 0px 10px 10px 0px;display: inline-block;}
.ss-ic ul li .s_fb{	color:#fff;background:#3b5998;}
.s_fb:after{content: "\e92d";}
.s_tw{background:#1da1f2;}
.s_tw:after{content: "\e942";}
.s_gp{background:#dd4b39;}
.s_gp:after{content: "\e931";}
.s_lk{background:#0077b5;}
.s_lk:after{content: "\e934";}
.s_pt{background:#bd081c;}
.s_pt:after{content:"\e937";}
.s_em{background:#b7b7b7;}
.s_em:after{content: "\e930";}
.s_wp{background:#075e54;}
.s_wp:after{content: "\e946";}
.s_stk{background: #f1f1f1;display:inline-block;width: 100%;padding:0;position:fixed;bottom: 0;text-align: center;border: 0;}
.s_stk ul{width:100%;display:inline-flex;}
.s_stk ul li{flex-direction: column;flex-basis: 0;flex: 1 0 5%;max-width: calc(100% - 10px);display: flex;}
.s_stk li a{margin:0;border-radius: 0;padding:12px;}

.body.single-post{
  padding-bottom:40px;
}
.content-wrapper a, .breadcrumb ul li a, .srp ul li, .rr a{transition: all 0.3s ease-in-out 0s;}
[class^="icon-"], [class*=" icon-"] {font-family: 'icomoon';speak: none;font-style: normal;font-weight: normal;font-variant: normal;text-transform: none;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.amp-ad-wrapper{width:100%;text-align:center;}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
.amp-ad-wrapper {margin-top: 10px; margin-bottom: 10px}

				    .amp-logo amp-img{width:0px}
     aside{width:150px}
    .amp-menu{list-style-type:none;margin:0;padding:0}
    .amp-menu li{position:relative;display:block}
    .amp-menu li.menu-item-has-children ul{display:none}
    .amp-menu li.menu-item-has-children:hover>ul{display:}
    .amp-menu li.menu-item-has-children>ul>li{padding-left:10px}
    .amp-menu li ul li a{
	    padding: 4px 10px;
	    font-size:14px;
	}
	.amp-menu input{display:none;}
	.amp-menu [id^=drop]:checked + label + ul{ display: block;}
	.amp-menu .toggle:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:#6d6a6a;top:0px;z-index:10000;line-height:1;cursor: pointer;}
    .amp-menu>li a{padding:7px;display:block;margin-bottom:1px}.amp-menu>li ul{list-style-type:none;margin:0;padding:0;position:relative}
#send_product_enquiry{background:#333;border:0;font-size:11px;padding:15px 30px;text-transform:uppercase;margin-top:-5px;letter-spacing:2px;font-weight:700;color:#fff;box-shadow:2px 3px 6px rgba(102,102,102,0.33)}
.ampforwp-form-status{margin-top:-10px;background:#FFF9C4;padding:10px 17px;margin-bottom:20px;font-size:15px;border:1px solid rgba(0,0,0,0.14)}
.amp_prod_enq_success{background:#DCEDC8}
.amp_prod_enq_error{background:#FFF9C4}
.ampwc-container{margin: 10px;padding: 0px;}.ampwc-wrapper{ width:100%;max-width:600px;margin:0 auto; position:relative;
}.gallery-big-image{position: relative;width:100%;}
.gallery-big-image .sale {background: #333 none repeat scroll 0 0;color: #fff;position: absolute;text-align: center;top: 0px;width: 55px;line-height: 1;border-radius: 30px;
    font-size: 14px;text-align: center;line-height: 49px;height: 50px;width: 50px;}
.gallery-big-image img{ width:100%; height:auto;}
.gallery-multi-images {display: inline-block;width: 100%;}
.gallery-multi-images ul{ width: 100%;  list-style-type:none;  display: inline; padding:0;}
.gallery-multi-images .small-image a{ display:block; line-height:0;}
.gallery-multi-images .small-image{ width: 23%;float: left; margin-right: 2.6%;text-align: center; margin-top: 2%;}
.gallery-multi-images li:nth-child(4n+4) .small-image{ margin-right:0px;}
.small-image amp-img:hover{border:1px solid #ccc;}
.shipping{  margin-top:20px;}
.shipping h4 {  color: #333; font-size: 28px; line-height: 1;margin: 0;text-transform: capitalize;}
.shipping h4:after{ content: ""; width: 30px; border: 1px solid #eee;display: block; margin-top: 20px;}
.star-rating, .pb-star-rating{ display: inline-block;width:35%;float:left; margin-top:17px;}
.price{width:65%; float:left; margin-top:15px;}
.price{text-align:right;float:right;}
.star-rating .star-icon, .product_tabs .star-icon, .pb-star-rating .star-icon {color: #3d7f99;font-size: 20px;position: relative;top: 0px;display: inline-block;}
.star-rating .star-icon.full:before, .product_tabs .star-icon.full:before, .pb-star-rating .star-icon.full:before {color: #02739e;content: '\2605';position: absolute;left: 0;}
.price span {  color: #333; font-size: 22px;font-weight: bold;}
.shipping .product-desc {display: inline-block;width: 100%;}
.shipping .product-desc p{font-size:16px;line-height:22px;color:#333;}
.shipping .selected-color {display: inline-block;margin-top: 5px;position: relative;width: 100%;margin-bottom: 3px;}
.shipping .selected-options{  float:left;width:75%;}
.shipping .selected-color > span {color: #333;font-size: 13px;font-weight: bold;float: left;width: 25%; margin-top: 6px; text-transform: capitalize;}
.shipping .selected-options select, .selected-options select { border: 1px solid #ccc;font-size: 13px;border-radius: 2px;width: 100%;padding: 4px;color: #111;background: #f2f2f2;}
.shipping .clear-field{position: absolute;right:1px;left:auto;top:-27px;bottom:auto;}
.shipping .clear-field > a {font-size: 11px;line-height: 16px;text-decoration: none;text-transform: uppercase;color:#bfbfbf;}
.add-tocart-field{width:100%;display:inline-block;clear:both;border-top:1px dashed #ccc;margin-bottom:15px; margin-top: 8px;padding-top:15px;
  }
.total-price, .addtional-field{display:inline-block;width:auto; vertical-align:middle;
}
.cart-field{float:right;}
.total-price{ margin-right:10px;}
.addtional-field{border:1px solid #ccc;margin-right:10px;}
.addtional-field span{padding: 5px 10px; display:inline-block;color:#595959;}
.addtional-field span {border-right: 1px solid #ccc;text-align: center;vertical-align: middle;float:left;}
.addtional-field .addi{border:none;}
.addtional-field .subb, .addtional-field .addi{ background: #f2f2f2;}
.addtional-field .numb {padding: 5px 13px;color:#595959;}
.total-price span {color: #000; font-size: 18px;font-weight: bold;}
.cart-field input,
#sortingbutton,
.cart-field a {   
    background-color:rgba(51,51,51,1);
           color:rgba(255,255,255,1);
        font-size: 12px;
    font-weight: bold;
    padding: 11px 13px 10px 13px;
    text-transform: uppercase;
    border: 0;
    border-radius: 2px;
    line-height: 1;
}
.amp_wc_cart_success_cart_cat a{     background-color:rgba(51,51,51,1);
           color:rgba(255,255,255,1);
        display: table;
    text-transform: uppercase;
    border-radius: 2px;
    font-size: 12px;
    padding: 11px 13px 10px 13px; 
    float:right;
    margin-top:10px;
  } 
.add_to_cart_form_error{
  background:#eee;
  font-size:14px;
  line-height:1.4;
  color:#333;
  padding: 10px;
}
form.amp-form-submit-success .ampstart-btn{
  display: none
}
.sku, .categories-list, .tags-list{border-top: 1px dotted #ddd;display: inline-block;padding: 6px 0;width: 100%;font-size: 12px;color: #333;} 
.categories-list span, .tags-list span{text-transform:capitalize}
.categories-list ul, .tags-list ul{margin:0;padding-left:0;display:inline-block;}
.categories-list ul span:after, .tags-list ul span:after{content: ', ';} 
.categories-list ul span:last-child:after, .tags-list ul span:last-child:after{content: '';} 
.product_tabs {margin: 0px 0;width: 100%;display: inline-block;}
.product_tabs h5 {  font-size: 14px;  font-weight: bold;  margin: 0;  padding-top: 5px;  text-transform: uppercase;  text-align:left;}
amp-selector [option]{    cursor: pointer;    color: #fff;    background: #333;}
.product_tabs span {    display: block;    font-size: 14px;}
.tabButton.h4.ampstart-nav-item {  width: 100%;  display: block;}
.related-products {width:100%;  display:inline-block;  padding-top:15px;  border-top:1px solid #ccc;}
.related-products h3 {font-size: 16px;margin: 0;padding-bottom: 10px;color: #333;}
.prodcuts-list, .bundled_product{line-height:1;width: 45%;margin:0 2%;margin-bottom: 20px;vertical-align: top;display: inline-block;}
}
.product-image, .prod_cat_mod{width:100%;display:inline-block;}
.product-image a {display: block;line-height: 0;}
.product-details .category-title ul, .category-title-pb ul{
  margin:0; padding-left:0px;}
.product-details .category-title ul li, .category-title-pb ul li{
  list-style:none;display:inline-block;line-height:0;}
.product-details .category-title ul li a, .category-title-pb ul li a{font-size:11px;line-height:16px;color:#bfbfbf;text-transform: uppercase;}
.product-details .category-title ul li a:after, .category-title-pb ul li a:after {
    content: "/"; padding: 0 4px 0 4px;}
.product-details .category-title ul li:last-child a:after, .category-title-pb ul li:last-child a:after{display:none;}
.product-details .product-title, .product-pb-title {font-size: 14px;font-weight: bold;margin: 4px 0px 3px 0px;display: inline-block;}
.prodcuts-list .star-rating .star-icon, .pb-star-rating .star-icon{
    font-size: 11px;margin: 6px 0px 6px 0px;}
.prodcuts-list .star-rating, .prodcuts-list .price, .pb-star-rating, .pb-product-price{
  display: inline-block;float: none; width: 100%; margin:0;}
.prodcuts-list .price, .pb-product-price, .bundled_product_optional_checkbox .price {
    text-align: left;}
.prodcuts-list .price span, .pb-product-price span, .bundled_product_optional_checkbox .price span { font-size: 13px;font-weight: normal;
    color: #444;}

/* Tab */
.ampTabContainer { display: flex;flex-wrap: wrap;}
.tabButton {list-style: none;color:#333;padding: 11px 14px;outline: none;border-top:1px solid #fff;background:#f1f1f1;}
amp-selector [option][selected] {outline: #fff;background:#333;color:#fff;}
.tabContent {line-height: 1.3rem;display: none;width: 100%;padding: 10px 8px 7px 8px;color: #333;font-size: 14px;border: 1px solid #e6e6e6;}
.tabContent p{margin:0 0 10px 0;}
.tabButton[selected]+.tabContent { display: block;}

.items, amp-list.items > div {justify-content: flex-start;}
.close-gallery-button {z-index: 1;position: absolute;right: 0;}
.small_gallery ul {clear: both;}
.small_gallery li {float: left; }
/*********************************/
.show{ display: block;} 
.fadeIn {animation-duration: 1s;animation-fill-mode: both; animation-name: fadeIn;}
.hide{display:none;}
.amp-wc_accordion{background-color: white;}
amp-accordion>section[expanded]>:nth-child(n){background: white;}
amp-accordion>section[expanded] li a{  padding-left:0px;  font-size: 12px;}
/* Reviews Start */
#ampwc_reviews .reviews-content p {  font-size: 14px;margin-top: 5px;}
#ampwc_reviews .star-rating span{font-size:14px;margin-top:6px;}
.comment-body .star-rating{float: right; width: auto; margin-top: 9px;}
.comment-metadata amp-img{border-radius:40px;float:left;margin-right:8px;}
.comment-metadata .comment-edit-link{margin-left: 5px;}
/* Reviews End */

/* Notifications Start */
.amp_wc_cart_success{font-size: 13px;
      background-color:rgba(76,175,80,1);
        color: #fff; padding: 11px;text-align: center;}
.amp_wc_cart_success a{display: table;margin: 7px auto 2px auto;background: #fff;color: #2E7D32;text-transform: uppercase;border-radius: 2px;padding: 6px 12px 5px 12px;font-size: 12px;box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);}
/* Notifications End */
template {display:none;}
#add_to_cart_error {-webkit-animation: cssAnimation 5s forwards;animation: cssAnimation 5s forwards;}
@keyframes cssAnimation {
    0%   {opacity: 1;}
    90%  {opacity: 1;}
    100% {opacity: 0;}
}
@-webkit-keyframes cssAnimation {
    0%   {opacity: 1;}
    90%  {opacity: 1;}
    100% {opacity: 0;}
}
.remove-from-cart-button{position: absolute;right: 0;}
.remove-from-cart-button a{color: #fff;background: #333;border-radius: 40px;font-size: 14px;font-family: sans-serif;display: inline-block;padding: 0px 10px 2px 10px;}
.cart_wrapper amp-img{margin:0}
.cart_item{position:relative; font-size:13px;
    margin-bottom: 25px;}
.product-thumbnail{text-align:center;margin-bottom:5px;}
.cart_list_item, dl.variation {clear: both;display: inline-block;width: 100%;border-bottom: 1px solid #eee;line-height: 1;padding: 1px 0px 11px 0px;}
dl.variation{margin-top:0;}
dt {display: inline-block;}
dd {display: inline-block;float: right;}
.the_content dd p{margin-bottom:unset;}
.product-addon{margin-bottom: 10px;margin-top: 10px;}
.product-addon h3{margin-top: 5px;}
.product-addon p{font-family: arial,helvetica,sans-serif;font-size: 14px;padding: 5px 0 5px 0px;}
.cart_list_item_l { float: left;}
.cart_list_item_r {float: right;}
.cart_totals h3{font-size: 22px;text-align: center;}
.cart_totals table {border-spacing: 0;font-size: 16px;color: #333;width: 100%;border: 1px solid #eee;border-radius: 4px;background: #fff;box-shadow: 0 1px 2px 0 white;-webkit-box-shadow: 0 1px 2px 0 white;border-collapse: separate;margin-bottom: 1.5em;}
.cart_totals tbody {width: 100%;display: inline-table;}
.cart_totals table td{text-align:left;border:0; background:#fff;border-bottom: 1px solid #eee;}
.cart_totals table tbody th {text-align:right;background: #fafafa;border:0;border-bottom: 1px solid #eee;}
.cart_totals table td, .cart_totals table th {padding: .857em 1.387em;width: 50%;border-left: 1px solid #eee;vertical-align: top;}
.checkout_button,.coupon .button {display: table;background: #333;padding: 10px 20px; margin: 0 auto;color: #fff;border-radius: 2px;}
.coupon .button{ display: inline-block; border:0; margin-top: 5px; margin-left: 5px;}
input#coupon_code{color: #111;width: 240px;padding: 10px 9px;border-radius: 2px;border: 1px solid #ccc;font-size: 14px;}
.tax-price span{font-size:12px;}
.stock-status span{font-size:12px;}
.product-list-wrapper{display: inline-block; width: 100%;}
.german-market span {font-size: 12px;font-weight: normal;}
.ampforwp_wcp_social{margin:10px 0;}
body .ampwc-container{margin:0px 3px 0px 3px; padding: 0;}

/*v2 ends*/
body .product-single{ margin: 15px 11px 10px 11px;}
.comments_list ul{list-style-type: none;padding-left: 5px;}

/** Shortcode CSS **/
.woocommerce .products{padding:0;width: 100%;flex-wrap: wrap;display: flex;}
.woocommerce .products li{margin-left: 0;margin-bottom: 25px;justify-content: space-between;display: flex;flex-direction: column;flex-basis: 50%;max-width: 40%;padding-left: 14px;padding-right: 14px;}
.woocommerce .products .onsale, .woocommerce .products .add_to_cart_button{
  display:none;}
.woocommerce .products li a amp-img{max-width:100%;}
.woocommerce .products .price{width:100%;text-align:left;margin-top:5px;}
.woocommerce .products .woocommerce-loop-product__title {font-size: 14px;font-weight: bold;margin: 4px 0px 3px 0px;display: inline-block;}
.woocommerce .products .woocommerce-Price-amount.amount, .woocommerce .products .woocommerce-Price-currencySymbol{display:inline-block; font-size: 13px; font-weight: normal; color: #444;}
.woocommerce .products del .woocommerce-Price-amount.amount, .woocommerce .products del .woocommerce-Price-currencySymbol{text-decoration: line-through;}
.woocommerce .products ins .woocommerce-Price-amount.amount, .woocommerce .products ins .woocommerce-Price-currencySymbol{text-decoration: underline;}
.img_prev {
    background: rgba(0,0,0,0.5);font-size: 17px;font-weight: normal;line-height: 1;color: rgba(255, 255, 255, 0.7);height: 35px;cursor: pointer;text-align: center;font-family: helvatica, sans-serif;padding: 10px 5px 0px 7px;width: 35px;top: 68px;position: absolute;
    left: 10px;z-index: 1;box-sizing: border-box;border-radius: 25px;
}
.img_next {
    background: rgba(0,0,0,0.5);font-size: 17px;font-weight: normal;line-height: 1;color: rgba(255, 255, 255, 0.7);height: 35px;cursor: pointer;text-align: center;font-family: helvatica, sans-serif;padding: 10px 5px 0px 7px;width: 35px;top: 68px;position: absolute;right: 10px;z-index: 1;box-sizing: border-box;border-radius: 25px;
}
li.item-cat.item-custom-post-type-product:after {
    content: "\e315";display: inline-block; color: #bdbdbd;font-family: 'icomoon';padding-left: 5px;font-size: 12px;position: relative;top: 1px;} 
.swt-theme {
   margin: 30px 0px 30px;
  display: inline-block;
 }
#reviews .product-rating,#reviews .contributions-title, #reviews .contributions-form-title, #reviews .contribution-type-selector, #reviews .vote-count,#reviews .notifications, #reviews .edit-comment {display:none;} 
#reviews amp-img{height: auto;max-width: 100%;}
#reviews .contributions-container .commentlist{
list-style:none;
}
#reviews .contributions-container .commentlist .comment-text{margin: 0px 25px 0 -25px; border: 1px solid #e4e1e3; border-radius: 4px; padding: 1em 1em 0;}
#reviews .woocommerce .star-rating::before{content: '\73\73\73\73\73';color: #d3ced2;float: left;top: 0;left: 0;position: absolute;}
#reviews p.meta{display:inline-flex;}
#reviews .star-rating{display:none;}
#reviews span{font-weight:bold;}
.bundled_product_images a, .bundled_product_title_link a { background-color: unset; }
.ampforwp_wc_bundle_field {position: absolute; top: auto; right: auto; left: 0; bottom: 0;}
.amp_wc_bundle_btn {float: right;} .bundled_product_excerpt{ display:none; } .bundled_item_after_cart_details{display:none;} .woocs_price_info ul li { list-style:none;}
.bundled_product .details h4 {font-size: 20px;} .bundled_item_cart_details {display: inline-block;margin-top: 8px;}

.voucher-fields .voucher-image-options { display:none; }
.form-row{ margin-top: 12px; }
.input-text { width: 100%; margin-top: 6px; }

.amp_wc_error{  color: red;}
.amp_wc_success{  color: green;}

/* Login page css */
.login-title{font-size: 26px;font-weight: lighter;color: #484c51;margin-bottom: 15px;}
.woocommerce-form-login label{font-size: 14px;color: #333;line-height: 1.4;letter-spacing: 0.5px;}
.woocommerce-form-login input{padding: 15px 10px;background-color: #f2f2f2;color: #43454b;outline: 0;border: 0;box-sizing: border-box;font-weight: 400;margin:0;box-shadow: inset 0 1px 1px rgba(0,0,0,.125);}
.woocommerce-form p{ margin-bottom:15px;}
.required{color:red;}
.woocommerce-Button{background-color: #818181;border: none;color: #ffffff;padding: 13px 19px;font-weight: 600;
    font-size: 15px;line-height: 1.2; margin-right: 10px;cursor: pointer;}
.woocommerce-form-login .woocommerce-form__input-checkbox{margin-right:7px;}
.woocommerce-LostPassword a{font-size: 14px;line-height: 1.4;color: #818181;}
/** My account page styling **/
.woocommerce-MyAccount-navigation ul li a {padding: 15px 0px;display: block;color: #818181;
    border-bottom: 1px solid #eee;font-size: 14px;line-height: 1.5;}
.woocommerce-MyAccount-navigation ul{border-top:1px solid #eee;}
.woocommerce{ margin-top: 30px;display: inline-block;width: 100%;}
.woocommerce-MyAccount-navigation {width: 17.6470588235%;float: left;margin-right: 5.8823529412%;}
.woocommerce-MyAccount-content { width: 76.4705882353%;float: right;margin-right: 0;}
.woocommerce-MyAccount-content p{font-size: 14px;margin-bottom: 17px;color: #6d6d6d;}
.woocommerce-MyAccount-content a{ color:#818181;}
@media(max-width:767px){
  .woocommerce-MyAccount-navigation, .woocommerce-MyAccount-content  { width:100%; float:none;}
}
#orderby_sorting{font-size: 12px;font-weight: bold;padding: 9px 10px 6px 12px;text-transform: uppercase;}
.amp-product-sorting form{margin:15px 0px;}
#sortingbutton{ cursor:pointer;}
.ai-align-left * {margin: 0 auto 0 0; text-align: left;}
.ai-align-right * {margin: 0 0 0 auto; text-align: right;}
.ai-center * {margin: 0 auto; text-align: center; }
		.ampforwp_wc_shortcode{margin-top: 0;padding:0;display:inline-block;width: 100%;}
		.ampforwp_wc_shortcode li{position: relative;width:29%; font-size:12px; line-height: 1; float: left;list-style-type: none;margin:2%;}
		.ampforwp_wc_shortcode .onsale{position: absolute;top: 0;right: 0;background: #ddd;padding: 7px;font-size: 12px;}
		.single-post .ampforwp_wc_shortcode li amp-img{margin:0}
		.ampforwp-wc-title{margin: 8px 0px 10px 0px;font-size: 13px;}
		.ampforwp-wc-price{color:#444}
		.wc_widgettitle{text-align:center;margin-bottom: 0px;}
		.ampforwp-wc-price, .ampforwp_wc_star_rating{float:left;margin-right: 10px;}
					.icon-widgets:before {content: "\e1bd";}.icon-search:before {content: "\e8b6";}.icon-shopping-cart:after {content: "\e8cc";}</style>
	<script custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js" async></script>
	<script custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js" async></script>
	<script custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js" async></script>
	<script custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-latest.js" async></script>
	<script custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js" async></script>
	<script custom-element="amp-selector" src="https://cdn.ampproject.org/v0/amp-selector-0.1.js" async></script>
	<script custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js" async></script>
	<?php endif ?>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Slab%3A300%2C400%2C700&#038;subset=latin%2Clatin-ext" />
    <style amp-custom>html{font-family:Georgia,'Bitstream Charter',serif;font-size:16px;font-weight:400;color:#404040}body{margin:0}article,aside,details,figcaption,figure,footer,header,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:bold}dfn{font-style:italic}h1{margin:0.67em 0;font-size:2em}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{position:relative;vertical-align:baseline;font-size:75%;line-height:0}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}amp-img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace, monospace;font-size:1em}button,input,optgroup,select,textarea{margin:0;color:inherit;font:inherit}button{overflow:visible}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{cursor:pointer;-webkit-appearance:button}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{padding:0;border:0}input{line-height:normal}input[type="checkbox"],input[type="radio"]{box-sizing:border-box;padding:0}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button{height:auto}input[type="search"]{-webkit-appearance:textfield}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}fieldset{margin:0 2px;padding:0.35em 0.625em 0.75em;border:1px solid #c0c0c0}legend{padding:0;border:0}textarea{overflow:auto}optgroup{font-weight:bold}table{border-spacing:0;border-collapse:collapse}td,th{padding:0}html{max-height:100%;height:100%;font-size:62.5%;-webkit-tap-highlight-color:rgba(0, 0, 0, 0)}body{max-height:100%;height:100%;color:#3a4145;background:#f4f8fb;letter-spacing:0.01rem;font-family:"Merriweather", serif;font-size:1.8rem;line-height:1.75em;text-rendering:geometricPrecision;-webkit-font-feature-settings:"kern" 1;-moz-font-feature-settings:"kern" 1;-o-font-feature-settings:"kern" 1}::-moz-selection{background:#d6edff}::selection{background:#d6edff}h1,h2,h3,h4,h5,h6{margin:0 0 0.3em 0;color:#2e2e2e;font-family:"Open Sans", sans-serif;line-height:1.15em;text-rendering:geometricPrecision;-webkit-font-feature-settings:"dlig" 1, "liga" 1, "lnum" 1, "kern" 1;-moz-font-feature-settings:"dlig" 1, "liga" 1, "lnum" 1, "kern" 1;-o-font-feature-settings:"dlig" 1, "liga" 1, "lnum" 1, "kern" 1}h1{text-indent:-2px;letter-spacing:-1px;font-size:2.6rem}h2{letter-spacing:0;font-size:2.4rem}h3{letter-spacing:-0.6px;font-size:2.1rem}h4{font-size:1.9rem}h5{font-size:1.8rem}h6{font-size:1.8rem}a{color:#4a4a4a}a:hover{color:#111}p,ul,ol,dl{margin:0 0 2.5rem 0;font-size:1.5rem;text-rendering:geometricPrecision;-webkit-font-feature-settings:"liga" 1, "onum" 1, "kern" 1;-moz-font-feature-settings:"liga" 1, "onum" 1, "kern" 1;-o-font-feature-settings:"liga" 1, "onum" 1, "kern" 1}ol,ul{padding-left:2em}ol ol,ul ul,ul ol,ol ul{margin:0 0 0.4em 0;padding-left:2em}dl dt{float:left;clear:left;overflow:hidden;margin-bottom:1em;width:180px;text-align:right;text-overflow:ellipsis;white-space:nowrap;font-weight:700}dl dd{margin-bottom:1em;margin-left:200px}li{margin:0.4em 0}li li{margin:0}hr{display:block;margin:1.75em 0;padding:0;height:1px;border:0;border-top:#efefef 1px solid}blockquote{box-sizing:border-box;margin:1.75em 0 1.75em 0;padding:0 0 0 1.75em;border-left:#4a4a4a 0.4em solid;-moz-box-sizing:border-box}blockquote p{margin:0.8em 0;font-style:italic}blockquote small{display:inline-block;margin:0.8em 0 0.8em 1.5em;color:#ccc;font-size:0.9em}blockquote small:before{content:"\2014 \00A0"}blockquote cite{font-weight:700}blockquote cite a{font-weight:normal}mark{background-color:#fdffb6}code,tt{padding:1px 3px;border:#e3edf3 1px solid;background:#f7fafb;border-radius:2px;white-space:pre-wrap;font-family:Inconsolata, monospace, sans-serif;font-size:0.85em;font-feature-settings:"liga" 0;-webkit-font-feature-settings:"liga" 0;-moz-font-feature-settings:"liga" 0}pre{overflow:auto;box-sizing:border-box;margin:0 0 1.75em 0;padding:10px;width:100%;border:#e3edf3 1px solid;background:#f7fafb;border-radius:3px;white-space:pre;font-family:Inconsolata, monospace, sans-serif;font-size:0.9em;-moz-box-sizing:border-box}pre code,pre tt{padding:0;border:none;background:transparent;white-space:pre-wrap;font-size:inherit}kbd{display:inline-block;margin-bottom:0.4em;padding:1px 8px;border:#ccc 1px solid;background:#f4f4f4;border-radius:4px;box-shadow:0 1px 0 rgba(0, 0, 0, 0.2), 0 1px 0 0 #fff inset;color:#666;text-shadow:#fff 0 1px 0;font-size:0.9em;font-weight:700}table{box-sizing:border-box;margin:1.75em 0;max-width:100%;width:100%;background-color:transparent;-moz-box-sizing:border-box}table th,table td{padding:8px;border-top:#efefef 1px solid;vertical-align:top;text-align:left;line-height:20px}table th{color:#000}table caption + thead tr:first-child th,table caption + thead tr:first-child td,table colgroup + thead tr:first-child th,table colgroup + thead tr:first-child td,table thead:first-child tr:first-child th,table thead:first-child tr:first-child td{border-top:0}table tbody + tbody{border-top:#efefef 2px solid}table table table{background-color:#fff}table tbody > tr:nth-child(odd) > td,table tbody > tr:nth-child(odd) > th{background-color:#f6f6f6}table.plain tbody > tr:nth-child(odd) > td,table.plain tbody > tr:nth-child(odd) > th{background:transparent}iframe,amp-iframe,.fluid-width-video-wrapper{display:block;margin:1.75em 0}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper amp-iframe{margin:0}textarea,select,input{margin:0 0 5px 0;padding:6px 9px;width:260px;outline:0;border:#e7eef2 1px solid;background:#fff;border-radius:4px;box-shadow:none;font-family:"Open Sans", sans-serif;font-size:1.6rem;line-height:1.4em;font-weight:100;-webkit-appearance:none}textarea{min-width:250px;min-height:80px;max-width:340px;width:100%;height:auto}input[type="text"]:focus,input[type="email"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="url"]:focus,input[type="password"]:focus,input[type="number"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="time"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,textarea:focus{outline:none;outline-width:0;border:#bbc7cc 1px solid;background:#fff}select{width:270px;height:30px;line-height:30px}.clearfix:before,.clearfix:after{content:" ";display:table}.clearfix:after{clear:both}.clearfix{zoom:1}.main-header{position:relative;display:table;overflow:hidden;box-sizing:border-box;width:100%;height:50px;background:#5ba4e5 no-repeat center center;background-size:cover;text-align:left;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}.content{background:#fff;padding-top:15px}.blog-title,.content{margin:auto;max-width:600px}.blog-title a{display:block;padding-right:16px;padding-left:16px;height:50px;color:#fff;text-decoration:none;font-family:"Open Sans", sans-serif;font-size:16px;line-height:50px;font-weight:600}.post{position:relative;margin-top:0;margin-right:16px;margin-left:16px;padding-bottom:0;max-width:100%;border-bottom:#ebf2f6 1px solid;word-wrap:break-word;font-size:0.95em;line-height:1.65em}.post-header{margin-bottom:1rem}.post-title{margin-bottom:0}.post-title a{text-decoration:none}.post-meta{display:block;margin:3px 0 0 0;color:#9eabb3;font-family:"Open Sans", sans-serif;font-size:1.3rem;line-height:2.2rem}.post-meta a{color:#9eabb3;text-decoration:none}.post-meta a:hover{text-decoration:underline}.post-meta .author{margin:0;font-size:1.3rem;line-height:1.3em}.post-date{display:inline-block;text-transform:uppercase;white-space:nowrap;font-size:1.2rem;line-height:1.2em}.post-image{margin:0;padding-top:3rem;padding-bottom:30px;border-top:1px #E8E8E8 solid}.post-content amp-img,.post-content amp-anim{position:relative;left:50%;display:block;padding:0;min-width:0;max-width:112%;width:calc(100% + 32px);height:auto;transform:translateX(-50%);-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%)}.footnotes{font-size:1.3rem;line-height:1.6em;font-style:italic}.footnotes li{margin:0.6rem 0}.footnotes p{margin:0}.footnotes p a:last-child{text-decoration:none}.site-footer{position:relative;margin:0 auto 20px auto;padding:1rem 15px;max-width:600px;color:rgba(0,0,0,0.5);font-family:"Open Sans", sans-serif;font-size:1.1rem;line-height:1.75em}.site-footer a{color:rgba(0,0,0,0.5);text-decoration:none;font-weight:bold}.site-footer a:hover{border-bottom:#bbc7cc 1px solid}.poweredby{display:block;float:right;width:45%;text-align:right}.copyright{display:block;float:left;width:45%}caption-text{font-size:.8125em;line-height:1.5675em;margin:14px 0;padding:0 1%}.better-amp-main-link a,.sidebar-brand,.site-header{background:#0379c4}.button.add-comment{color:#555}</style>

    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
   <?php //endif ?>
   
   <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-anim" src="https://cdn.ampproject.org/v0/amp-anim-0.1.js"></script>
	<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
	<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
	<!--<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>-->
	
	<?php if ( checkKey( $ampSettings, 'enableautoads' ) && checkKey( $ampSettings, 'adclient' ) ) : ?>
	<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
	<?php endif;?>
	
	<?php if ( checkKey( $ampSettings, 'adslot' ) ) : ?>	
	<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
	<?php endif;?>
	
	<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>
	
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>