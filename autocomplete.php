<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php' );
if (!$wpdb) {
    $wpdb = new wpdb( 'USER', 'SENHA', 'BANCO', 'HOST');
} else {
    global $wpdb;
}
?>


<?php

$arr=array();

$chars = trim($_GET['chars']);
$result = $wpdb->get_results( "SELECT baseishop_posts.ID, baseishop_posts.post_title, baseishop_postmeta.meta_value
	FROM $wpdb->posts, $wpdb->postmeta
	WHERE post_type = 'product' 
	AND post_title LIKE '%$chars%' AND 
	baseishop_postmeta.post_id = baseishop_posts.ID AND baseishop_postmeta.meta_key = '_regular_price'");

$results = array();

foreach ( $result as $data ) {

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($data->ID), apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
$url = $thumb['0'];

$link = get_permalink( $data->ID );

    
$arr[]=array(
			'id'		=> $link,
                        'data'		=> $data->post_title,
                        'description'	=> $data->meta_value,
                        'thumbnail'     => $url,
	);

}
  
echo json_encode($arr);

//$json =   wp_send_json($data);                         





        
