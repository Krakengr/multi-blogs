<?php defined('BLUDIT') or die('Bludit CMS.');

if ( $this->getValue( 'enable-shop' ) !== 'disable' )
		{
			$html .= '<li class="nav-item mt-3"><h4>' . $L->get( 'store' ) . '</h4></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/content?type=shop"><span class=""></span>' . $L->get( 'all-products' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?product=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-product' ) . '</a></li>';
			
		}
		
		if ( $this->getValue( 'enable-forum' ) !== 'disable' )
		{
			$html .= '<li class="nav-item mt-3"><h4>' . $L->get( 'forums' ) . '</h4></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-category"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-forum-category' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?forum=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-forum' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/new-content?topic=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'new-topic' ) . '</a></li>';
			
		}
		
		if ( $this->getValue( 'allow-users' ) )
		{
			$html .= '<li class="nav-item mt-3"><h4>' . $L->get( 'members' ) . '</h4></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/content?type=users"><span class=""></span>' . $L->get( 'all-users' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?users=true&do=roles"><span class=""></span>' . $L->get( 'user-roles' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?users=true&do=add"><span class="fa fa-plus-circle"></span>' . $L->get( 'user-add' ) . '</a></li>';
		}
		
		if ( $this->getValue( 'enable-redirs' ) )
		{
			$html .= '<li class="nav-item mt-3"><h4>' . $L->get( 'redirs' ) . '</h4></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/content?type=redirs"><span class=""></span>' . $L->get( 'all-redirs' ) . '</a></li>';
			
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?redirs=true"><span class="fa fa-plus-circle"></span>' . $L->get( 'redir-add' ) . '</a></li>';
		}
		
		$html .= '<li class="nav-item mt-3"><h4>' . $L->get( 'blogs-settings-menu' ) . '</h4></li>';
		
		$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs">' . $L->get( 'main-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?blogs=true">' . $L->get( 'blogs-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-shop' ) !== 'disable' )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?store=true">' . $L->get( 'store-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-forum' ) !== 'disable' )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?forum=true">' . $L->get( 'forum-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'allow-users' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?users=true">' . $L->get( 'users-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enableMenu' ) === 'manual' )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?menu=true">' . $L->get( 'menu-editor' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-seo' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?seo=true">' . $L->get( 'seo-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enableWidgets' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . THIS_HTML . '?widgets=true">' . $L->get( 'widgets-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enableAutoContent' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . THIS_HTML . '?auto-content=true">' . $L->get( 'auto-content-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-amp' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?amp=true">' . $L->get( 'amp-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enableantispam' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?antispam=true">' . $L->get( 'antispam-settings' ) . '</a></li>';
		
		if ( $this->getValue( 'enable-langs' ) )
			$html .= '<li class="nav-item"><a class="nav-link" href="' . $this->site_url() . 'admin/configure-plugin/pluginSubBlogs?langs=true">' . $L->get( 'langs-settings' ) . '</a></li>';