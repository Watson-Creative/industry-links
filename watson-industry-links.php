<?php
   /*
   Plugin Name: Industry Links for Watson
   Plugin URI: https://github.com/Watson-Creative/industry-links
   GitHub Plugin URI: https://github.com/Watson-Creative/industry-links
   description: Based on image hover element plugin. Specific to watsoncreative.com
   Version: 1.0.0
   Author: Barton White, Alex Tryon
   Author URI: http://www.watsoncreative.com
   License: GPL2
   */

function industry_link_styles() {
  wp_enqueue_style( 'industry-link-styles', plugins_url( '/industry-link-styles.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'industry_link_styles' );

function fusion_element_industry_link_block() {


    fusion_builder_map( array(
        'name'            => esc_attr__( 'Industry Link', 'fusion-builder' ),
        'shortcode'       => 'industrylink',
        'icon'       => 'fusiona-image',
        'params'          => array(
          array(
          'type'        => 'link_selector',
          'heading'     => esc_attr__( 'Link', 'fusion-builder' ),
          'description' => esc_attr__( 'Select \'view case study\' link', 'fusion-builder' ),
          'param_name'  => 'link_url',
          'value'       => '',),
        array(
          'type'        => 'tinymce',
          'heading'     => esc_attr__( 'Link Text', 'fusion-builder' ),
          'description' => esc_attr__( 'Enter copy with link e.g.: or View Brand Strategy. Goes beneath case study button', 'fusion-builder' ),
          'param_name'  => 'element_content',
          'value'     => '',
          'placeholder' => true),
        array(
          'type'        => 'upload',
          'heading'     => esc_attr__( 'Background Image', 'fusion-builder' ),
          'description' => esc_attr__( 'Link block background image', 'fusion-builder' ),
          'param_name'  => 'background_image',
          'value'       => '',),
        array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Height', 'fusion-builder' ),
          'description' => esc_attr__( 'Element height in px... include px in value eg: "300px", default is 321px', 'fusion-builder' ),
          'param_name'  => 'height',
          'value'       => '',),
        array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Spacing', 'fusion-builder' ),
          'description' => esc_attr__( 'Spacing between the button and link px... include px in value eg: "10px", default is 10px', 'fusion-builder' ),
          'param_name'  => 'spacing',
          'value'       => '',),
         array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Padding', 'fusion-builder' ),
          'description' => esc_attr__( 'Element padding in valid css notation... include px/%/em in value eg: "300px, 2%"', 'fusion-builder' ),
          'param_name'  => 'padding',
          'value'       => '',)
        )
    ) );
}
add_action( 'fusion_builder_before_init', 'fusion_element_industry_link_block' );

function random_password( $length = 22 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function industry_link( $atts, $content = null ){
    $a = shortcode_atts( array(
    'link_url' => '',
    'element_content' => '',
    'background_image' => '',
    'height' => '',
    'spacing' => '',
    'padding' => ''
    ), $atts);

    $id = random_password();

    $styles = '<style scoped>
        .industry-link #' . $id . ' { 
          padding:' . $a["padding"] . ';
        }
       </style>';

    $height = '321px';
    if($a["height"]) $height = $a["height"];

    $spacing = '10px';
    if($a["spacing"]) $spacing = $a["spacing"];

    $tags = array("<p>", "</p>", "<h1>", "</h1>", "<h2>", "</h2>", "<h3>", "</h3>");
    $content = str_replace($tags, "", $content);

    $block = '<div class="industry-link" style="height:' . $height . '; background-image:url(' . $a["background_image"] . ')">
      <div id="' . $id . '" class="block-overlay">' . 
      '  <a class="fusion-button button-flat fusion-button-square button-large button-default button-x" target="_self" href="' . $a['link_url'] . '">
            <span class="fusion-button-text">View Case Study</span>
          </a>
      <div class="fusion-sep-clear"></div>
      <div class="fusion-separator fusion-full-width-sep sep-none" style="margin-left: auto;margin-right: auto;margin-top:;margin-bottom:'. $spacing .';"></div><p>'
      . $content . '</p></div>' .$styles . '</div>';
    return $block;
}
add_shortcode('industrylink', 'industry_link');

?>