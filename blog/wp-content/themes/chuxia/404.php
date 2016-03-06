<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/404.css" />
<!--[if IE 6]>
<script src="js/png.js"></script>
<script>DD_belatedPNG.fix('*')</script>
<![endif]-->
<body>

<div id="wrap">
	<div>
		<img src="<?php echo bloginfo('template_url'); ?>/img/404.png" alt="404" />
	</div>
	<div id="text">
		<strong>
			<span></span>
			<a href="<?php bloginfo('url');?>">返回首页</a>
			<a href="javascript:history.back()">返回上一页</a>
		</strong>
	</div>
</div>

<div class="animate below"></div>
<div class="animate above"></div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/png.js"></script>
</body>
</html>