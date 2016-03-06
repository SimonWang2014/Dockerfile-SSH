<?php
/**
*
* @widget
* 热门标签
* author: @memory
*
*/
class hotTag extends WP_Widget {

	//construct
	function hotTag() {
		parent::WP_Widget('hot_tags', '热门标签', array('description' =>  '我的热门标签(SimpleHome)') );  
	}
	
	//display format
	function widget($args, $instance) {     
		extract( $args );
	?>
		<?php echo $before_widget; ?>
		<?php echo $before_title
		. $instance['title']
		. $after_title; ?>
		<div class="tagcloud">
			<?php wp_tag_cloud("smallest=12&largest=12&unit=px&number=".$instance['num']."&format=flat&orderby=count&order=DESC"); ?>
        </div>
		<?php echo $after_widget; ?>
		<?php
    }
	
	//save options
	function update($new_instance, $old_instance) {             
		return $new_instance;
	}
	
	//widget options
	function form($instance) {              
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '热门标签';
		$num = isset($instance['num']) ? absint($instance['num']) : 10;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('num'); ?>">数量：</label><input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text"  value="<?php echo $num; ?>" /></p>
		<?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("hotTag");'));
?>