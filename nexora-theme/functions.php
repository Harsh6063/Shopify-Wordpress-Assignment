<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/* =========================================================
   THEME SETUP
========================================================= */

function nexora_theme_setup() {

    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 60,
            'width'       => 250,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'nexora-theme' ),
            'footer'  => __( 'Footer Menu', 'nexora-theme' ),
        )
    );
}

add_action( 'after_setup_theme', 'nexora_theme_setup' );


/* =========================================================
   IMAGE SIZES
========================================================= */

function nexora_image_sizes() {

    add_image_size(
        'nexora-article',
        900,
        550,
        true
    );
}

add_action( 'after_setup_theme', 'nexora_image_sizes' );


/* =========================================================
   ENQUEUE ASSETS
========================================================= */

function nexora_enqueue_assets() {

    /* Google Font */
    wp_enqueue_style(
        'nexora-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    /* Font Awesome */
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        array(),
        '6.5.2'
    );

    /* Main Theme CSS */
    wp_enqueue_style(
        'nexora-style',
        get_stylesheet_uri(),
        array(
            'nexora-google-fonts',
            'font-awesome',
        ),
        wp_get_theme()->get( 'Version' )
    );

    /* Main JavaScript */
    wp_enqueue_script(
        'nexora-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}

add_action( 'wp_enqueue_scripts', 'nexora_enqueue_assets' );


/* =========================================================
   PERFORMANCE
========================================================= */

function nexora_remove_unnecessary_assets() {

    remove_action(
        'wp_head',
        'wp_generator'
    );
}

add_action(
    'init',
    'nexora_remove_unnecessary_assets'
);


/* =========================================================
   SECURITY HEADERS
========================================================= */

function nexora_security_headers() {

    header( 'X-Content-Type-Options: nosniff' );

    header(
        'Referrer-Policy: strict-origin-when-cross-origin'
    );
}

add_action(
    'send_headers',
    'nexora_security_headers'
);


/* =========================================================
   HERO SECTION CUSTOMIZER
========================================================= */

function nexora_customize_register( $wp_customize ) {

    /* -------------------------
       HERO SECTION
    ------------------------- */

    $wp_customize->add_section(
        'nexora_hero_section',
        array(
            'title'       => __( 'Hero Section', 'nexora-theme' ),
            'priority'    => 30,
            'description' => __(
                'Customize the homepage hero section.',
                'nexora-theme'
            ),
        )
    );


    /* -------------------------
       HERO TITLE
    ------------------------- */

    $wp_customize->add_setting(
        'hero_title',
        array(
            'default'           => 'Building Digital Experiences That Drive Results',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_title',
        array(
            'label'   => __( 'Hero Title', 'nexora-theme' ),
            'section' => 'nexora_hero_section',
            'type'    => 'text',
        )
    );


    /* -------------------------
       HERO DESCRIPTION
    ------------------------- */

    $wp_customize->add_setting(
        'hero_description',
        array(
            'default'           => 'We help businesses grow with innovative digital solutions, strategic vision, and powerful execution.',
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'hero_description',
        array(
            'label'   => __( 'Hero Description', 'nexora-theme' ),
            'section' => 'nexora_hero_section',
            'type'    => 'textarea',
        )
    );


    /* -------------------------
       HERO BACKGROUND IMAGE
    ------------------------- */

    $wp_customize->add_setting(
        'hero_background_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'hero_background_image',
            array(
                'label'       => __(
                    'Hero Background Image',
                    'nexora-theme'
                ),
                'section'     => 'nexora_hero_section',
                'settings'    => 'hero_background_image',
                'description' => __(
                    'Upload or select the Hero background image.',
                    'nexora-theme'
                ),
            )
        )
    );
/* ========================================
   STATISTICS SECTION
======================================== */

$wp_customize->add_section(
    'nexora_statistics_section',
    array(
        'title'       => __( 'Statistics Section', 'nexora-theme' ),
        'priority'    => 35,
        'description' => __( 'Customize website statistics.', 'nexora-theme' ),
    )
);


/* STAT 1 */

$wp_customize->add_setting(
    'stat_1_number',
    array(
        'default'           => '10',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_1_number',
    array(
        'label'   => 'Statistic 1 Number',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


$wp_customize->add_setting(
    'stat_1_label',
    array(
        'default'           => 'Years Experience',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_1_label',
    array(
        'label'   => 'Statistic 1 Label',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


/* STAT 2 */

$wp_customize->add_setting(
    'stat_2_number',
    array(
        'default'           => '200',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_2_number',
    array(
        'label'   => 'Statistic 2 Number',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


$wp_customize->add_setting(
    'stat_2_label',
    array(
        'default'           => 'Projects Completed',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_2_label',
    array(
        'label'   => 'Statistic 2 Label',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


/* STAT 3 */

$wp_customize->add_setting(
    'stat_3_number',
    array(
        'default'           => '50',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_3_number',
    array(
        'label'   => 'Statistic 3 Number',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


$wp_customize->add_setting(
    'stat_3_label',
    array(
        'default'           => 'Happy Clients',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_3_label',
    array(
        'label'   => 'Statistic 3 Label',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


/* STAT 4 */

$wp_customize->add_setting(
    'stat_4_number',
    array(
        'default'           => '15',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_4_number',
    array(
        'label'   => 'Statistic 4 Number',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


$wp_customize->add_setting(
    'stat_4_label',
    array(
        'default'           => 'Team Members',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_4_label',
    array(
        'label'   => 'Statistic 4 Label',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


/* STAT 5 */

$wp_customize->add_setting(
    'stat_5_number',
    array(
        'default'           => '24/7',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_5_number',
    array(
        'label'   => 'Statistic 5 Number',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);


$wp_customize->add_setting(
    'stat_5_label',
    array(
        'default'           => 'Support Available',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    'stat_5_label',
    array(
        'label'   => 'Statistic 5 Label',
        'section' => 'nexora_statistics_section',
        'type'    => 'text',
    )
);
/* ========================================
   HERO STATISTICS
======================================== */

$wp_customize->add_section(
    'nexora_hero_stats_section',
    array(
        'title'    => __( 'Hero Statistics', 'nexora-theme' ),
        'priority' => 31,
    )
);

for ( $i = 1; $i <= 4; $i++ ) {

    $wp_customize->add_setting(
        'hero_stat_' . $i . '_number',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_stat_' . $i . '_number',
        array(
            'label'   => 'Statistic ' . $i . ' Number',
            'section' => 'nexora_hero_stats_section',
            'type'    => 'text',
        )
    );


    $wp_customize->add_setting(
        'hero_stat_' . $i . '_label',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_stat_' . $i . '_label',
        array(
            'label'   => 'Statistic ' . $i . ' Label',
            'section' => 'nexora_hero_stats_section',
            'type'    => 'text',
        )
    );


    $wp_customize->add_setting(
        'hero_stat_' . $i . '_icon',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'hero_stat_' . $i . '_icon',
        array(
            'label'       => 'Statistic ' . $i . ' Icon',
            'description' => 'Example: fa-award or fa-users',
            'section'     => 'nexora_hero_stats_section',
            'type'        => 'text',
        )
    );}
/* ========================================
   FEATURES
======================================== */

$wp_customize->add_section(
    'nexora_features_section',
    array(
        'title'    => __( 'Features Section', 'nexora-theme' ),
        'priority' => 32,
    )
);

for ( $i = 1; $i <= 4; $i++ ) {

    $wp_customize->add_setting(
        'feature_' . $i . '_icon',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'feature_' . $i . '_icon',
        array(
            'label'       => 'Feature ' . $i . ' Icon',
            'description' => 'Example: fa-lightbulb',
            'section'     => 'nexora_features_section',
            'type'        => 'text',
        )
    );


    $wp_customize->add_setting(
        'feature_' . $i . '_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'feature_' . $i . '_title',
        array(
            'label'   => 'Feature ' . $i . ' Title',
            'section' => 'nexora_features_section',
            'type'    => 'text',
        )
    );


    $wp_customize->add_setting(
        'feature_' . $i . '_description',
        array(
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'feature_' . $i . '_description',
        array(
            'label'   => 'Feature ' . $i . ' Description',
            'section' => 'nexora_features_section',
            'type'    => 'textarea',
        )
    );}
/* ========================================
   SERVICES
======================================== */

$wp_customize->add_section(
    'nexora_services_section',
    array(
        'title'    => __( 'Services Section', 'nexora-theme' ),
        'priority' => 33,
    )
);


/* SERVICES SECTION HEADING */

$services_heading = array(

    'services_eyebrow' => array(
        'label'   => 'Services Eyebrow',
        'default' => 'OUR SERVICES',
    ),

    'services_title' => array(
        'label'   => 'Services Title',
        'default' => 'What We Do',
    ),

    'services_description' => array(
        'label'   => 'Services Description',
        'default' => 'We provide end-to-end digital solutions to help your business grow and thrive in the digital world.',
    ),

);


foreach ( $services_heading as $setting => $data ) {

    $wp_customize->add_setting(
        $setting,
        array(
            'default'           => $data['default'],
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        $setting,
        array(
            'label'   => $data['label'],
            'section' => 'nexora_services_section',
            'type'    => $setting === 'services_description'
                ? 'textarea'
                : 'text',
        )
    );
}


/* INDIVIDUAL SERVICES */

for ( $i = 1; $i <= 6; $i++ ) {

    $wp_customize->add_setting(
        'service_' . $i . '_icon',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'service_' . $i . '_icon',
        array(
            'label'   => 'Service ' . $i . ' Icon',
            'section' => 'nexora_services_section',
            'type'    => 'text',
        )
    );


    $wp_customize->add_setting(
        'service_' . $i . '_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'service_' . $i . '_title',
        array(
            'label'   => 'Service ' . $i . ' Title',
            'section' => 'nexora_services_section',
            'type'    => 'text',
        )
    );


    $wp_customize->add_setting(
        'service_' . $i . '_description',
        array(
            'sanitize_callback' => 'sanitize_textarea_field',
        )
    );

    $wp_customize->add_control(
        'service_' . $i . '_description',
        array(
            'label'   => 'Service ' . $i . ' Description',
            'section' => 'nexora_services_section',
            'type'    => 'textarea',
        )
    );
}
}

add_action(
    'customize_register',
    'nexora_customize_register'
);