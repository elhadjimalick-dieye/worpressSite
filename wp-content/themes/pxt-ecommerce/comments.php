<?php
/**
 * The template for displaying the comments.
 * This contains both the comments and the comment form.
 * @package pxt-ecommerce
 */
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Please enter the password to view comments for the post.', 'pxt-ecommerce'); ?>.</p>
    <?php
    return;
}
?>
<!-- You can start editing here. -->
<?php if (have_comments()) { ?>
    <div id="comments">
        <div class="total-comments">
            <?php comments_number(__('No Comments Available', 'pxt-ecommerce'), __(' One Comment ', 'pxt-ecommerce'), __('% Comments', 'pxt-ecommerce')); ?>
        </div>
        <ol class="commentlist">
            <div class="navigation">
                <div class="alignleft"><?php previous_comments_link() ?></div>
                <div class="alignright"><?php next_comments_link() ?></div>
            </div>
            <?php wp_list_comments('type=comment&callback=pxt_ecommerce_Comment'); ?>
            <div class="navigation bottomnav">
                <div class="alignleft"><?php previous_comments_link() ?></div>
                <div class="alignright"><?php next_comments_link() ?></div>
            </div>
        </ol>
    </div>
<?php } else { // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) { ?>
    <?php } else { // comments are closed ?>
    <?php } ?>
<?php } ?>
<?php if ('open' == $post->comment_status) { ?>
    <div id="commentsAdd">
        <div id="respond" class="box m-t-6">
            <?php
            global $aria_req;
            $commentsArgs = array(
                'title_reply' => '<h4><span>' . __('Add your comment', 'pxt-ecommerce') . '</span></h4></h4>',
                'label_submit' => __('Post a comment', 'pxt-ecommerce'),
                'comment_field' => '<p class="comment-form-comment">
                        <label for="comment">' . __('Comment:', 'pxt-ecommerce') . '<span class="required">*</span></label>
                        <textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea>
                        </p>',
            );
            comment_form($commentsArgs);
            ?>
        </div>
    </div>
<?php }; ?>
