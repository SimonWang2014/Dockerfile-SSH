<?php 
get_header();
$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
    <!-- main container -->
    <div class="container">
    	<div class="article-list">
        <?php
		global $query_string;
		query_posts($query_string.'&orderby=id');
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			if (get_post_format() == 'aside') {
				//日志型文章
				include('article-aside.php');
			} else {
				//普通类型文章
				include('article-normal.php');
			}
			//当页面类型为Single或者Page时显示评论
			if (is_single() || is_page()) {
		?>
        <section class="comments">
			<h1>评论</h1>
			<div class="content">
			<?php
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
			else 
				echo "<p>评论关闭</p>";
			?>
			</div>
		</section>
        <?php
			}
			endwhile; else:
		?>
           <article class="article">
                <h1>Sorry, 没有文章</h1>
                <div class="aside">
                   没有文章
                </div>  
            </article>
		<?
			endif;
			wp_reset_query();
		?>
			<div class="pagenavi"><?php pagenavi(); ?></div>
            <div class="clear"></div>
            <div class="footer">COPYRIGHT &copy; <a href="http://www.im050.com/">IM050.COM</a> | THEME BY <a href="http://www.im050.com/">MEMORY</a></div>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>