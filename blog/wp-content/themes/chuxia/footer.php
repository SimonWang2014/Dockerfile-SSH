<div id="footer">
	<div class="wrapper">
		<div class="link"><?php get_template_part( 'link');?></div>
		<p>Copyright&copy;2015&nbsp;<a href="<?php bloginfo('url');?>" title="<?php bloginfo('nema');?>"><?php bloginfo('nema');?></a>,&nbsp;&nbsp;Powered by <a href="http//cn.wordpress.org/">wordpress</a>,&nbsp;&nbsp;Theme by 美多网,&nbsp;&nbsp;<a href="#">网站地图</a>&nbsp;&nbsp;<a href="#">网站统计</a></p>
	</div>
</div>
<div class="other">
	<a class="backtop" href="javascript:;"><i class="mo-up"></i></a>
</div>
<?php wp_footer(); 
if(is_home()){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/slide.js"></script>
<?php } elseif (is_single()){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/solarized_light.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/highlight.js"></script>
<?php }; ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/online.js"></script>
</body>
</html>