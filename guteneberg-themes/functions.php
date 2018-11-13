<?php

add_action( 'wp_enqueue_scripts', 'gb_enqueue_theme_assets' );

function gb_enqueue_theme_assets() {
	wp_enqueue_style(
		'parent-style',
		get_template_directory_uri() . '/style.css'
    );
    
	wp_enqueue_style(
		'gbtheming-style',
		get_stylesheet_uri(),
		['parent-style']
	);
}

$color_palette = [
    [
        'name'  => esc_html__( 'Dark Blue', 'itheme-gb' ),
        'slug'  => 'dark-blue',
        'color' => '#003366',
    ],
    [
        'name'  => esc_html__( 'Sonny Grey', 'itheme-gb' ),
        'slug'  => 'grey',
        'color' => '#666666',
    ],
    [
        'name'  => esc_html__( 'White', 'itheme-gb' ),
        'slug'  => 'white',
        'color' => '#FFFFFF',
    ]
];

add_action( 'after_setup_theme', 'gb_theme_support' );

function gb_theme_support() {
    global $color_palette;
    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
   
    // add_theme_support( 'disable-custom-font-sizes' ); - DOESN'T WORK!

    add_theme_support( 'editor-color-palette', $color_palette );
    add_theme_support( 'disable-custom-colors' );
}

add_action( 'register_post_type_args','gb_block_templates', 20, 2 );

function gb_block_templates( $args, $post_type ) {
	if ( 'post' === $post_type) {
		$args[ 'template' ] = [
            [
				'core/cover-image', [
					'align' => 'full',
				]
			],
			[
				'core/heading', [
					'placeholder' => __( 'Subheadline', 'gutenbergtheme' )
				]
            ],
            [
				'core/separator'
			],
			[
				'core/image', [
					'align' => 'right',
				]
			],			
			[
				'core/paragraph', [
					'align' => 'left',
					'placeholder' => __( 'Incididunt aliquip culpa dolore amet sunt voluptate excepteur aliqua deserunt in cillum ullamco est sit. Incididunt aliquip culpa dolore amet sunt voluptate excepteur aliqua deserunt in cillum ullamco est sit.', 'gutenbergtheme' )
				]
			],			
        ];
        
         $args['template_lock'] = 'all';
	}
	return $args;	
	
}