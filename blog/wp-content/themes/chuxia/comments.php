<div id="comments">
	<?php
		if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');
	?>
	<!-- Comment's List -->
	<div class="comments-data">
		<h2 class="comments-title">
		<?php
			printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentyfifteen' ), number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>
	</div>
	<div class="pagination"><?php paginate_comments_links('prev_text=«&next_text=»');//分页 ?></div>
	<ol class="commentlist">
		<?php
    		if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
        // if there's a password
        // and it doesn't match the cookie
		?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">必须输入密码，才能查看评论！</a></p>
	    </li>
	    <?php
	        } else if ( !comments_open() ) {
	    ?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">报歉!评论已关闭.</a></p>
	    </li>
	    <?php
	        } else if ( !have_comments() ) {
	    ?>
	    <li class="decmt-box">
	        <p><a href="#addcomment">还没有任何评论，你来说两句吧</a></p>
	    </li>
	    <?php
	        } else {
	            wp_list_comments('type=comment&callback=chuxia_comment_list');
	        }
	    ?>
	</ol>
	<?php
		if ( !comments_open() ) :
		// If registration required and not logged in.
		elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
		?>
	<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
	<?php else  : ?>
	<!-- Comment Form -->
	<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
		<div class="comments-data">
			<h2 class="">Leave a reply</h2>
		</div>
	    <ul>
	        <?php if ( !is_user_logged_in() ) : ?>
	        <li class="clearfix">
	            <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="23" tabindex="1" />
	            <label for="name">name<i>*</i></label>
	        </li>
	        <li class="clearfix">
	            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="23" tabindex="2" />
	            <label for="email">email<i>*</i></label>
	        </li>
	        <li class="clearfix">
	            <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="23" tabindex="3" />
	            <label for="email">website</label>
	        </li>
	        <?php else : ?>
	        <li class="clearfix">您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></li>
	        <?php endif; ?>
	        <li class="clearfix">
	            <textarea id="comment" name="comment" tabindex="4" rows="3" cols="40"></textarea>
	        </li>
	        <li><?php //include('inc/smiley.php'); ?></li>
	        <li class="clearfix">
	            <!-- Add Comment Button -->
	            <a id="submit" href="javascript:void(0);" onClick="Javascript:document.forms['commentform'].submit()" class="button medium black right">提交评论</a> 
	        </li>
	    </ul>
	    <?php comment_id_fields(); ?>
	    <?php do_action('comment_form', $post->ID); ?>
	</form>
	<?php endif; ?>
</div>