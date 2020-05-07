<?php defined('BLUDIT') or die('Bludit CMS.');

function checkKey( $array, $key, $bool = true )
{
	if ( !empty( $array ) && isset( $array[$key] ) && !empty( $array[$key] ) )
	{
		return ( $bool ? true : $array[$key] );
	}
	
	else
	{
		return false;
	}
}

function isPage()
{
	global $url;
	
	return ( $url->parameter('page') === false ? false : true );
}

function lazyLoad( $string )
{
	$string = preg_replace("/(<img[^>]*)src=/", "$1class=\"lazyload\" data-src=", $string);
	
	$string = preg_replace("/(<iframe[^>]*)src=/", "$1class=\"lazyload\" data-src=", $string);
	
	//$string = preg_replace('~<iframe[^>]*\K(?=src)~i','data-', $string);
	
	return $string;
}

function cutBigText( $string, $length = 50 )
{
	return ( ( strlen( $string ) > $length ) ? substr( $string, 0, $length ) . "..." : $string );
	
}
function postDate()
{
	global $url, $langDetails, $page;
	
	if ( $url->notFound() || !$page )
		return false;
	
	return ( ( isset( $langDetails['dateFormat'] ) && !empty( $langDetails['dateFormat'] ) ) ? date( $langDetails['dateFormat'], strtotime( $page->dateRaw() ) ) : $page->date() );
}

function pagesList()
{
	global $pagesList;
	
	return $pagesList;
}

function disqusCode()
{
	global $langDetails;
	
	return ( ( !isset( $langDetails['disqusCode'] ) || empty( $langDetails['disqusCode'] ) ) ? false : $langDetails['disqusCode'] );
}

function siteURL()
{
	global $langDetails, $site;
	
	return ( ( isset( $langDetails['url'] ) && !empty( $langDetails['url'] ) ) ? $langDetails['url'] : $site->url() );
}

function siteName()
{
	global $langDetails, $site;
	
	return ( ( isset( $langDetails['name'] ) && !empty( $langDetails['name'] ) ) ? $langDetails['name'] : $site->title() );
}

function siteSlogan()
{
	global $langDetails, $site;
	
	return ( ( isset( $langDetails['slogan'] ) && !empty( $langDetails['slogan'] ) ) ? $langDetails['slogan'] : $site->slogan() );
}

function siteAbout()
{
	global $langDetails;
	
	return ( ( isset( $langDetails['about'] ) && !empty( $langDetails['about'] ) ) ? $langDetails['about'] : '' );
}

function authorAbout()
{
	global $langDetails;
	
	return ( ( !isset( $langDetails['authorAbout'] ) || empty( $langDetails['authorAbout'] ) ) ? false : $langDetails['authorAbout'] );
}

function themeLocale()
{
	global $langDetails;
	
	return ( ( isset( $langDetails['locale'] ) && !empty( $langDetails['locale'] ) ) ? $langDetails['locale'] : Theme::lang() );
}

function nextPrev()
{
	global $nextPrev;
	
	return $nextPrev;
}

function themeTitle()
{
	global $title;
	
	return htmlspecialchars( $title );
}

function menu()
{
	global $menu;
	
	return $menu;
}

function isCategory()
{
	global $WHERE_AM_I;
	
	return ( ( $WHERE_AM_I === "category" ) ? true : false );
}

function isPublished()
{
	global $page;
	
	return ( ( $page->type() === "published" ) ? true : false );
}

function isForum()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'forum' ) ) ? true : false );
}

function isForumCategory()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'forum' ) && !empty( $uri['categorySlug'] ) ) ? true : false );
}

function isStore()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'shop' ) ) ? true : false );
}

function isProduct()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'product' ) ) ? true : false );
}

function isThread()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'thread' ) ) ? true : false );
}

function isTopic()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'topic' ) ) ? true : false );
}

function isUser()
{
	global $uri;
	
	return ( ( !empty( $uri ) && ( $uri['postType'] == 'user' ) ) ? true : false );
}

function currentLang()
{
	global $uri;
	
	return ( ( !empty( $uri ) && !empty( $uri['lang'] ) ) ? $uri['lang'] : false );
}

function themeDescr()
{
	global $description;
	
	return htmlspecialchars( $description );
}

function tags_stop_words() 
{
    return array("a", "able", "about", "above", "abroad", "according", "accordingly",
        "across", "actually", "adj", "after", "afterwards", "again", "against", "ago",
        "ahead", "ain't", "all", "allow", "allows", "almost", "alone", "along",
        "alongside", "already", "also", "although", "always", "am", "amid", "amidst",
        "among", "amongst", "an", "and", "another", "any", "anybody", "anyhow", "anyone",
        "anything", "anyway", "anyways", "anywhere", "apart", "appear", "appreciate",
        "appropriate", "are", "aren't", "around", "as", "a's", "aside", "ask", "asking",
        "associated", "at", "available", "away", "awfully", "b", "back", "backward",
        "backwards", "be", "became", "because", "become", "becomes", "becoming", "been",
        "before", "beforehand", "begin", "behind", "being", "believe", "below", "beside",
        "besides", "best", "better", "between", "beyond", "both", "brief", "but", "by",
        "c", "came", "can", "cannot", "cant", "can't", "caption", "cause", "causes",
        "certain", "certainly", "changes", "clearly", "c'mon", "co", "co.", "com",
        "come", "comes", "concerning", "consequently", "consider", "considering",
        "contain", "containing", "contains", "corresponding", "could", "couldn't",
        "course", "c's", "currently", "d", "dare", "daren't", "definitely", "described",
        "despite", "did", "didn't", "different", "directly", "do", "does", "doesn't",
        "doing", "done", "don't", "down", "downwards", "during", "e", "each", "edu",
        "eg", "eight", "eighty", "either", "else", "elsewhere", "end", "ending",
        "enough", "entirely", "especially", "et", "etc", "even", "ever", "evermore",
        "every", "everybody", "everyone", "everything", "everywhere", "ex", "exactly",
        "example", "except", "f", "fairly", "far", "farther", "few", "fewer", "fifth",
        "first", "five", "followed", "following", "follows", "for", "forever", "former",
        "formerly", "forth", "forward", "found", "four", "from", "further",
        "furthermore", "g", "get", "gets", "getting", "given", "gives", "go", "goes",
        "going", "gone", "got", "gotten", "greetings", "h", "had", "hadn't", "half",
        "happens", "hardly", "has", "hasn't", "have", "haven't", "having", "he", "he'd",
        "he'll", "hello", "help", "hence", "her", "here", "hereafter", "hereby",
        "herein", "here's", "hereupon", "hers", "herself", "he's", "hi", "him",
        "himself", "his", "hither", "hopefully", "how", "howbeit", "however", "hundred",
        "i", "i'd", "ie", "if", "ignored", "i'll", "i'm", "immediate", "in", "inasmuch",
        "inc", "inc.", "indeed", "indicate", "indicated", "indicates", "inner", "inside",
        "insofar", "instead", "into", "inward", "is", "isn't", "it", "it'd", "it'll",
        "its", "it's", "itself", "i've", "j", "just", "k", "keep", "keeps", "kept",
        "know", "known", "knows", "l", "last", "lately", "later", "latter", "latterly",
        "least", "less", "lest", "let", "let's", "like", "liked", "likely", "likewise",
        "little", "look", "looking", "looks", "low", "lower", "ltd", "m", "made",
        "mainly", "make", "makes", "many", "may", "maybe", "mayn't", "me", "mean",
        "meantime", "meanwhile", "merely", "might", "mightn't", "mine", "minus", "miss",
        "more", "moreover", "most", "mostly", "mr", "mrs", "much", "must", "mustn't",
        "my", "myself", "n", "name", "namely", "nd", "near", "nearly", "necessary",
        "need", "needn't", "needs", "neither", "never", "neverf", "neverless",
        "nevertheless", "new", "next", "nine", "ninety", "no", "nobody", "non", "none",
        "nonetheless", "noone", "no-one", "nor", "normally", "not", "nothing",
        "notwithstanding", "novel", "now", "nowhere", "o", "obviously", "of", "off",
        "often", "oh", "ok", "okay", "old", "on", "once", "one", "ones", "one's", "only",
        "onto", "opposite", "or", "other", "others", "otherwise", "ought", "oughtn't",
        "our", "ours", "ourselves", "out", "outside", "over", "overall", "own", "p",
        "particular", "particularly", "past", "per", "perhaps", "placed", "please",
        "plus", "possible", "presumably", "probably", "provided", "provides", "q", "que",
        "quite", "qv", "r", "rather", "rd", "re", "really", "reasonably", "recent",
        "recently", "regarding", "regardless", "regards", "relatively", "respectively",
        "right", "round", "s", "said", "same", "saw", "say", "saying", "says", "second",
        "secondly", "see", "seeing", "seem", "seemed", "seeming", "seems", "seen",
        "self", "selves", "sensible", "sent", "serious", "seriously", "seven", "several",
        "shall", "shan't", "she", "she'd", "she'll", "she's", "should", "shouldn't",
        "since", "six", "so", "some", "somebody", "someday", "somehow", "someone",
        "something", "sometime", "sometimes", "somewhat", "somewhere", "soon", "sorry",
        "specified", "specify", "specifying", "still", "sub", "such", "sup", "sure", "t",
        "take", "taken", "taking", "tell", "tends", "th", "than", "thank", "thanks",
        "thanx", "that", "that'll", "thats", "that's", "that've", "the", "their",
        "theirs", "them", "themselves", "then", "thence", "there", "thereafter",
        "thereby", "there'd", "therefore", "therein", "there'll", "there're", "theres",
        "there's", "thereupon", "there've", "these", "they", "they'd", "they'll",
        "they're", "they've", "thing", "things", "think", "third", "thirty", "this",
        "thorough", "thoroughly", "those", "though", "three", "through", "throughout",
        "thru", "thus", "till", "to", "together", "too", "took", "toward", "towards",
        "tried", "tries", "truly", "try", "trying", "t's", "twice", "two", "u", "un",
        "under", "underneath", "undoing", "unfortunately", "unless", "unlike",
        "unlikely", "until", "unto", "up", "upon", "upwards", "us", "use", "used",
        "useful", "uses", "using", "usually", "v", "value", "various", "versus", "very",
        "via", "viz", "vs", "w", "want", "wants", "was", "wasn't", "way", "we", "we'd",
        "welcome", "well", "we'll", "went", "were", "we're", "weren't", "we've", "what",
        "whatever", "what'll", "what's", "what've", "when", "whence", "whenever",
        "where", "whereafter", "whereas", "whereby", "wherein", "where's", "whereupon",
        "wherever", "whether", "which", "whichever", "while", "whilst", "whither", "who",
        "who'd", "whoever", "whole", "who'll", "whom", "whomever", "who's", "whose",
        "why", "will", "willing", "wish", "with", "within", "without", "wonder", "won't",
        "would", "wouldn't", "x", "y", "yes", "yet", "you", "you'd", "you'll", "your",
        "you're", "yours", "yourself", "yourselves", "you've", "z", "zero");
}

function get_HostName ( $url )
{
	$url_details = parse_url( $url );

	$host = str_replace( 'www.', '', $url_details['host'] );
		
	return $host;
}

function replaceLinks ( $post, $url )
{
	$host = get_HostName ( $url );

	preg_match_all('/<a.+href=[\'"]([^\'"]+)[\'"].*>(.*)<\/a>/', $post, $match);
	
	if ( !empty( $match ) )
	{
		foreach ( $match['1'] as $i => $link )
		{
			$h = get_HostName ( $link );
			
			if ( $h == $host )
			{
				$post = str_replace( $match['0'][$i], $match['2'][$i], $post );
			}
		}
	}
	
	return $post;
}

function removeLinks( $post )
{
	return preg_replace('#<a.*?>(.*?)</a>#is', '\1', $post);
}
	
function returnImgName($img)
{
	$info = pathinfo( returnImgUrl( $img ) );
				
	$temp = $info['basename'];
					
	$name = ( !empty( $info['filename'] ) ? $info['filename'] : md5( $img ) ) . '.' . ( !empty( $info['extension'] ) ? $info['extension'] : 'jpg' );
	
	return $name;
}

function returnImgUrl($img)
{
	if ( strpos( $img, '?' ) !== false ) 
	{
		$img = explode('?', $img);
		$img = $img['0'];
	}
		
	return $img;
}
	
function create_image($img_link, $upload_path, $name, $thumb = '')
	{
				
		if (is_file($upload_path . $name)) {
			//echo '<strong>File</strong> "' . $name . '" already exists...<br />';
			return $name;
		}

		// try copying it... if it fails, go to backup method.
		if ( !@copy( $img_link, $upload_path . $name ) ) 
		{
			try 
			{
				//create a new image
				list($img_width, $img_height, $img_type, $img_attr) = @getimagesize($img_link);

				$image = '';

				switch ($img_type) 
				{
					case 1:
						//GIF
						$image = imagecreatefromgif($img_link);
						$ext = ".gif";
						break;
					case 2:
						//JPG
						$image = imagecreatefromjpeg($img_link);
						$ext = ".jpg";
						break;
					case 3:
						//PNG

						$image = imagecreatefrompng($img_link);
						$ext = ".png";
						break;
				}
				
				if (!empty($thumb))
				{
					$newwidth = 400;
					$newheight = 400;
				} 
				
				else
				{
					$newwidth = $img_width;
					$newheightt = $img_height;
				}

				$resource = @imagecreatetruecolor($newwidth, $newheight);
				if (function_exists('imageantialias')) 
				{
					@imageantialias($resource, true);
				}
				
				@imagecopyresampled($resource, $image, 0, 0, 0, 0, $newwidth, $newheight, $img_width,
					$img_height);

				@imagedestroy($image);
			

				switch ($img_type) 
				{
					default:
					case 1:
						//GIF
						@imagegif($resource, $upload_path . $name);
						break;
					case 2:
						//JPG
						@imagejpeg($resource, $upload_path . $name);
						break;
					case 3:
						//PNG
						@imagepng($resource, $upload_path . $name);
						break;
				}
			}
			catch (exception $e) 
			{
				//An error happenned
			}
			if ($resource === '')
				return false;
		}

		return $name;
	}
function gravatarUrl( $email )
{
	return 'https://secure.gravatar.com/avatar/' . md5( $email ) . '?s=250&d=mm&r=g';	
}

function guestNoBrowse ( $banned = false )
{
	global $L;
	
	$html = '<div class="bbp-template-notice info"><p>' . $L->get( 'forum-disabled-guests') . '</p></div>';
	
	if ( empty( $banned ) )
		$html .= loginForm ();
	
	return $html;
	
}

function currentURL()
{
	return ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
}

function reviewForm( $content, $site_url, $honeypot = false, $recaptcha = false )
{
	global $L;

	$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
	
	$html = '';
	
	$html .= '<div id="review_form_wrapper">
			<div id="review_form">
					<div id="respond" class="comment-respond">
		<span id="reply-title" class="comment-reply-title">' . $L->get( 'add-review') . ' </span>
		<form action="' . $site_url . 'add-review.php" method="post" id="commentform" class="comment-form"><p class="comment-notes"><span id="email-notes">' . $L->get( 'email-will-not-published') . '</span>  <span class="required">*</span></p><div class="comment-form-rating"><label for="rating">' . $L->get( 'your-rating') . '</label><select name="rating" id="rating" required>
						<option value="0">' . $L->get( 'rate') . '</option>
						<option value="5">' . $L->get( 'perfect') . '</option>
						<option value="4">' . $L->get( 'good') . '</option>
						<option value="3">' . $L->get( 'average') . '</option>
						<option value="2">' . $L->get( 'not-that-bad') . '</option>
						<option value="1">' . $L->get( 'very-poor') . '</option>
					</select></div><p class="comment-form-comment"><label for="comment">' . $L->get( 'your-review') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p><p class="comment-form-author"><label for="author">' . $L->get( 'name') . '&nbsp;<span class="required">*</span></label><input id="author" name="author" type="text" value="" size="30" required /></p>
					<p class="comment-form-email"><label for="email">' . $L->get( 'form-email') . '&nbsp;<span class="required">*</span></label><input id="email" name="emaillkjkl" type="email" value="" size="30" required /></p>
					<!--<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>-->';
					
					$html .= '<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="' . $L->get( 'button-submit') . '" /></p>';
				
		if ( $recaptcha )
		{
			$html .= '<p><div class="g-recaptcha" data-sitekey="' . $recaptcha . '"></div></p>' . PHP_EOL;
		}
		
		if ( $honeypot )
		{
			$html .= '<label class="ohnohoney" for="name"></label>' . PHP_EOL;
			
			$html .= '<input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">' . PHP_EOL;
			
			$html .= '<label class="ohnohoney" for="email"></label>' . PHP_EOL;
			
			$html .= '<input class="ohnohoney" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">';

		}
		
		$html .= '<input type="hidden" id="bbp_redirect_to" name="redirect_to" value="' . $fullURL . '" /><input type="hidden" id="nonce" name="nonce" value="' . generateFormHash() . '" /><input type="hidden" id="productKey" name="productKey" value="' . $content['productSef'] . '" />';
		
		
		
		$html .= '</form></div><!-- #respond --></div></div><div class="clear"></div>';
					
	return $html;
}

function threadForm( $content, $site_url, $honeypot = false, $recaptcha = false )
{
	global $L;

	$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
	
	$html = '';
	
	if ( empty( $content['currentUser']['canReply'] ) )
		return $html;
		
	$html .= '<div id="new-post"><form method="post" action="' . $site_url . 'add-thread.php' . '" class="bbp-thread-form">';
	
	$html .= '<p><label for="bbp_topic_title">' . $L->get( 'topic-title-editor') . '</label><br /><input type="text" id="bbp_title" name="title" value="" required/></p>';
	
	if ( empty( $content['currentUser']['isLogged'] ) )
	{
		$html .= '<p><label for="bbp_username">' . $L->get( 'topic-username') . '</label><br /><input type="text" id="bbp_username" name="user_id" value="" required/></p>';
		
		$html .= '<p><label for="bbp_email">' . $L->get( 'topic-email') . '</label><br /><input type="email" id="bbp_email" name="emaillkjkl" value="" required/></p>';
		
		if ( $recaptcha )
		{
			$html .= '<p><div class="g-recaptcha" data-sitekey="' . $recaptcha . '"></div></p>' . PHP_EOL;
		}
	}
	
	$html .= '<p class="comment-form-comment"><textarea id="editor" name="post" cols="45" rows="8" required></textarea></p>';
	
	//$html .= '<p><label for="bbp_topic_tags">Topic Tags:</label><br /><input type="text" value="" size="40" name="bbp_topic_tags" id="bbp_topic_tags"  /></p>';
	if ( !empty( $content['currentUser']['isAdmin'] ) || !empty( $content['currentUser']['isMod'] ) )
	{
		$html .= '<p><label for="bbp_stick_topic">Topic Type:</label><br />	
			<select name="bbp_stick_topic" id="bbp_stick_topic_select" class="bbp_dropdown">
					<option value="published">' . $L->get( 'thread-normal') . '</option>
					<option value="sticky">' . $L->get( 'thread-sticky') . '</option>
					<!--<option value="super">Super Sticky</option>-->
			</select></p>';
			
		$html .= '<p>
			<label for="bbp_topic_status">Topic Status:</label><br />
			<select name="bbp_topic_status" id="bbp_topic_status_select" class="bbp_dropdown">
					<option value="publish" selected=\'selected\'>' . $L->get( 'thread-open') . '</option>
					<option value="closed">' . $L->get( 'thread-closed') . '</option>
					<!--<option value="pending">' . $L->get( 'thread-pending') . '</option>-->
			</select>
			</p>';
	}
	
	if ( !empty( $content['lang'] ) )
		$html .= '<input type="hidden" id="bbp_lang" name="lang" value="' . $content['lang'] . '" />';
	
	//$html .= '<p><input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe"  /><label for="bbp_topic_subscription">Notify me of follow-up replies via email</label></p>';

	$html .= '<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="' . $L->get( 'button-submit') . '" /></p>';
	
	if ( !empty( $content['currentUser']['isLogged'] ) )
		$html .= '<input type="hidden" id="bbp_user_id" name="user_id" value="' . $content['currentUser']['userName'] . '" />';
	
	$html .= '<input type="hidden" id="bbp_redirect_to" name="redirect_to" value="' . $fullURL . '" /><input type="hidden" id="nonce" name="nonce" value="' . generateFormHash() . '" /><input type="hidden" id="bbp_topicPost" name="topicPost" value="' . $content['topicSef'] . '" />';
	
	if ( $honeypot )
	{
		$html .= '<label class="ohnohoney" for="name"></label>' . PHP_EOL;
		
		$html .= '<input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">' . PHP_EOL;
		
		$html .= '<label class="ohnohoney" for="email"></label>' . PHP_EOL;
		
		$html .= '<input class="ohnohoney" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">';

	}
		
	$html .= '</form></div><!-- #respond --><div class="clear"></div>';

	if ( $content['allowFormatting'] )
	{
		$html .= formatForm();
	}
				
	return $html;
}

function commentForm( $content, $site_url, $honeypot = false, $recaptcha = false )
{
	global $L;
	
	$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
		
	$html = '<div id="new-post">
				<form method="post" action="' . $site_url . 'add-comment.php' . '" class="bbp-post-form"><p class="comment-form-comment"><textarea id="editor" name="post" cols="45" rows="8" required></textarea></p>';
	
	if ( $honeypot )
	{
		$html .= '<label class="ohnohoney" for="name"></label>' . PHP_EOL;
		
		$html .= '<input class="ohnohoney" autocomplete="off" type="text" id="name" name="name" placeholder="Your name here">' . PHP_EOL;
		
		$html .= '<label class="ohnohoney" for="email"></label>' . PHP_EOL;
		
		$html .= '<input class="ohnohoney" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail here">';

	}
	
	if ( empty( $content['currentUser']['isLogged'] ) && $recaptcha )
	{
		$html .= '<p><div class="g-recaptcha" data-sitekey="' . $recaptcha . '"></div></p>' . PHP_EOL;
	}
	
	$html .= '<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="' . $L->get( 'button-submit') . '" /></p><input type="hidden" id="bbp_user_id" name="user_id" value="' . $content['currentUser']['userName'] . '" /><input type="hidden" id="bbp_redirect_to" name="redirect_to" value="' . $fullURL . '" /><input type="hidden" id="nonce" name="nonce" value="' . generateFormHash() . '" /><input type="hidden" id="bbp_title" name="title" value="RE:' . htmlspecialchars( $content['topicTitle'] ) . '" /><input type="hidden" id="bbp_topicPost" name="topicPost" value="' . $content['topicSef'] . '" />';
				
	$html .= '</form></div><!-- #respond --><div class="clear"></div>';
				
	
		
	if ( $content['allowFormatting'] )
	{
		$html .= formatForm();
	}
				
	return $html;
}

function formatForm()
{
	$html = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/ui/trumbowyg.min.css">';
			
	$html .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/plugins/emoji/ui/trumbowyg.emoji.min.css">';
			
	$html .= '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
			
	$html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js"></script>';
			
	$html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/plugins/emoji/trumbowyg.emoji.min.js"></script>';

	$html .= '<script>
			$(\'#editor\').trumbowyg({
			btns: [
				[\'strong\', \'em\'],
				[\'emoji\'],
				[\'justifyLeft\', \'justifyCenter\'],
				[\'insertImage\', \'link\']
			]
			});
			</script>';
			
				
	return $html;
	
}

function niceTime( $time ) 
{
	global $L;
	
	$delta = time() - $time;
	
	if ($delta < 60)
		return $L->get( 'time-less-minute');
	
	elseif ($delta < 120)
		return $L->get( 'time-about-minute');
	
	elseif ($delta < (45 * 60))
		return floor($delta / 60) . ' ' . $L->get( 'time-minutes-ago');//minutes ago.';
	
	elseif ($delta < (90 * 60))
		return $L->get( 'time-hour-ago');
	
	elseif ($delta < (24 * 60 * 60))
		return $L->get( 'time-about') . ' ' . floor($delta / 3600) . ' ' . $L->get( 'time-hours-ago');
	
	elseif ($delta < (48 * 60 * 60))
		return $L->get( 'time-day-ago');
	
	elseif ($delta < (7 * 24 * 60 * 60))
		return floor($delta / 86400) . ' ' . $L->get( 'time-days-ago');
		
	elseif ($delta < (31 * 24 * 60 * 60))
		return floor($delta / 604800) . ' ' . ( ( floor($delta / 604800) > 1 ) ? $L->get( 'time-weeks') : $L->get( 'time-week') ) . ' ' . $L->get( 'time-ago');
	
	elseif( ($delta > ( 30 * 24 * 60 * 60 ) ) && ( $delta < ( 13 * 30 * 24 * 60 * 60 ) ) )
		return floor($delta / 2592000) . ' ' . ( ( floor($delta / 2592000) > 1 ) ? $L->get( 'time-months') : $L->get( 'time-month') ) . ' ' . $L->get( 'time-ago');
	
	else
		return floor($delta / 31104000) . ' ' . ( ( floor($delta / 31104000) > 1 ) ? $L->get( 'time-years') : $L->get( 'time-year') ) . ' ' . $L->get( 'time-ago');
}
	
function getUserDetails( $dateFormat )
{
		
	$user = array(
				'isAdmin' => false,
				'isMod' => false,
				'isLogged' => false,
				'userName' => '',
				'nickName' => '',
				'email' => '',
				'registered' => time()//The current time to avoid any errors
			);
										
	$login = new Login();print_r($login);

	if ( $login->isLogged() ) 
	{
		$userName = $login->username();
						
		$user = new User( $userName );

		$role = $user->role();
							
		$isAdmin = ( ( $role == 'admin' ) ? true : false );
							
		$isMod = ( $isAdmin ? true : false );//Change that
							
		$email = $user->email();
							
		$userRegistered = @date ( $dateFormat, strtotime( $user->registered() ) );
			
		$user = array(
				'isAdmin' => $isAdmin,
				'isMod' => $isMod,
				'isLogged' => true,
				'userName' => $userName,
				'nickName' => $user->nickname(),
				'email' => $user->email(),
				'registered' => $userRegistered
			);
	}
		
	return $user;
}
	
function noReply( $content )
{
	global $L;
		
	$html = '<div id="no-reply-' . $content['topicID'] . '" class="bbp-no-reply">
				<div class="bbp-template-notice">
					<ul>
						<li>' . $L->get( 'thread-locked' ) . '</li>
					</ul>
				</div>
			</div>';
				
	return $html;
}

function loginForm ()
{
	$fullURL = ( ( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' ) ) ? 'https' : 'http' ) . '://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
	
	$html = '<form method="post" action="" onSubmit="return false;" class="bbp-login-form">
				<fieldset class="bbp-form">
								<legend>Log In</legend>
								<div class="bbp-username">
									<label for="user_login">Username: </label>
									<input type="text" name="log" value="" size="20" maxlength="100" id="user_login" autocomplete="off" />
								</div>

								<div class="bbp-password">
									<label for="user_pass">Password: </label>
									<input type="password" name="pwd" value="" size="20" id="user_pass" autocomplete="off" />
								</div>

								<div class="bbp-remember-me">
									<input type="checkbox" name="rememberme" value="forever"  id="rememberme" />
									<label for="rememberme">Keep me signed in</label>
								</div>

								
								<div class="bbp-submit-wrapper">

									<button type="submit" name="user-submit" id="user-submit" class="button submit user-submit">Log In</button>

								<input type="hidden" id="bbp_redirect_to" name="redirect_to" value="' . $fullURL . '" />
								<input type="hidden" id="nonce" name="nonce" value="152c288158" />
								</div>
							</fieldset>
						</form>';
	return $html;	
}

function guestForm ( $content )
{
	global $L;
	
	$html = '<div id="no-reply-' . ( isset( $content['topicID']  ) ? $content['topicID'] : 0 ) . '" class="bbp-no-reply">
				<div class="bbp-template-notice">
					<ul>
						<li>' . $L->get( 'thread-no-guest' ) . '</li>
					</ul>
				</div>';
				
	$html .= loginForm ();
	
	$html .= '</div>';
	/*
	'<form method="post" action="" onSubmit="return false;" class="bbp-login-form">
				<fieldset class="bbp-form">
								<legend>Log In</legend>
								<div class="bbp-username">
									<label for="user_login">Username: </label>
									<input type="text" name="log" value="" size="20" maxlength="100" id="user_login" autocomplete="off" />
								</div>

								<div class="bbp-password">
									<label for="user_pass">Password: </label>
									<input type="password" name="pwd" value="" size="20" id="user_pass" autocomplete="off" />
								</div>

								<div class="bbp-remember-me">
									<input type="checkbox" name="rememberme" value="forever"  id="rememberme" />
									<label for="rememberme">Keep me signed in</label>
								</div>

								
								<div class="bbp-submit-wrapper">

									<button type="submit" name="user-submit" id="user-submit" class="button submit user-submit">Log In</button>

								<input type="hidden" id="bbp_redirect_to" name="redirect_to" value="' . $fullURL . '" />
								<input type="hidden" id="nonce" name="nonce" value="152c288158" />
								</div>
							</fieldset>
						</form>
				</div>';*/
	return $html;
}

function sanitize( $string ) 
{
	return filter_var ( $string, FILTER_SANITIZE_STRING );
}

function sanitizeEmail( $email )
{
	return filter_var( $email, FILTER_SANITIZE_EMAIL );
}

function validateEmail( $email )
{

	$sanitizeEmail = sanitizeEmail( $email );
	
	$validateEmail = filter_var( $email, FILTER_VALIDATE_EMAIL );

	return ( ( $validateEmail && ( $sanitizeEmail === $email ) ) ? true : false );
}
	
function generateFormHash()
{
	if ( !Session::started() ) 
	{
		Session::start();
	}
		
	$token = sha1( uniqid() . time() );
		
	Session::set('token_CSRF', $token);
		
	return $token;
}

function checkFormHash( $token )
{
	if ( !Session::started() ) 
	{
		Session::start();
	}
		
	$sessionToken = Session::get( 'token_CSRF' );

	return ( !empty( $sessionToken ) && ( $sessionToken === $token ) );
}
	
function lazyIframe ( $t = 2, $r = false )
{
	$gl_video_width = 604;
	$gl_video_height = 505;
	
	if ( $r )
		$t = preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"$2",
		$t );
	
	$lazyIframe = '<div class="flex-video"><iframe
					  width="100%"
					  height="' . $gl_video_height . '"
					  src="https://www.youtube.com/embed/$t"					  srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube.com/embed/$t?autoplay=1><img src=https://img.youtube.com/vi/$t/hqdefault.jpg alt=\'Youtube Video\'><span>▶</span></a>"
					  frameborder="0"
					  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
					  allowfullscreen
					  title="Youtube Video"
					></iframe></div>';

					
	return $lazyIframe;
}

function generateDescr ($string, $length = 150 ) 
{
	$short_desc = trim(str_replace(array("\r", "\n", '"', "\t"), ' ', strip_tags($string)));

	// Cut the string to the requested length, and strip any extraneous spaces
	// from the beginning and end.
	$desc = trim(substr($short_desc, 0, $length));

	// Send the new description back.
	return $desc;
}

function generate_key( $length = 10 ) 
{
	return substr(str_shuffle('qwertyuiopasdfghjklmnbvcxz'), 0, $length);
}

function generateMixed( $length = 10 ) 
{
	return substr(str_shuffle('0123456789qwertyuiopasdfghjklmnbvcxz'), 0, $length);
}

function urlToEmbed( $post )
{
	$gl_video_width = 604;
	$gl_video_height = 505;
			
	preg_match_all('/<a href=\"(.*)\">(.*)<\/a>/', $post, $out);
	
	$links = $out['1'];
	
	//Lazy Load for YouTube Only
	$lazyIframe = '<iframe
					  width="100%"
					  height="' . $gl_video_height . '"
					  src="https://www.youtube.com/embed/$2"					  srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=\'https://www.youtube.com/embed/$2?autoplay=1\'><img src=\'https://img.youtube.com/vi/$2/hqdefault.jpg\' alt=\'Youtube Video\'><span>▶</span></a>"
					  frameborder="0"
					  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
					  allowfullscreen
					  title="Youtube Video"
					></iframe>';
	
	//Lazy Load for YouTube Only
	$lazyIframe2 = '<iframe
					  width="100%"
					  height="' . $gl_video_height . '"
					  src="$3"					  srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=\'$3\'><img src=\'$2\' alt=\'Youtube Video\'><span>▶</span></a>"
					  frameborder="0"
					  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
					  allowfullscreen
					  title="Youtube Video"
					></iframe>';
	
	if ( !empty( $links ) )
	{
		foreach ($links as $link) 
		{
			$start = 0;
			$end = 0;
				
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $link, $output)) 
			{
				
				$yt_ID = $output['1'];
				$yt_URL = 'https://' . $output['0'];
				
				if (preg_match("/start=([0-9]+)/", $link, $un))
					$start = $un['1'];
				
				if (preg_match("/end=([0-9]+)/", $link, $un))
					$end = $un['1'];
				
				$wto = '<iframe src="https://www.youtube.com/embed/' . $yt_ID . '?version=3&amp;rel=1&amp;fs=1&amp;autohide=2&amp;showsearch=0&amp;showinfo=1&amp;iv_load_policy=1';
				
				if (!empty($start))
					$wto .= '&amp;start=' . $start;
				
				if (!empty($end))
					$wto .= '&amp;end=' . $end;
				
				$wto .= '&amp;wmode=transparent" allowfullscreen="true" allow="autoplay; encrypted-media" title="YouTube Video" width="100%" height="600"></iframe>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $wto, $post);
			}
			
			if (preg_match("/dailymotion/", $link)) {
				
				preg_match("/\/video\/(.+)/",$link, $matches);
				preg_match("/video\/([^_]+)/", $link, $matche);
				
				$yt_id = (!empty($matche[1])) ? $matche[1] : $matches[1];
				
				$embed = '<div class="flex-video"><iframe frameborder="0" width="100%" height="404" src="//www.dailymotion.com/embed/video/' . $yt_id . '" allowfullscreen></iframe></div>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
			}
			
			if ( preg_match('#https?://(player\.)?vimeo\.com(/video)?/(\d+)#i', $link, $matches) ) {
							
				$yt_id = trim($matches[3]);
							
				$embed = '<div class="flex-video"><iframe src="https://player.vimeo.com/video/' . $yt_id . '" width="100%" height="404" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
			}
			
			if (preg_match("/facebook.com\/(.*?)/", $link) || (preg_match('/facebook\.com/i', $link))) {
				
				//preg_match('#https?://(www\.)?facebook\.com(/videos)?/(\d+)#i', $link, $matches);
							
				$embed = '<div class="flex-video"><iframe src="https://www.facebook.com/plugins/video.php?href=' . urlencode( $link ) . '&show_text=0&width=367" width="100%" height="404" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe></div>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
			}
			
			if ( preg_match('/https?:\/\/twitter\.com\/(?:\#!\/)?(\w+)\/status(es)?\/(\d+)/i', $link, $matches ) ) 
			{
								
				$status_id = $matches[3];
								
				$uri = 'https://api.twitter.com/1/statuses/oembed.json?id=' . $status_id . '&omit_script=true';
				
				$source = curl_url( $uri ); //getting the file content
				
				if ( ( $source !== false ) && ( !empty( $source['data'] ) ) ) 
				{
				
					$decode = json_decode($source['data'], true); //getting the file content as array
				
					//$author_name = $decode['author_name'];
				
					$embed = $decode['html'] . PHP_EOL;
					$embed .= '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
				
					unset( $source, $decode );
				
					$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
				}
				
			}
			
		}
		
	}
		
	//Maybe the post doesn't has any URL links. For now, search only for youtube URLs
	$post = preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"$lazyIframe",
		$post );
		
	//Convert youtube embed code from Blogger
	$pat = '/(<div class=\"separator\" style=\"clear: both; text-align: center;\">)?<iframe.+data-thumbnail-src=[\'"]([^\'"]+)[\'"].+src=[\'"]([^\'"]+)[\'"].*><\/iframe>(<\/div>)?/';
	
	$post = preg_replace($pat, $lazyIframe2, $post );
		
	return $post;
}
	
	
	
function ampEmbed( $post ) 
{
						
	$gl_video_width = 604;
	$gl_video_height = 505;
			
	preg_match_all('/<a href=\"(.*)\">(.*)<\/a>/', $post, $out);
	
	$links = $out['1'];
		
	foreach ($links as $link) 
	{
		$start = 0;
		$end = 0;
				
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $link, $output)) 
		{
				
			$yt_ID = $output['1'];
			$yt_URL = 'https://' . $output['0'];
				
			if (preg_match("/start=([0-9]+)/", $link, $un)) {
				$start = $un['1'];
				
				if (preg_match("/end=([0-9]+)/", $link, $un))
					$end = $un['1'];
					
				$wto = '<amp-iframe width="480" height="270"' . PHP_EOL;
				$wto .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
				$wto .= 'layout="responsive"' . PHP_EOL;
				$wto .= 'frameborder="0"' . PHP_EOL;
				$wto .= 'src="https://www.youtube.com/embed/' . $yt_ID . '?start=' . $start . '&end=' . $end . '">' . PHP_EOL;
				$wto .= '<amp-img layout="fill" src="https://thumb.ibb.co/egxDsn/youtube_logo_081217_616x440.jpg" placeholder></amp-img>' . PHP_EOL;
				$wto .= '</amp-iframe>';
				
			} else 
			{
							
				$wto = '<amp-youtube width="480"' . PHP_EOL;
				$wto .= 'height="270"' . PHP_EOL;
				$wto .= 'layout="responsive"' . PHP_EOL;
				$wto .= 'data-videoid="' . $yt_ID . '">' . PHP_EOL;
				$wto .= '</amp-youtube>';
			}
		
			$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $wto, $post);
		}
			
			if (preg_match("/dailymotion/", $link)) {
				
				preg_match("/\/video\/(.+)/",$link, $matches);
				preg_match("/video\/([^_]+)/", $link, $matche);
				
				$yt_id = (!empty($matche[1])) ? $matche[1] : $matches[1];
				
				$embed = '<amp-iframe width="480" height="270"' . PHP_EOL;
				$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
				$embed .= 'layout="responsive"' . PHP_EOL;
				$embed .= 'frameborder="0"' . PHP_EOL;
				$embed .= 'src="//www.dailymotion.com/embed/video/' . $yt_id . '">' . PHP_EOL;
				//$embed .= '<amp-img layout="fill" src="https://thumb.ibb.co/egxDsn/youtube_logo_081217_616x440.jpg" placeholder></amp-img>' . PHP_EOL;
				$embed .= '</amp-iframe>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
				
			}
			
			if ( preg_match('#https?://(player\.)?vimeo\.com(/video)?/(\d+)#i', $link, $matches) ) {
							
				$yt_id = trim($matches[3]);
				
				$embed = '<amp-iframe width="480" height="270"' . PHP_EOL;
				$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
				$embed .= 'layout="responsive"' . PHP_EOL;
				$embed .= 'frameborder="0"' . PHP_EOL;
				$embed .= 'src="https://player.vimeo.com/video/' . $yt_id . '">' . PHP_EOL;
				//$embed .= '<amp-img layout="fill" src="https://thumb.ibb.co/egxDsn/youtube_logo_081217_616x440.jpg" placeholder></amp-img>' . PHP_EOL;
				$embed .= '</amp-iframe>';
							
				$embed = '<div class="flex-video"><iframe src="https://player.vimeo.com/video/' . $yt_id . '" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
				
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
			}
			
			if (preg_match("/facebook.com\/(.*?)/", $link) || (preg_match('/facebook\.com/i', $link))) {
				
				//preg_match('#https?://(www\.)?facebook\.com(/videos)?/(\d+)#i', $link, $matches);
				
				$embed = '<amp-iframe width="480" height="270"' . PHP_EOL;
				$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
				$embed .= 'layout="responsive"' . PHP_EOL;
				$embed .= 'frameborder="0"' . PHP_EOL;
				$embed .= 'src="https://www.facebook.com/plugins/video.php?href=' . urlencode( $link ) . '&show_text=0&width=367">' . PHP_EOL;
				//$embed .= '<amp-img layout="fill" src="https://thumb.ibb.co/egxDsn/youtube_logo_081217_616x440.jpg" placeholder></amp-img>' . PHP_EOL;
				$embed .= '</amp-iframe>';
											
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
			}
			
			if ( preg_match('#^https?://twitter\.com/(?:\#!/)?(\w+)/status(es)?/(\d+)$#i', $link, $matches ) ) {
								
				$status_id = $matches[3];
				
				$embed = '<amp-twitter width="375"' . PHP_EOL;
				$embed .= 'height="472"' . PHP_EOL;
				$embed .= 'layout="responsive"' . PHP_EOL;
				$embed .= 'data-tweetid="' . $status_id . '">' . PHP_EOL;
				$embed .= '</amp-twitter>';
							
				$post = str_replace('<a href="' . $link . '">' . $link . '</a>', $embed, $post);
								
			}
			
		}
		
		//Maybe the post doesn't has any URL links. For now, search only for youtube URLs
		$embed = '<amp-iframe width="480" height="270"' . PHP_EOL;
		$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'frameborder="0"' . PHP_EOL;
		$embed .= 'src="https://www.youtube.com/embed/$2">' . PHP_EOL;
		$embed .= '<amp-img layout="fill" src="https://img.youtube.com/vi/$2/hqdefault.jpg" placeholder></amp-img>' . PHP_EOL;
		$embed .= '</amp-iframe>';
		
		$post = preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		$embed,	$post );
		
		//VIDEOS
		$pat = '/(<div class=\"separator\" style=\"clear: both; text-align: center;\">)?<iframe.+data-thumbnail-src=[\'"]([^\'"]+)[\'"].+src=[\'"]([^\'"]+)[\'"].*><\/iframe>(<\/div>)?/';
		
		$embed = '<amp-iframe width="480" height="270"' . PHP_EOL;
		$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'frameborder="0"' . PHP_EOL;
		$embed .= 'src="$3">' . PHP_EOL;
		$embed .= '<amp-img layout="fill" src="$2" placeholder></amp-img>' . PHP_EOL;
		$embed .= '</amp-iframe>';
		
		$post = preg_replace($pat, $embed, $post );
		
		//GENERIC iframes
		$pat = '/<iframe.+src=[\'"]([^\'"]+)[\'"].*><\/iframe>/';
		
		$embed = '<amp-iframe width="600" height="400"' . PHP_EOL;
		$embed .= 'sandbox="allow-scripts allow-same-origin"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'frameborder="0"' . PHP_EOL;
		$embed .= 'src="$1">' . PHP_EOL;
		//$embed .= '<amp-img layout="fill" src="https://thumb.ibb.co/egxDsn/youtube_logo_081217_616x440.jpg" placeholder></amp-img>' . PHP_EOL;
		$embed .= '</amp-iframe>';
		
		$post = preg_replace($pat, $embed, $post );
		
		//TWITTER blockquotes
		$pat = '/<blockquote class=\"twitter-tweet\"><p.*>.*<\/p>(.*)?<a.+href=[\'"]([^\'"]+)[\'"].*>.*<\/a><\/blockquote>/';
		$pat2 = '/http(?:s)?:\/\/(?:www\.)?twitter\.com\/([a-zA-Z0-9_]+)\/status(es)?\/(\d+)/';
		
		if ( preg_match($pat, $post, $matches ) ) 
		{
			preg_match($pat2, $matches['2'], $matc);
			
			$embed = '<amp-twitter width="375"' . PHP_EOL;
			$embed .= 'height="472"' . PHP_EOL;
			$embed .= 'layout="responsive"' . PHP_EOL;
			$embed .= 'data-tweetid="' . $matc['3'] . '">' . PHP_EOL;
			$embed .= '</amp-twitter>';

			$post = preg_replace($pat, $embed, $post );

			//$p = preg_replace($pat, '', $p );
			
		}
		
		//IMAGES With Caption
		$pat = '/<table.*>([\s]+)<tbody>([\s]+)<tr>([\s]+)<td style=\"text-align: center;\"><a.+href=[\'"]([^\'"]+)[\'"].*><img.+src=[\'"]([^\'"]+)[\'"].*><\/a><\/td>([\s]+)<\/tr>([\s]+)<tr>([\s]+)<td class=\"tr-caption\" style=\"text-align: center;\">(.*)<\/td>([\s]+)<\/tr>([\s]+)<\/tbody>([\s]+)<\/table>/';
		
		$embed  = '<figure>' . PHP_EOL;
		$embed .= '<amp-img on="tap:lightbox1"' . PHP_EOL;
		$embed .= 'role="button"' . PHP_EOL;
		$embed .= 'tabindex="0"' . PHP_EOL;
		$embed .= 'src="$4"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'width="300" height="246"></amp-img>' . PHP_EOL;
		$embed .= '<figcaption>$9</figcaption>' . PHP_EOL;
		$embed .= '</figure>';
		
		$post = preg_replace($pat, $embed, $post );
				
		//IMAGES Blogger		
		//$pat = '/(<div class=\"separator\" style=\"clear: both; text-align: center;\">)?(<a.+href=[\'"]([^\'"]+)[\'"].*>)?<img.+src=[\'"]([^\'"]+)[\'"].*>(<\/a>)?(<\/div>)?/';
		$pat = '/<div class=\"separator\" style=\"clear: both; text-align: center;\"><a.+href=[\'"]([^\'"]+)[\'"].*><img.+src=[\'"]([^\'"]+)[\'"].*><\/a><\/div>/';
		
		$embed = '<amp-img width="600"' . PHP_EOL;
		$embed .= 'height="400"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'alt="AMP"' . PHP_EOL;
		$embed .= 'src="$1">' . PHP_EOL;
		$embed .= '</amp-img>';
				
		$post = preg_replace($pat, $embed, $post );
		
		//IMAGES
		//$pat = '/<div class=\"separator\" style=\"clear: both; text-align: center;\"><a.+href=[\'"]([^\'"]+)[\'"].*><img.+src=[\'"]([^\'"]+)[\'"].*><\/a><\/div>/';
		$pat = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/';
		
		$embed = '<amp-img width="600"' . PHP_EOL;
		$embed .= 'height="400"' . PHP_EOL;
		$embed .= 'layout="responsive"' . PHP_EOL;
		$embed .= 'alt="AMP"' . PHP_EOL;
		$embed .= 'src="$1">' . PHP_EOL;
		$embed .= '</amp-img>';
				
		$post = preg_replace($pat, $embed, $post );
		
		//Remove any script from the post
		$pat = '/<script.*><\/script>/';
		$post = preg_replace($pat, '', $post );
		
		return $post;
	}
	
	function curl_url ( $url, $ref = true) 
	{
		$curl_handle = curl_init();
		
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
		//curl_setopt($curl_handle, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl_handle, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 10);
		///curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36');
				
		if ($ref)
			curl_setopt($curl_handle, CURLOPT_REFERER, "https://www.google.com/");
		else
			curl_setopt($curl_handle, CURLOPT_AUTOREFERER, true);
				
		if(curl_exec($curl_handle) === false)
		{
			//echo 'Curl error: ' . curl_error($curl_handle);
			return false;
		}
		
		$query = curl_exec($curl_handle);
		
		$code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
		
		//$headers = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
		
		if( $code == '404' )
		{
			//echo '404';
			return false;
		}
		
		curl_close($curl_handle);
		
		$q = array();
		
		$q['data'] = $query;
		$q['headers'] = $code;
		
		return $q;//$query;
	}
	
	if ( !function_exists( '_autop_newline_preservation_helper' ) )
	{
		function _autop_newline_preservation_helper( $matches ) {
			return str_replace( "\n", "<WPPreserveNewline />", $matches[0] );
		}
	}
	
if ( !function_exists( 'get_html_split_regex' ) )
{
	function get_html_split_regex() 
	{
		static $regex;
	 
		if ( ! isset( $regex ) ) {
			$comments =
				  '!'           // Start of comment, after the <.
				. '(?:'         // Unroll the loop: Consume everything until --> is found.
				.     '-(?!->)' // Dash not followed by end of comment.
				.     '[^\-]*+' // Consume non-dashes.
				. ')*+'         // Loop possessively.
				. '(?:-->)?';   // End of comment. If not found, match all input.
	 
			$cdata =
				  '!\[CDATA\['  // Start of comment, after the <.
				. '[^\]]*+'     // Consume non-].
				. '(?:'         // Unroll the loop: Consume everything until ]]> is found.
				.     '](?!]>)' // One ] not followed by end of comment.
				.     '[^\]]*+' // Consume non-].
				. ')*+'         // Loop possessively.
				. '(?:]]>)?';   // End of comment. If not found, match all input.
	 
			$escaped =
				  '(?='           // Is the element escaped?
				.    '!--'
				. '|'
				.    '!\[CDATA\['
				. ')'
				. '(?(?=!-)'      // If yes, which type?
				.     $comments
				. '|'
				.     $cdata
				. ')';
	 
			$regex =
				  '/('              // Capture the entire match.
				.     '<'           // Find start of element.
				.     '(?'          // Conditional expression follows.
				.         $escaped  // Find end of escaped element.
				.     '|'           // ... else ...
				.         '[^>]*>?' // Find end of normal element.
				.     ')'
				. ')/';
		}
	 
		return $regex;
	}
}

if ( !function_exists( 'wp_html_split' ) )
{
	function wp_html_split( $input ) {
		return preg_split( get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE );
	}
}
if ( !function_exists( 'wp_replace_in_html_tags' ) )
{
	function wp_replace_in_html_tags( $haystack, $replace_pairs ) {
		// Find all elements.
		$textarr = wp_html_split( $haystack );
		$changed = false;
	 
		// Optimize when searching for one item.
		if ( 1 === count( $replace_pairs ) ) {
			// Extract $needle and $replace.
			foreach ( $replace_pairs as $needle => $replace );
	 
			// Loop through delimiters (elements) only.
			for ( $i = 1, $c = count( $textarr ); $i < $c; $i += 2 ) {
				if ( false !== strpos( $textarr[$i], $needle ) ) {
					$textarr[$i] = str_replace( $needle, $replace, $textarr[$i] );
					$changed = true;
				}
			}
		} else {
			// Extract all $needles.
			$needles = array_keys( $replace_pairs );
	 
			// Loop through delimiters (elements) only.
			for ( $i = 1, $c = count( $textarr ); $i < $c; $i += 2 ) {
				foreach ( $needles as $needle ) {
					if ( false !== strpos( $textarr[$i], $needle ) ) {
						$textarr[$i] = strtr( $textarr[$i], $replace_pairs );
						$changed = true;
						// After one strtr() break out of the foreach loop and look at next element.
						break;
					}
				}
			}
		}
	 
		if ( $changed ) {
			$haystack = implode( $textarr );
		}
	 
		return $haystack;
	}
}
if ( !function_exists( 'wpautop' ) )
{
	function wpautop( $pee, $br = true ) {
		$pre_tags = array();

		if ( trim($pee) === '' )
			return '';

		// Just to make things a little easier, pad the end.
		$pee = $pee . "\n";

		/*
		 * Pre tags shouldn't be touched by autop.
		 * Replace pre tags with placeholders and bring them back after autop.
		 */
		if ( strpos($pee, '<pre') !== false ) {
			$pee_parts = explode( '</pre>', $pee );
			$last_pee = array_pop($pee_parts);
			$pee = '';
			$i = 0;

			foreach ( $pee_parts as $pee_part ) {
				$start = strpos($pee_part, '<pre');

				// Malformed html?
				if ( $start === false ) {
					$pee .= $pee_part;
					continue;
				}

				$name = "<pre wp-pre-tag-$i></pre>";
				$pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

				$pee .= substr( $pee_part, 0, $start ) . $name;
				$i++;
			}

			$pee .= $last_pee;
		}
		// Change multiple <br>s into two line breaks, which will turn into paragraphs.
		$pee = preg_replace('|<br\s*/?>\s*<br\s*/?>|', "\n\n", $pee);

		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';

		// Add a double line break above block-level opening tags.
		$pee = preg_replace('!(<' . $allblocks . '[\s/>])!', "\n\n$1", $pee);

		// Add a double line break below block-level closing tags.
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);

		// Standardize newline characters to "\n".
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee);

		// Find newlines in all elements and add placeholders.
		$pee = wp_replace_in_html_tags( $pee, array( "\n" => " <!-- wpnl --> " ) );

		// Collapse line breaks before and after <option> elements so they don't get autop'd.
		if ( strpos( $pee, '<option' ) !== false ) {
			$pee = preg_replace( '|\s*<option|', '<option', $pee );
			$pee = preg_replace( '|</option>\s*|', '</option>', $pee );
		}

		/*
		 * Collapse line breaks inside <object> elements, before <param> and <embed> elements
		 * so they don't get autop'd.
		 */
		if ( strpos( $pee, '</object>' ) !== false ) {
			$pee = preg_replace( '|(<object[^>]*>)\s*|', '$1', $pee );
			$pee = preg_replace( '|\s*</object>|', '</object>', $pee );
			$pee = preg_replace( '%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $pee );
		}

		/*
		 * Collapse line breaks inside <audio> and <video> elements,
		 * before and after <source> and <track> elements.
		 */
		if ( strpos( $pee, '<source' ) !== false || strpos( $pee, '<track' ) !== false ) {
			$pee = preg_replace( '%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $pee );
			$pee = preg_replace( '%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $pee );
			$pee = preg_replace( '%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $pee );
		}

		// Collapse line breaks before and after <figcaption> elements.
		if ( strpos( $pee, '<figcaption' ) !== false ) {
			$pee = preg_replace( '|\s*(<figcaption[^>]*>)|', '$1', $pee );
			$pee = preg_replace( '|</figcaption>\s*|', '</figcaption>', $pee );
		}

		// Remove more than two contiguous line breaks.
		$pee = preg_replace("/\n\n+/", "\n\n", $pee);

		// Split up the contents into an array of strings, separated by double line breaks.
		$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);

		// Reset $pee prior to rebuilding.
		$pee = '';

		// Rebuild the content as a string, wrapping every bit with a <p>.
		foreach ( $pees as $tinkle ) {
			$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		}

		// Under certain strange conditions it could create a P of entirely whitespace.
		$pee = preg_replace('|<p>\s*</p>|', '', $pee);

		// Add a closing <p> inside <div>, <address>, or <form> tag if missing.
		$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);

		// If an opening or closing block element tag is wrapped in a <p>, unwrap it.
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

		// In some cases <li> may get wrapped in <p>, fix them.
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee);

		// If a <blockquote> is wrapped with a <p>, move it inside the <blockquote>.
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);

		// If an opening or closing block element tag is preceded by an opening <p> tag, remove it.
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);

		// If an opening or closing block element tag is followed by a closing <p> tag, remove it.
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

		// Optionally insert line breaks.
		if ( $br ) {
			// Replace newlines that shouldn't be touched with a placeholder.
			//$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);

			// Normalize <br>
			$pee = str_replace( array( '<br>', '<br/>' ), '<br />', $pee );

			// Replace any new line characters that aren't preceded by a <br /> with a <br />.
			$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee);

			// Replace newline placeholders with newlines.
			$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
		}

		// If a <br /> tag is after an opening or closing block tag, remove it.
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);

		// If a <br /> tag is before a subset of opening or closing block tags, remove it.
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

		// Replace placeholder <pre> tags with their original content.
		if ( !empty($pre_tags) )
			$pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

		// Restore newlines in all elements.
		if ( false !== strpos( $pee, '<!-- wpnl -->' ) ) {
			$pee = str_replace( array( ' <!-- wpnl --> ', '<!-- wpnl -->' ), "\n", $pee );
		}

		return $pee;
	}
}