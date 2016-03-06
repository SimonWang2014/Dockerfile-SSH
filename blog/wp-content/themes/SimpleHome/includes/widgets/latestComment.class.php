<?php
/**
*
* @widget
* 最新评论
* author: @memory
*
*/
class latestComment extends WP_Widget {

	//construct
	function latestComment() {
		parent::WP_Widget('latest_comment', '最新评论', array('description' =>  '我的最新评论(SimpleHome)') );  
	}
	
	//display format
	function widget($args, $instance) {     
		extract( $args );
	?>
		<?php echo $before_widget; ?>
		<?php echo $before_title
		. $instance['title']
		. $after_title; ?>
		<ul>
		<?php
        $show_comments = $instance['num']; //评论数量
        $my_email = get_bloginfo ('admin_email'); //获取博主自己的email
        $i = 1;
        $comments = get_comments('number=50&status=approve&type=comment');
        foreach ($comments as $rc_comment) {
            //只显示非博主的评论
            if ($rc_comment->comment_author_email != $my_email) {
                ?>
                <li><?php echo get_avatar($rc_comment->comment_author_email,32); ?><a href="<?php echo get_permalink($rc_comment->comment_post_ID); ?>#comment-<?php echo $rc_comment->comment_ID; ?>"><?php echo $rc_comment->comment_author; ?>: </br><?php echo convert_smilies($rc_comment->comment_content); ?></a></li>
                <?php
                if ($i == $show_comments) break; //评论数量达到退出遍历
                $i++;
            }
        }
        ?></ul>
		<?php echo $after_widget; ?>
		<?php
    }
	
	//save options
	function update($new_instance, $old_instance) {             
		return $new_instance;
	}
	
	//widget options
	function form($instance) {              
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '最新评论';
		$num = isset($instance['num']) ? absint($instance['num']) : 10;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('num'); ?>">数量：</label><input class="widefat" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text"  value="<?php echo $num; ?>" /></p>
		<?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("latestComment");'));
?>