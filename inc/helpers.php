<?php
/**
 * @param string $file
 * @param mixed $args
 * @param string $default_folder
 *
 * @author DimonPDAA, SemAlley
 * */
function show_template( $file, $args = null, $default_folder = 'parts' ) {
    $file = $default_folder . '/' . $file . '.php';
    if ( $args ) {
        extract( $args );
    }
    if ( locate_template( $file ) ) {
        include (locate_template( $file )); //Theme Check free. Child themes support.
    }
}
/**
 * @param string $file
 * @param mixed $args
 * @param string $default_folder
 * @return String
 * @author DimonPDAA
 * */
function return_template($file, $args = null, $default_folder = 'parts'){
    $file = $default_folder . '/' . $file . '.php';
    if ( $args ) {
        extract( $args );
    }
    if ( locate_template( $file ) ) {
        ob_start();
        include (locate_template( $file )); //Theme Check free. Child themes support.
        $template_content = ob_get_contents();
        ob_end_clean();
        return $template_content;
    }
    return '';
}
/* get thumbnail image */
/**
 * @var int $id
 * @var string $size = 'full'
 * @return string
 * @author DimonPDAA
 */
function get_attached_img_url( $id, $size = "full" ) {
    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );

    return $img[0];
}

// Dynamic admin function
/**
 * @var string $column_name
 * @var int $post_id
 * @return void
 * @author DimonPDAA
 */
function template_detail_field_for_page( $column_name, $post_id ) {
    if ( $column_name == 'template' ) {
        $template_name = str_replace( '.php', '', get_post_meta( $post_id, '_wp_page_template', true ) );
        echo '<span style="text-transform: capitalize;">' . str_replace('/', '', substr( $template_name, strpos( $template_name, '/' ), strlen( $template_name ) )) . ' Page</span>';
    }
    return;
}
/**
 * @var array $img
 * @var string $size
 * @return void
 * @author DimonPDAA
 */
function bg($img , $size = ''){
    if($img && is_array($img)){
        $url = $size ? $img['sizes'][$size] : $img['url'];
        echo 'style="background-image: url('.$url.')"';
    } elseif ($img) {
	    echo 'style="background-image: url('.$img.')"';
    }
}