<?php

// Initialize custom post types

add_action('init', 'exibio_alch_cpt');
function exibio_alch_cpt() {

	// Set tamogatoi post type

	$labels_tamogatoi = array(
		'name'               => _x( 'Támogatói blokk', 'tamogatoik', 'atlatszo' ),
		'singular_name'      => _x( 'Támogatói', 'tamogatoi', 'atlatszo' ),
		'menu_name'          => _x( 'Támogatói blokkok', 'admin menu', 'atlatszo' ),
		'name_admin_bar'     => _x( 'Támogatói', 'add new on admin bar', 'atlatszo' ),
		'add_new'            => _x( 'Új támogatói blokk', 'tamogatoi', 'atlatszo' ),
		'add_new_item'       => __( 'Új támogatói blokk hozzáadása', 'atlatszo' ),
		'new_item'           => __( 'ÚJ támogatói blokk', 'atlatszo' ),
		'edit_item'          => __( 'Támogatói blokk szerkesztése', 'atlatszo' ),
		'view_item'          => __( 'Támogatói blokk megtekintése', 'atlatszo' ),
		'all_items'          => __( 'Összes támogatói blokk', 'atlatszo' ),
		'search_items'       => __( 'Támogatói blokk keresése', 'atlatszo' ),
		'parent_item_colon'  => __( 'Támogatói blokk szülő', 'atlatszo' ),
		'not_found'          => __( 'Támogatói blokk nem található.', 'atlatszo' ),
		'not_found_in_trash' => __( 'Támogatói nem található a lomtárban.', 'atlatszo' )
	);

	$args_tamogatoi = array(
		'labels'             => $labels_tamogatoi,
		'description'        => __( 'Description.', 'atlatszo'),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tamogatoi' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'menu_icon' => 'dashicons-layout',
	);

	register_post_type( 'tamogatoi', $args_tamogatoi );

	$labels_tamogatoi = array(
		'name'               => 'Támogatói kategória',
		'singular_name'      => 'Támogatói kategória',
		'menu_name'          => 'Támogatói kategóriák',
		'name_admin_bar'     => 'Támogatói kategóriák',
		'add_new'            => 'Új hozzáadása',
		'add_new_item'       => 'Új támogatói kategória hozzáadása',
		'new_item'           => 'Új támogatói kategória',
		'edit_item'          => 'Támogatói kategória szerkesztése',
		'view_item'          => 'Támogatói kategória megtekintése',
		'all_items'          => 'Összes támogatói kategória',
		'not_found'          => 'Támogatói kategória nem található'
	);

	register_taxonomy(
		'tamogatoi-kategoria',
		'tamogatoi',
		array(
			'label' => __('Type'),
			'rewrite' => array( 'slug' => 'tamogatoi-kategoria' ),
			'hierarchical' => true,
			'labels' => $labels_tamogatoi,
		)
	);
	
/*
	$labels_dosszie = array(
		'name'               => 'Dosszié',
		'singular_name'      => 'Dosszié',
		'menu_name'          => 'Dossziék',
		'name_admin_bar'     => 'Dossziék',
		'add_new'            => 'Új hozzáadása',
		'add_new_item'       => 'Új dosszié hozzáadása',
		'new_item'           => 'Új dosszié',
		'edit_item'          => 'Dosszié szerkesztése',
		'view_item'          => 'Dosszié megtekintése',
		'all_items'          => 'Összes dosszié',
		'not_found'          => 'Dosszié nem található'
	);

	register_taxonomy(
		'dosszie',
		'post',
		array(
			'label' => __('Type'),
			'rewrite' => array( 'slug' => 'dossziek' ),
			'hierarchical' => true,
			'labels' => $labels_dosszie,
		)
	);
*/


/*
	$labels_tamogatoi_tag = array(
		'name'               => 'Támogatói tags',
		'singular_name'      => 'Támogatói tag',
		'menu_name'          => 'Támogatói tags',
		'name_admin_bar'     => 'Támogatói tags',
		'add_new'            => 'Add New hozzáadása',
		'add_new_item'       => 'Add New tamogatoi tag',
		'new_item'           => 'Add New tamogatoi tag',
		'edit_item'          => 'Edit Támogatói tag',
		'view_item'          => 'View Támogatói tag',
		'all_items'          => 'All tamogatoi tags',
		'not_found'          => 'Támogatói tag not found'
	);

	register_taxonomy(
		'tamogatoi-tag',
		'tamogatoi',
		array(
			'label' => __('Type'),
			'rewrite' => array( 'slug' => 'tamogatoi-tag' ),
			'hierarchical' => false,
			'labels' => $labels_tamogatoi_tag,
		)
	);*/

}

add_filter( 'manage_edit-tamogatoi_columns', 'my_edit_tamogatoi' ) ;
function my_edit_tamogatoi( $columns ) {

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Title' ),
        'type' => __('Type'),
        'date' => __('Date'),
        'reference_name' => __('Hivatkozási név', 'atlatszo'),
        'opacity' => __('Kép átlátszóság'),
        'image' => __('Image')
    );

    return $columns;
}

add_action( 'manage_tamogatoi_posts_custom_column', 'my_manage_tamogatoi_columns', 10, 2 );
function my_manage_tamogatoi_columns ($column, $post_id) {
    global $post;
    switch($column) {

        case 'type' :

            $terms = get_the_terms( $post_id, 'tamogatoi-kategoria' );

            if ( !empty( $terms ) ) {

                $out = array();

                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'tamogatoi-kategoria' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'tamogatoi-kategoria', 'display' ) )
                    );
                }

                echo join( ', ', $out );
            }

            else {
                _e( 'None' );
            }

            break;

        case 'reference_name' :
        	
        	echo get_post_meta($post_id, 'blokk_hivatkozasi_nev', true);

        break;

        case 'opacity' :
        	
        	$opacity=get_post_meta($post_id, 'kep_atlatszosag', true);
        	if ($opacity) {
        		$opacity=floatval($opacity*100);
        		echo $opacity."%";
        	} else {
        		echo "-";
        	}

        break;

        case 'image' :
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
            if ( ! empty( $large_image_url[0] ) ) {
                add_thickbox();
                echo '<a class="thickbox" href="' . esc_url( $large_image_url[0] ) . '" title="' . the_title_attribute( array( 'echo' => 0 ) ) . '">';?>
                    <img style="width:100px;height:100px;" src="<?php echo esc_url( $thumb_image_url[0] );?>"/>
                </a>
            <?php }
            break;

        default :
            break;
    }
}
?>