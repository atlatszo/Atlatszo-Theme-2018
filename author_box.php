<?php
$author_id=$post->post_author;
?>
<div class="author_box cgrey fs12px">
	<div class="the_author ib"><a href="<?php echo get_author_posts_url($author_id); ?>" class="cgrey"><?php echo nl2br(get_the_author_meta('last_name')." ".get_the_author_meta('first_name')); ?></a></div>
	<time class="the_post_date"> — <?php echo get_the_date('Y. M. j.');?></time>
</div>