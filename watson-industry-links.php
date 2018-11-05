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
        // array(
        //   'type'        => 'colorpickeralpha',
        //   'heading'     => esc_attr__( 'Select Link Text Color', 'fusion-builder' ),
        //   'description' => esc_attr__( 'Select link text color and opacity ', 'fusion-builder' ),
        //   'param_name'  => 'link_color',
        //   'value'       => '',),
        // array(
        //   'type'        => 'colorpickeralpha',
        //   'heading'     => esc_attr__( 'Select Overlay Background Color', 'fusion-builder' ),
        //   'description' => esc_attr__( 'Select overlay background color and opacity (inactive state)', 'fusion-builder' ),
        //   'param_name'  => 'overlay_color',
        //   'value'       => '',),
        // array(
        //   'type'        => 'colorpickeralpha',
        //   'heading'     => esc_attr__( 'Select Overlay Background Hover Color', 'fusion-builder' ),
        //   'description' => esc_attr__( 'Select overlay background color and opacity (hover state)', 'fusion-builder' ),
        //   'param_name'  => 'overlay_color_hover',
        //   'value'       => '',),
        array(
          'type'        => 'upload',
          'heading'     => esc_attr__( 'Background Image', 'fusion-builder' ),
          'description' => esc_attr__( 'Link block background image', 'fusion-builder' ),
          'param_name'  => 'background_image',
          'value'       => '',),
        array(
          'type'        => 'textfield',
          'heading'     => esc_attr__( 'Height', 'fusion-builder' ),
          'description' => esc_attr__( 'Element height in px... include px in value eg: "300px", default is 300px', 'fusion-builder' ),
          'param_name'  => 'height',
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
    'background_image' => '',
    'overlay_color' => '',
    'overlay_color_hover' => '',
    'link_url' => '',
    'element_content' => '',
    'height' => '',
    'link_color' =>''
    ), $atts);

    $id = random_password();

    $styles = '<style scoped>
        .industry-link #' . $id . ' { 
          padding:' . $a["padding"] . ';
        }
       </style>';
        $height = '300px';
        if($a["height"]) $height = $a["height"];
    $block = '<div class="industry-link" style="height:' . $height . '; background-image:url(' . $a["background_image"] . ')">
      <div id="' . $id . '" class="block-overlay">' . 
      '  <a class="fusion-button button-flat fusion-button-square button-large button-default button-x" target="_self" href="' . $a['link_url'] . '">
            <span class="fusion-button-text">View Case Study</span>
          </a><hr>'
      . $content . '</div>' .$styles . '</div>';
    return $block;
}
add_shortcode('industrylink', 'industry_link');





// /* image overlay defaults to be set per project */
// .image-overlay-link {
//     width: 100%;
//     background-size: cover;
//     background-repeat: no-repeat;
//     background-position: center;
//     display:table;
// }
// .block-overlay {
//     height: 100%;
//     width: 100%;
//     padding:20px;
//     transition: 400ms all;
//     display: table-cell;
//     vertical-align: middle;
// }
// .image-overlay-link a { 
//   padding:;
//   background-color:transparent;
//   height: 200px;

// }
// .image-overlay-link a *{
//     color: ;
//     opacity: 0;
// }
// .image-overlay-link:hover a { 
//   background-color: rgba(0,0,0,.4);
// }
// .image-overlay-link:hover a *{
//     opacity: 1;
// }






// function spacesTable(){
//   $spaces = new WP_Query( array(
//     'post_type' => 'event_space'
//   ));
//   return print_r($spaces);
// }

// add_shortcode('event_spaces_table','spacesTable');
?>