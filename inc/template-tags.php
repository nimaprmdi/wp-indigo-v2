<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wp-indigo
 */

if ( ! function_exists( 'wp_indigo_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_indigo_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'wp-indigo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_indigo_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function wp_indigo_posted_by(  $wp_indigo_custom_class = "" ) {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'wp-indigo' ),
			'<span class="author vcard"><a class="'.esc_attr( $wp_indigo_custom_class ).' h6 url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'wp_indigo_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function wp_indigo_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'wp-indigo' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wp-indigo' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wp-indigo' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp-indigo' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wp-indigo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-indigo' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'wp_indigo_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function wp_indigo_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
</div><!-- .post-thumbnail -->

<?php else : ?>

<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
    <?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
</a>

<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'wp_indigo_get_custom_category' ) ) :
	/**
	 * Get category lists
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */ 

	function wp_indigo_get_custom_category($wp_indigo_seprator = " ", $wp_indigo_custom_class = "c-post__cat", $wp_indigo_is_limited = false) {

		if( ! empty( get_the_category() ) ){
			/* get category */
			$categories = get_the_category();
			$separator = $wp_indigo_seprator;
			$output = '';
			$category_counter = 0;
			if ( ! empty( $categories ) ) {
			
				foreach( $categories as $category ) {

					if( $wp_indigo_is_limited === true && $category_counter === 3){
						break;
					}
		
					$category_counter++;
					/* translators: used between list items, there is a space after the comma */
					$output .= '<a class="'.esc_attr(  $wp_indigo_custom_class ).'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'wp-indigo' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
				echo  wp_kses_post(trim( $output, $separator ));
			}
		}

	}
endif;


if ( ! function_exists( 'wp_indigo_get_post_date' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function wp_indigo_get_post_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'wp-indigo' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;


if (! function_exists('wp_indigo_get_default_pagination')) :
	/**
	* Show numeric pagination
	*/
	function wp_indigo_get_default_pagination() {
		echo'<div class="c-pagination">' . wp_kses_post(
			paginate_links(
				array(
				'prev_text'          => __( 'Previous', 'wp-indigo' ),
				'next_text'          => __( 'Next', 'wp-indigo' ),
				)
			)) .'</div>';
	}
endif;


if ( ! function_exists( 'wp_indigo_share_links' ) ) {
	/**
	  * Display Share icons 
	  */
	function wp_indigo_share_links( $wp_indigo_share_title = true ) {
		if ( get_theme_mod( 'show_share_icons', true ) ) {
			
			$wp_indigo_linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink() . "&title=" . get_the_title();
			$wp_indigo_twitter_url  = "https://twitter.com/intent/tweet?url=" . get_permalink() . "&title=" . get_the_title();
			$wp_indigo_facebook_url = "https://www.facebook.com/sharer.php?u=" . get_permalink();


			if($wp_indigo_share_title){
				printf('<span class="c-social-share__title h6 u-letter-space-regular">');// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo esc_html_e( 'Share on:' , 'wp-indigo' );
				printf( '</span>' );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			echo '<div class="c-social-share__items">';
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-facebook-alt c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_facebook_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-twitter c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_twitter_url ) );
			echo sprintf( '<a class="c-social-share__item" target="_blank" href="%s"><span class="dashicons dashicons-linkedin c-social-share__item__icon"></span></a>', esc_url( $wp_indigo_linkedin_url ) );
			echo '</div>';
			
		}
	}
}

if ( ! function_exists( 'wp_indigo_socials_links' ) ) :
	/**
	 * Display Social Networks
	 */
	function wp_indigo_socials_links() {
		$wp_indigo_facebook  = get_theme_mod( 'facebook', "" );
		$wp_indigo_twitter   = get_theme_mod( 'twitter', "" );
		$wp_indigo_instagram = get_theme_mod( 'instagram', "" );
		$wp_indigo_linkedin  = get_theme_mod( 'linkedin', "" );
		$wp_indigo_github    = get_theme_mod( 'github', "" );

		if ( $wp_indigo_facebook ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-facebook-alt"></span></a>', esc_url( $wp_indigo_facebook ), esc_html__( 'Facebook', 'wp_indigo' ) );
		}

		if ( $wp_indigo_twitter ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-twitter"></span></a>', esc_url( $wp_indigo_twitter ), esc_html__( 'Twitter', 'wp_indigo' ) );
		}

		if ( $wp_indigo_instagram ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-instagram"></span></a>', esc_url( $wp_indigo_instagram ), esc_html__( 'Instagram', 'wp_indigo' ) );
		}

		if ( $wp_indigo_linkedin ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>', esc_url( $wp_indigo_linkedin ), esc_html__( 'Linkedin', 'wp_indigo' ) );
		}

		if ( $wp_indigo_github ) {
			echo sprintf( '<a href="%s" aria-label="%s" class="c-social-share__item" target="_blank"><span class="iconify" data-icon="ant-design:github-filled" data-inline="false"></span></a>', esc_url( $wp_indigo_github ), esc_html__( 'Github', 'wp_indigo' ) );
		}
	}
endif;

if ( ! function_exists('wp_indigo_get_current_page_name')) :
	/**
	  * Get current page name (slug)
	  */
	function wp_indigo_get_current_page_name() {

		global $post;
		$post_slug = $post->post_name;
		$post_slug = str_replace("-", " ", $post_slug);
		$page_name = esc_html($post_slug);
		echo esc_html($post_slug);
			
	}
endif;


if (! function_exists('wp_indigo_get_home_section_close_tag')) :
	/**
	 * Add class depend on page
	 */
	function wp_indigo_get_home_section_close_tag() {
		if ( is_page_template( 'page-template/home.php' || is_404() ) ) {
			echo "</section>";
		}
		else{
			return;
		}
	}
endif;


if ( ! function_exists( 'wp_indigo_taxonomy_filter' ) ) :
	/**
	 *  Return taxonomy filter with (active class)
	 */
	function wp_indigo_taxonomy_filter( $wp_indigo_className = "" ,  $wp_indigo_getSeparator = ", " , $wp_indigo_is_limited = false ,  $wp_indigo_taxonomy = "category" , $wp_indigo_hard_limit = false ) {
		
		global $wp_query;
		
		$taxonomies = get_terms( array(
			'taxonomy' => $wp_indigo_taxonomy,
			'hide_empty' => false
		) );
		
		$taxonomny_counter = 0;
		$separator = $wp_indigo_getSeparator;
			
		$wp_indigo_all_active_class = "";
		if(empty($wp_query->query['portfolio_category'])){
			$wp_indigo_all_active_class = "active";
		}

		echo '<a class="'.esc_attr( $wp_indigo_className ).' '.esc_attr( $wp_indigo_all_active_class ).'" href='.site_url().'/'.get_post_type().'>';
		echo esc_html_e( 'All ', 'wp-indigo' );
		echo '</a>';

		if ( !empty($taxonomies) ) {
			$output = '';


			foreach( $taxonomies as $category ) {

				if($wp_indigo_is_limited === true && $taxonomny_counter === 4 || $wp_indigo_hard_limit === true && $taxonomny_counter === 1){
					break;
				}

				if(!empty($wp_query->query['portfolio_category'])){
					$current_category = $wp_query->query['portfolio_category'];
				}			
				if($category != null && !empty($wp_query->query['portfolio_category'])  && $category->slug  === $current_category){
					$classactive = "active";
				}
				else{
					$classactive = "";
				}

				$taxonomny_counter++;

				if ($category->count != 0) {
					/* translators: return poject_category items for filtering */
					$output .= '<a class="'.esc_attr($wp_indigo_className). ' ' .esc_attr( $classactive ).'" href="'. site_url() . '/'. get_post_type().'/?'.$wp_indigo_taxonomy.'=' . esc_html( $category->slug ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'wp-indigo' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
				}
			}
			echo wp_kses_post(trim( $output , $separator ));
		}		
	}
endif;


if ( ! function_exists( 'wp_indigo_category_filter' ) ) :
	/**
	  *  Return Category filter
	  */
	function wp_indigo_category_filter( $wp_indigo_className = "" ) {
		$categories = get_categories();
		global $wp_query;
	
		$wp_indigo_all_active_class = "";
		if(empty($wp_query->query['category_name'])){
			$wp_indigo_all_active_class = "active";
		}
		
		echo '<a class="'.esc_attr( $wp_indigo_className ).' '.esc_attr( $wp_indigo_all_active_class ).'" href='.site_url().'/blog>';
		echo esc_html_e( 'All ', 'wp-indigo' );
		echo '</a>';
		
		foreach($categories as $category) {
			$classactive = "";
			
			// Check not empty 
			if(!empty($wp_query->query['category_name'])){
				// get current category 
				$current_category = $wp_query->query['category_name'];				
			}
			// Check if current category match with url (and add active class) 
			if($category != null && !empty($wp_query->query['category_name'])  && $category->slug == $current_category){
				$classactive = "active";
			}
			// The output
			echo '<a class="'.$wp_indigo_className.' '.$classactive.'" href="'. site_url() . '/blog/?category_name=' . esc_html( $category->slug ) . '">' . $category->name . '</a>';
		}
	}	
endif;


if ( ! function_exists( 'wp_indigo_get_taxonomy' ) ) :
    /**
	  * 
	  * Display Post Tags (Custom taxonomy)
      */
    function wp_indigo_get_taxonomy( $wp_indigo_taxonomy_name = "" , $wp_indigo_class_name = "" , $wp_indigo_tag_name = "span" , $wp_indigo_seprator = "" ) {
        $wp_indigo_custom_taxs = get_the_terms( get_the_ID(), $wp_indigo_taxonomy_name );
	
		$wp_indigo_output = "";

        if (is_array($wp_indigo_custom_taxs) && !empty($wp_indigo_custom_taxs)) {
            if( !empty( $wp_indigo_taxonomy_name ) ){
                foreach ( $wp_indigo_custom_taxs as $tax ) {
                    $wp_indigo_output .= '<'. esc_html($wp_indigo_tag_name) .' class="'.esc_attr(  $wp_indigo_class_name  ).' " href="'.esc_url( get_tag_link( $tax->term_id ) ).'">' . __( $tax->name ) . '</'. esc_html($wp_indigo_tag_name) .'>';
                }
				echo wp_kses_post($wp_indigo_output  );
            }
        }
    }
endif;