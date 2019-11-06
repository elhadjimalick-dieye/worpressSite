<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pxt_ecommerce_socialMediaIcons
 *
 * @author Parag chaure <parag.radical@outlook.com>
 */
class pxt_ecommerce_socialMediaIcons extends WP_Widget {

    protected $pxt_ecommerce_defaults = array(
        'title' => '',
        'new_window' => 0,
        'facebook' => '',
        'flickr' => '',
        'gplus' => '',
        'pinterest' => '',
        'instagram' => '',
        'dribbble' => '',
        'linkedin' => '',
        'skype' => '',
        'email' => '',
        'rss' => '',
        'stumbleupon' => '',
        'twitter' => '',
        'youtube' => '',
        'tumblr' => '',
    );
    private $pxt_ecommerce_mediaProfiles = array();

    /**
     * Register widget with WordPress.
     */
    public function __construct() {

        $this->pxt_ecommerce_mediaProfiles = array(
            'facebook' => array(
                'label' => esc_html__('Facebook URL', 'pxt-ecommerce'),
                'html' => '<li class="media-facebook"><a title="'.esc_attr__('Facebook', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-facebook"></i></a></li>',
            ),
            'flickr' => array(
                'label' => esc_html__('Flickr URL', 'pxt-ecommerce'),
                'html' => '<li class="media-flickr"><a title="'.esc_attr__('Flickr', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-flickr"></i></a></li>',
            ),
            'gplus' => array(
                'label' => esc_html__('Google Plus URL', 'pxt-ecommerce'),
                'html' => '<li class="media-gplus"><a title="'.esc_attr__('Google Plus', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-google-plus"></i></a></li>',
            ),
            'pinterest' => array(
                'label' => esc_html__('Pinterest URL', 'pxt-ecommerce'),
                'html' => '<li class="media-pinterest"><a title="'.esc_attr__('Pinterest', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-pinterest-square"></i></a></li>',
            ),
            'instagram' => array(
                'label' => esc_html__('Instagram URL', 'pxt-ecommerce'),
                'html' => '<li class="media-instagram"><a title="'.esc_attr__('Instagram', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-instagram"></i></a></li>',
            ),
            'dribbble' => array(
                'label' => esc_html__('Dribbble URL', 'pxt-ecommerce'),
                'html' => '<li class="media-dribbble"><a title="'.esc_attr__('Instagram', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-dribbble"></i></a></li>',
            ),
            'linkedin' => array(
                'label' => esc_html__('Linkedin URL', 'pxt-ecommerce'),
                'html' => '<li class="media-linkedin"><a title="'.esc_attr__('Linkedin', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-linkedin"></i></a></li>',
            ),
            'skype' => array(
                'label' => esc_html__('Skype URL', 'pxt-ecommerce'),
                'html' => '<li class="media-skype"><a title="'.esc_attr__('Skype', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-skype"></i></a></li>',
            ),
            'email' => array(
                'label' => esc_html__('Email URL', 'pxt-ecommerce'),
                'html' => '<li class="media-email"><a title="'.esc_attr__('Email', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-envelope-o"></i></a></li>',
            ),
            'rss' => array(
                'label' => esc_html__('RSS URL', 'pxt-ecommerce'),
                'html' => '<li class="media-rss"><a title="'.esc_attr__('RSS', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-rss"></i></a></li>',
            ),
            'stumbleupon' => array(
                'label' => esc_html__('StumbleUpon URL', 'pxt-ecommerce'),
                'html' => '<li class="media-stumbleupon"><a title="'.esc_attr__('StumbleUpon', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-stumbleupon"></i></a></li>',
            ),
            'twitter' => array(
                'label' => esc_html__('Twitter URL', 'pxt-ecommerce'),
                'html' => '<li class="media-twitter"><a title="'.esc_attr__('Twitter', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-twitter"></i></a></li>',
            ),
            'youtube' => array(
                'label' => esc_html__('YouTube URL', 'pxt-ecommerce'),
                'html' => '<li class="media-youtube"><a title="'.esc_attr__('YouTube', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-youtube"></i></a></li>',
            ),
            'tumblr' => array(
                'label' => esc_html__('Tumblr URL', 'pxt-ecommerce'),
                'html' => '<li class="media-tumblr"><a title="'.esc_attr__('Tumblr', 'pxt-ecommerce').'" href="%s" %s><i class="fa fa-tumblr"></i></a></li>',
            ),
        );
        parent::__construct(
                'social_media_icons', // Base ID
                esc_html__('Social Media Icons', 'pxt-ecommerce'), // Name
                array('description' => esc_html__('Show the social media profiles', 'pxt-ecommerce'),) // Args
        );
    }

    /**
     * Back-end widget form.
     * @see WP_Widget::form()
     * @param array $pxt_ecommerce_instance Previously saved values from database.
     */
    public function form($pxt_ecommerce_instance) {
        $pxt_ecommerce_instance = wp_parse_args((array) $pxt_ecommerce_instance, $this->pxt_ecommerce_defaults);
        // echo 'asdfa';
        // print_r($pxt_ecommerce_instance['title']);
        $title = !empty($pxt_ecommerce_instance['title']) ? $pxt_ecommerce_instance['title'] : esc_html_e('Follow Us On', 'pxt-ecommerce');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html__('Title:', 'pxt-ecommerce'); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>        
        <p><label><?php esc_html_e('Open links in new window?', 'pxt-ecommerce'); ?> <input id="<?php echo esc_attr($this->get_field_id('new_window')); ?>" type="checkbox" name="<?php echo esc_attr($this->get_field_name('new_window')); ?>" value="1" <?php esc_attr(checked(1, !empty($pxt_ecommerce_instance['new_window']))); ?>/></label></p>
        <?php
        foreach ($this->pxt_ecommerce_mediaProfiles as $key => $media) {
            ?>
            <p><label><?php echo esc_html($media['label']); ?><input id="<?php echo esc_attr($this->get_field_id($key)); ?>" type="text" name="<?php echo esc_attr($this->get_field_name($key)); ?>" class="widefat" value="<?php echo esc_url($pxt_ecommerce_instance[$key]); ?>" /></label></p>
            <?php
        }
    }
    
    /**
     * Sanitize widget form values as they are saved.
     * @see WP_Widget::update()
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($newInstance, $oldInstance) {
        foreach ($newInstance as $key => $value) {
            if (array_key_exists($key, (array) $this->pxt_ecommerce_mediaProfiles)) {
                $newInstance[$key] = esc_url_raw($newInstance[$key]); // Sanitize Profile URLs
            }
        }
        return $newInstance;
    }

    /**
     * Front-end display of widget.
     * @see WP_Widget::widget()
     * @param array $pxt_ecommerce_args     Widget arguments.
     * @param array $pxt_ecommerce_instance Saved values from database.
     */
    public function widget($pxt_ecommerce_args, $pxt_ecommerce_instance) {
        echo ($pxt_ecommerce_args['before_widget']);
        if (!empty($pxt_ecommerce_instance['title'])) {
            echo $pxt_ecommerce_args['before_title'] . (apply_filters('widget_title', $pxt_ecommerce_instance['title'])) . ($pxt_ecommerce_args['after_title']);
        }else{
            echo $pxt_ecommerce_args['before_title'] . (apply_filters('widget_title', esc_html__( 'Social Media Icons', 'pxt-ecommerce'))) . ($pxt_ecommerce_args['after_title']);
        }
        $pxt_ecommerce_target = '';
        if (!empty($pxt_ecommerce_instance['new_window'])) {
            $pxt_ecommerce_target = 'target="_blank"';
        }
        ?>
        <ul class="social-media"> 
            <?php
            foreach ($this->pxt_ecommerce_mediaProfiles as $key => $value) {
                if (!empty($pxt_ecommerce_instance[$key]) && array_key_exists($key, $pxt_ecommerce_instance)) {
                    echo (sprintf($value['html'], $pxt_ecommerce_instance[$key], $pxt_ecommerce_target));
                }
            }
            ?>
        </ul>
        <?php
        echo $pxt_ecommerce_args['after_widget'];
    }
}

function pxt_ecommerce_registerWidget(){
    register_widget('pxt_ecommerce_socialMediaIcons');
}

add_action('widgets_init', 'pxt_ecommerce_registerWidget');

