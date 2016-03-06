<?php
/**
* Template Name: Guestbook
*/
?>
<?php 
get_header();
?>
    <!-- main container -->
    <div class="container">
    	<div class="article-list">
        <?php
		global $query_string;
		query_posts($query_string.'&orderby=id');
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		?>
        <article class="article">
        		<?php
                if (get_post_meta($post->ID, "music_url_value", true)) {
                ?>
                <div class="post-format-audio">
                    <div class="feature-img audio">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_post_thumbnail(); ?></a>
                      <?php } ?>  
                       <div class="audio-wrapper">
                                <div class="me-wrap">
                                <audio class="wp-audio-shortcode" preload="none" style="width: 100%">
                                <source type="audio/mp3" src="<?php echo get_post_meta( $post->ID, 'music_url_value', true ); ?>">
                                </audio>
                                </div>
                            </div>	
                </div>
                </div>
                <?php
				} else {?>
            	<?php if ( has_post_thumbnail() ) { ?>
                <div class="feature-img">
                	<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_post_thumbnail(); ?></a>
                </div>
				<?php }
				}?>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title(); ?></a></h1>
            <div class="content">
                <?php
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
                else 
                    echo "<p>评论关闭</p>";
                ?>
            </div>
        </article>
            <?php
                endwhile; else:
            ?>
               <article class="article">
                    <h1>404</h1>
                    <div class="aside">
                       I'm so Sorry.
                    </div>  
                </article>
            <?
                endif;
                wp_reset_query();
            ?>
                <div class="clear"></div>
                <div class="footer">COPYRIGHT &copy; <a href="http://www.im050.com/">IM050.COM</a> | THEME BY <a href="http://www.im050.com/">MEMORY</a></div>
            </div>
            <?php get_sidebar(); ?>
        </div>
<?php get_footer(); ?>