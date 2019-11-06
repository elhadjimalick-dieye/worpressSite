<?php
/**
 * Register required plugins
 *
 * @since  1.0
 */
function learnplus_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => esc_html__( 'Meta Box', 'learnplus'),
			'slug'               => 'meta-box',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'WPBakery Visual Composer', 'learnplus'),
			'slug'               => 'js_composer',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/js_composer.zip'),
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'LearnPlus Visual Composer Addons', 'learnplus'),
			'slug'               => 'learnplus-vc-addons',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/learnplus-vc-addons.zip'),
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'WooCommerce', 'learnplus'),
			'slug'               => 'woocommerce',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'Revolution Slider', 'learnplus'),
			'slug'               => 'revslider',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/revslider.zip'),
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'TT Team Management', 'learnplus'),
			'slug'               => 'tt-team',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/tt-team.zip'),
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'LearnPlus Portfolio', 'learnplus'),
			'slug'               => 'learnplus-portfolio',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/learnplus-portfolio.zip'),
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'TT Testimonial', 'learnplus'),
			'slug'               => 'tt-testimonial',
			'source'             => esc_url('http://trendingtemplates.com/demos/wp-learnplus/plugins/tt-testimonial.zip'),
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               =>esc_html__(  'Contact Form 7', 'learnplus'),
			'slug'               => 'contact-form-7',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'     => esc_html__( 'MailPoet Newsletters', 'learnplus'),
			'slug'     => 'wysija-newsletters',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'The Events Calendar', 'learnplus'),
			'slug'     => 'the-events-calendar',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'bbPress', 'learnplus'),
			'slug'     => 'bbpress',
			'required' => false,
		),
	);
	$config  = array(
		'domain'       => 'learnplus',
		'default_path' => '',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'learnplus' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'learnplus' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'learnplus' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'learnplus' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'learnplus' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'learnplus' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'learnplus' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'learnplus' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'learnplus' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'learnplus' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'learnplus' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'learnplus' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'learnplus' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'learnplus' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'learnplus' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'learnplus' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'learnplus' ),
			'nag_type'                        => 'updated'
		)
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'learnplus_register_required_plugins' );
