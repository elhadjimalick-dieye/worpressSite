<?php

namespace ExtendBuilder;

use ColibriWP\PageBuilder\Utils\Utils;
add_shortcode('colibri_fake_loop', '\ExtendBuilder\colibri_fake_loop');

function colibri_fake_loop($attrs, $content = null)
{
    ob_start();
    while (have_posts()) :
        the_post();
        ?>
        <?php
        echo do_shortcode($content);
        break;
        ?>
    <?php
    endwhile;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function get_svg_icon($name) {
    $used_svg_icons = get_transient('colibriwp_used_svg_icons');
    if (!$used_svg_icons) {
        $used_svg_icons = array();
    }

    if (!isset($used_svg_icons[$name])) {
        $all_icons = svg_icons_list();
        if (isset($all_icons[$name])) {
            $used_svg_icons[$name] = $all_icons[$name];
            set_transient('colibriwp_used_svg_icons', $used_svg_icons);
        }
    }

    return array_get_value($used_svg_icons, $name, '');
}

function svg_icons_list() {
//    $icons = get_transient('colibriwp_svg_icons');
    $key = 'colibriwp_svg_icons';
    $icons = colibri_cache_get($key, false);
    if ($icons) {
      return $icons;
    }

    $icons_file = extend_builder_path()."/assets/static/svg-icons.js";
    $icons_str = file_get_contents($icons_file);
    $matches = array();
    preg_match( '/\(([^\)]*)\)/', $icons_str, $matches);
    $parts = explode(',', $matches[1]);
    $icons = Utils::inflate($parts[1]);
    $icons = json_decode($icons, true);

  //    set_transient('colibriwp_svg_icons', $icons,  24 * HOUR_IN_SECONDS);
    colibri_cache_set($key, $icons);
    return $icons;
}

add_shortcode('colibri_svg_icon', function ($attrs) {
    $icon_name = $attrs['name'];
    return get_svg_icon($icon_name);
});
add_shortcode('colibri_copyright', function ($attrs, $content) {
  $default = '&copy; {year} {site-name}. Built using WordPress and <a target="_blank" href="https://colibriwp.com">Colibri</a>';
	$msg       = $content ? $content : $default;
	$msg = str_replace( "{year}", date('Y'), $msg );
	$msg = str_replace( "{site-name}", get_bloginfo('name'), $msg );
	return $msg;
});
add_shortcode('colibri_site_title', function ($atts) {
    return get_bloginfo('name');
});

add_shortcode('colibri_home_url', function ($atts) {
    return home_url('/');
});


function esc_base64_image($content){
   return str_replace('data:image/png;base64,','__COLIBRI__DATA_IMAGE_BASE_64',$content);
}

add_shortcode('colibri_custom_logo_url', function ($atts) {
    $custom_logo_id = get_theme_mod('custom_logo', false);
    if (!$custom_logo_id) {
        $placeholder =  esc_base64_image(
            'data:image/png;base64,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'
        );
	    return $placeholder;
    }
    return wp_get_attachment_image_url($custom_logo_id, 'full');
});


add_filter('colibri_dynamic_content',function($content, $options){
    $content = str_replace('__COLIBRI__DATA_IMAGE_BASE_64','data:image/png;base64,',$content);
    return $content;
},PHP_INT_MAX, 2);

add_filter('the_content', function($content) {
    $content = str_replace('__COLIBRI__DATA_IMAGE_BASE_64','data:image/png;base64,',$content);
    return $content;
}, PHP_INT_MAX);

add_action('colibri_after_dynamic_content',function($type) {
	if ( $type == "header" ){
		?>
		<script type='text/javascript'>
          (function () {
            function setHeaderTopSpacing() {

                // forEach polyfill
                if(!NodeList.prototype.forEach){
                    NodeList.prototype.forEach = function (callback) {
                        for(var i=0;i<this.length;i++){
                            callback.call(this,this.item(i));
                        }
                    }
                }

              // '[data-colibri-component="navigation"][data-overlap="true"]' selector is backward compatibility
              var navigation = document.querySelector('[data-colibri-navigation-overlap="true"], [data-colibri-component="navigation"][data-overlap="true"]')
              if (navigation) {
                var els = document
                .querySelectorAll('.h-navigation-padding');
                if (els.length) {
                  els.forEach(function (item) {
                    item.style.paddingTop = navigation.offsetHeight + "px";
                  });
                }
              }
            }
            setHeaderTopSpacing();
          })();
		</script>
		<?php
	}
},PHP_INT_MAX);
