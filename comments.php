<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


<div class="comments-area">
		
	<h3 class="bgrey cwhite ac p10 fs12px ls1 mb40"><img src="<?php bloginfo('template_url')?>/i/comment.svg" width="15" height="20" class="vm mr10" alt="<?php _e('Hozzászólnál a témához? Megteheted a Facebook-oldalunkon!', 'atlatszo');?>" /><span class="vm"><?php _e('Hozzászólnál a témához? Megteheted a Facebook-oldalunkon!', 'atlatszo');?></span></h3>

	<?php $facebook_hozzaszolas_embed_code=get_field('facebook_hozzaszolas_embed_code'); ?>

	<?php echo $facebook_hozzaszolas_embed_code; ?>

</div>