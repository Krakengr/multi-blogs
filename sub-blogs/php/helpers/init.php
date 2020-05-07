<?php defined('BLUDIT') or die('Bludit CMS.');

define( 'DB_FOLDER', PATH_DATABASES . 'subblogs-db' . DS );

define( 'DB_BLOGS', DB_FOLDER . 'blogs.php' );

define( 'DB_LANGS', DB_FOLDER . 'langs.php' );
		
define( 'DB_TOPICS', DB_FOLDER . 'topics.php' );
		
define( 'DB_REPLIES', DB_FOLDER . 'replies.php' );
		
define( 'DB_MEMBERS', DB_FOLDER . 'members.php' );
		
define( 'DB_REDIRS', DB_FOLDER . 'redirs.php' );
		
define( 'DB_AUTO', DB_FOLDER . 'autocontent.php' );
		
define( 'DB_MENU', DB_FOLDER . 'menu.php' );

define( 'DB_WIDGETS', DB_FOLDER . 'widgets.php' );
		
define( 'DB_USER_ROLES', DB_FOLDER . 'roles.php' );
		
define( 'AMP_PHP_PATH', $this->phpPath() . 'amp' . DS . 'php' . DS );
		
define( 'PS', '/' );
		
define( 'PHP_FOLDER', $this->phpPath() . 'php' . DS );
		
define( 'THIS_HTML', $this->site_url() . 'admin/configure-plugin/pluginSubBlogs' );

require ( PHP_FOLDER . 'functions.php' );

require ( PHP_FOLDER . 'helpers' . DS . 'db.php' );
