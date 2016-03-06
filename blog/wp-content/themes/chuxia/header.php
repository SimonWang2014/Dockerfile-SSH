<?PHP
/*
 * The header.
 * @package WordPress
 * @subpackage ChuXia
 * @since ChuXia 1.0
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
<?php
	global $post;
	if (is_home()){
		$keywords = get_op('keywords');
		$description = get_op('description');
	}elseif (is_single()){
		$keywords = get_post_meta($post->ID, "keywords", true);
		if($keywords == ""){
			$tags = wp_get_post_tags($post->ID);
			foreach ($tags as $tag){
				$keywords = $keywords.$tag->name.",";
			}
			$keywords = rtrim($keywords, ', ');
		}
		$description = get_post_meta($post->ID, "description", true);
		if($description == ""){
			if($post->post_excerpt){
				$description = $post->post_excerpt;
			}else{
				$description = mb_strimwidth(strip_tags($post->post_content),0,200,'');
			}
		}
	}elseif (is_page()){
		$keywords = $options['keywords'];
		$description = $options['description'];
	}elseif (is_category()){
		$keywords = single_cat_title('', false);
		$description = category_description();
	}elseif (is_tag()){
		$keywords = single_tag_title('', false);
		$description = tag_description();
	}
	$keywords = trim(strip_tags($keywords));
	$description = trim(strip_tags($description));
	?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<link rel="shortcut icon" href="<?php echo get_op('favicon'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/mo.css" />
<!--[if lt IE 9]><script src="http://apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/touchslide.js"></script>
<?php wp_head(); ?>
</head>
<body class="bg">
<div id="header" class="pt15">
	<div class="wrapper">
		<div class="nav fl">
			<a href="javascript:;" class="nav-m"><i class="mo-menu"></i></a>
			<div class="logo fl">
				<h1><a href="<?php bloginfo('url');?>" title="<?php bloginfo('nema');?>"><img src="<?php echo get_op('logo'); ?>"/></a></h1>
			</div>
			<ul class="menu fr">
				<?php 
				$menu = array(
				'container'	=> false,
				'items_wrap' => '%3$s',
				//'echo' => false,
				'depth'	=> 0,
				'theme_location' =>'nav',
				);
				echo strip_tags(wp_nav_menu( $menu), '<li><a>' );
				?>
			</ul>
		</div>
		<div class="tool fr">
			<a href="javascript:;"><i class="mo-pencil"></i>投稿</a>
			<a class="sogin" href="<?php echo site_url('/wp-login.php'); ?>"><i class="mo-user"></i>登录</a>
			<a class="sch" href="javascript:;"><i class="mo-search"></i>搜索</a>
		</div>
	</div>
</div>
<div id="banner">
	<div class="wrapper clearfix">
		<span class="iclose fr"><i class="mo-cancel-circled-outline"></i></span>
		<div class="search zhenghei">
	        <form action="<?php bloginfo('home'); ?>" method="get">
	            <input name="s" id="search" class="st fl" value="请输入关键词搜索..." onblur="if (this.value == '') {this.value = '请输入关键词搜索...';}" onfocus="if (this.value == '请输入关键词搜索...') {this.value = '';}" type="text">
	            <button value="" class="but fr" type="submit"><i class="mo-search"></i></button>
	        </form>
		</div>
	</div>
</div>