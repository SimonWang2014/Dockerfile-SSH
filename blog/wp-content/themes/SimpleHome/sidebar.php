		<div class="sidebar">
			<?php
            if (is_category() || is_single()) {
            ?>
            <ul class="category-list">
                <?php 
				if (is_single()) {
					$cat_id = get_article_category_id();
				} else
				{
					$cat_id = $cat;
				}
				$args=array(
					'child_of'=>get_category_root_id($cat_id),
					'hide_empty'=>false,
				);
				$categories=get_categories($args);
				foreach($categories as $category) {
					$class = '';
					if ($cat_id == $category->term_id)
						$class = " class='current-cat' ";
						$custom_icon = get_tax_meta($category->term_id,'simplehome_custom_icon');
						$custom_icon_html = '';
						if ($custom_icon != '')
							$custom_icon_html = '<i class="fa '.$custom_icon.'"></i>';

					echo '<li'.$class.'><a href="'.get_category_link( $category->term_id ).'">'.$custom_icon_html.'<span>'.$category->name.'</span></a></li>';    
				}
				?>
            </ul><?php }?>
		<?php if(is_dynamic_sidebar()) dynamic_sidebar('mytheme_sidebar');?>
		</div>