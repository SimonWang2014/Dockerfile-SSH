<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>

<div id="comments">
  <?php if ( have_comments() ) : ?>
    <ol class="commentlist">
      <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
    </ol>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <div class="navigation">  
            <span class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments' ) ); ?></span>
            <span class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;' ) ); ?></span>
      </div>
	  <div class="clearfix"></div>
    <?php endif; ?>
  <?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p><?php _e( 'Comments are closed.' ); ?></p>
  <?php endif; ?>
  <?php
$smilies='
<a href="javascript:grin(\':?:\')"      ><img src="'.get_template_directory_uri().'/smilies/icon_question.gif"  alt="" /></a>
<a href="javascript:grin(\':razz:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_razz.gif"      alt="" /></a>
<a href="javascript:grin(\':sad:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_sad.gif"       alt="" /></a>
<a href="javascript:grin(\':evil:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_evil.gif"      alt="" /></a>
<a href="javascript:grin(\':!:\')"      ><img src="'.get_template_directory_uri().'/smilies/icon_exclaim.gif"   alt="" /></a>
<a href="javascript:grin(\':smile:\')"  ><img src="'.get_template_directory_uri().'/smilies/icon_smile.gif"     alt="" /></a>
<a href="javascript:grin(\':oops:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_redface.gif"   alt="" /></a>
<a href="javascript:grin(\':grin:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_biggrin.gif"   alt="" /></a>
<a href="javascript:grin(\':eek:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_surprised.gif" alt="" /></a>
<a href="javascript:grin(\':shock:\')"  ><img src="'.get_template_directory_uri().'/smilies/icon_eek.gif"       alt="" /></a>
<a href="javascript:grin(\':???:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_confused.gif"  alt="" /></a>
<a href="javascript:grin(\':cool:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_cool.gif"      alt="" /></a>
<a href="javascript:grin(\':lol:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_lol.gif"       alt="" /></a>
<a href="javascript:grin(\':mad:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_mad.gif"       alt="" /></a>
<a href="javascript:grin(\':twisted:\')"><img src="'.get_template_directory_uri().'/smilies/icon_twisted.gif"   alt="" /></a>
<a href="javascript:grin(\':roll:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_rolleyes.gif"  alt="" /></a>
<a href="javascript:grin(\':wink:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_wink.gif"      alt="" /></a>
<a href="javascript:grin(\':idea:\')"   ><img src="'.get_template_directory_uri().'/smilies/icon_idea.gif"      alt="" /></a>
<a href="javascript:grin(\':arrow:\')"  ><img src="'.get_template_directory_uri().'/smilies/icon_arrow.gif"     alt="" /></a>
<a href="javascript:grin(\':neutral:\')"><img src="'.get_template_directory_uri().'/smilies/icon_neutral.gif"   alt="" /></a>
<a href="javascript:grin(\':cry:\')"    ><img src="'.get_template_directory_uri().'/smilies/icon_cry.gif"       alt="" /></a>
<a href="javascript:grin(\':mrgreen:\')"><img src="'.get_template_directory_uri().'/smilies/icon_mrgreen.gif"   alt="" /></a>
';
//comment_form($args);
?>
<div id="respond" class="respond">
		<form action="" method="post" id="commentform" class="comment-form">
			<h3 class="clearfix"><span id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span></h3>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
				<p class="title welcome"><?php printf(__('你需要 <a href="%s">登录</a> 才可以回复.'), wp_login_url( get_permalink() )); ?></p>
			<?php else : ?>
				<?php if ( is_user_logged_in() ) : ?>
					<p class="title welcome"><?php printf(__('你好，<a href="%1$s">%2$s</a>，留下脚印吧！'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('退出 »'); ?></a></p>
				<?php else : ?>
					<?php if ( $comment_author != "" ): ?>
						<p class="title welcome">
							<?php _e('你好，'); ?><?php printf(__('<strong>%s</strong>，留下脚印吧！'), $comment_author) ?> <a id="edit_author"><?php _e('编辑 »'); ?></a>
							<span class="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span>
						</p>
						<div id="author_info" class="author_hide">
							<script type="text/javascript">document.getElementById('edit_author').onclick=function(){document.getElementById('author_info').style.display="block"};</script>
					<?php else : ?>
					<div id="author_info">
					<?php endif; ?>
						<p>
							<input type="text" name="author" id="author" class="text" size="15" value="<?php echo $comment_author; ?>" />
							<label for="author"><small><?php _e('姓名'); ?></small></label>
						</p>
						<p>
							<input type="text" name="email" id="mail" class="text" size="15" value="<?php echo $comment_author_email; ?>" />
							<label for="mail"><small><?php _e('邮箱'); ?></small></label>
						</p>
						<p>
							<input type="text" name="url" id="url" class="text" size="15" value="<?php echo $comment_author_url; ?>" />
							<label for="url"><small><?php _e('网站'); ?></small></label>
						</p>
					</div>
				<?php endif; ?>
				<div id="author_textarea">
                <?=($smilies)?>
					<textarea name="comment" id="comment" class="textarea" cols="105" rows="5" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
				</div>
				<p><input id="submit" type="submit" name="submit" value="<?php _e('确认提交 / Ctrl+Enter'); ?>" class="submit" /></p>
			<?php comment_id_fields(); ?> 
			<?php do_action('comment_form', $post->ID); ?>
		</form>
	</div>
	<?php endif; ?>
  <script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
      if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
      } else {
        return false;
      }
      tag = ' ' + tag + ' ';
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        startPos = myField.selectionStart
        endPos = myField.selectionEnd;
        cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
                      + tag
                      + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
      }
      else {
        myField.value += tag;
        myField.focus();
      }
    }
/* ]]> */
</script>
</div>