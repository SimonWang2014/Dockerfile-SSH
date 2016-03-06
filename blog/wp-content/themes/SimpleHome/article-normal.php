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
					if (is_single() || is_page()) {
				?>
					<?php the_content(); ?>
					<div class="article-copyright"><i class="fa fa-share-alt"></i> 码字很辛苦，转载请注明来自<b><a href="<?php bloginfo('wpurl');?>"><?php bloginfo('name') ?></a></b>的<a href="<?php the_permalink();?>">《<?php the_title();?>》</a></div>
                <?php
					} else { the_excerpt(); }
				?>
                </div>
                <div class="article-info">
                    <i class="fa fa-calendar"></i> <?php the_time("Y-m-d");?> &nbsp; <i class="fa fa-map-marker"></i> 
					<?php
						the_category(',');
					?>
                </div>
                <?php if (!is_single() && !is_page()) { ?><div class="readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>">+ 阅读全文</a></div><?php } ?>
            </article>