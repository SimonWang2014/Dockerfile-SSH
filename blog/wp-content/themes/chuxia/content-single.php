<div class="content">
	<div class="post-inner">
		<span>发表于: <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>&nbsp;·</span>
		<span><?php the_time('Y-n-j'); ?>&nbsp;·&nbsp;</span>
		<span><?php post_views(' ',' views '); ?>&nbsp;·&nbsp;</span>
		<span><?php comments_popup_link ('0 replies','1 replies','% replies'); ?>&nbsp;</span>
	</div>
	<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading %s', 'chuxia' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		) );
		// posts pagenavi
		wp_link_pages( array(  
        'before'           => '<div class="page-links"><b>' . __( 'Pages:', 'twentyfifteen' ) . '</b>',
        'after'            => '</div>',
        'link_before'      => '<span>',
        'link_after'       => '</span>',
        'next_or_number'   => 'number',
        'separator'        => '',
        'nextpagelink'     => __( 'Next page' ),
        'previouspagelink' => __( 'Prev page' ),
        'pagelink'         => '%',
        'echo'             => 1 
    ) );
	?>
</div>
<?php edit_post_link( __('Edit'), '<div class="edit-link">[', ']</div>' ); ?>
<div class="post-pull mt25 clearfix">
	<div class="fl">
		<span class="post-tag"><?php the_tags(('标签: '), ' '); ?></span>
		<span class="post-links">本文链接: <?php echo curPageURL(); ?></span>
	</div>
	<div class="fr">
		<div class="post-like">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done'; ?>" title="喜欢就点一个吧!">
				<i class="mo-heart"></i>
				<i class="count">
				<?php 
					if( get_post_meta($post->ID,'bigfa_ding',true) ){            
						echo get_post_meta($post->ID,'bigfa_ding',true);
					} else {
						echo '0';
					}; ?>&nbsp;like+
				</i>
			</a>
		</div>
		<div class="bdsharebuttonbox">
			<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
			<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
			<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
			<a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
			<a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
			<a title="分享到微信" href="#" class="bds_douban" data-cmd="douban"></a>
			<a title="分享到微信" href="#" class="bds_huaban" data-cmd="huaban"></a>
			<a href="#" class="bds_more" data-cmd="more"></a>
		</div>
		<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	</div>
</div>
<div class="post-link w780 mt15">
	<span class="fl">
	<?php 
		if(get_previous_post()){
			previous_post_link('&laquo;上一篇：%link','%title',true);
		} else {
			echo "该分类没有了";
		}; ?>
	</span>
	<span class="fr">
	<?php 
		if(get_next_post()){
			next_post_link('%link：下一篇&raquo;','%title',true);
		} else {
			echo "该分类没有了";
		}; ?>
	</span>
</div>