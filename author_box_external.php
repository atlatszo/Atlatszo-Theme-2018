<div class="author_box cgrey fs12px">
	<div class="the_author ib"><a href="<?php echo get_author_posts_url($author_id); ?>?w=<?php echo $author_id; ?>" class="cgrey"><?php echo get_user_meta($author_id, 'last_name', true)." ".get_user_meta($author_id, 'first_name', true); ?></a></div>
	<time class="the_post_date"> — <?php echo get_the_date('Y. M. j.');?></time>
</div>