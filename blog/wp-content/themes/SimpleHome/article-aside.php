			<article class="article ">
            	<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" alt="<?php the_title();?>"><?php the_title() ?></a></h1>
            	<div class="aside">
                   <?php the_content(); ?>
                </div>
                <div class="aside-info"><?php the_time("l");?>
                <?php 
					if (get_post_meta($post->ID, 'weather_value', true)!='') {
						$weather = get_weather();
				?>
                <div class="weather-name"><?=($weather[get_post_meta($post->ID, 'weather_value', true)])?></div>
                <div class="weather-box weather-<?=(get_post_meta($post->ID, 'weather_value', true))?>"></div>
                <?php
					}
				?>
                </div>
            </article>