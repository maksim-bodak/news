<?php
/**
 * Theme by: MipThemes
 * http://themes.mipdesign.com
 *
 * Our portfolio: http://themeforest.net/user/mip/portfolio
 * Thanks for using our theme!
 */

if(!class_exists('MipThemeFramework_Thumbnailer')) {
	class MipThemeFramework_Thumbnailer {

		public function __construct() {
			add_theme_support( 'post-thumbnails' );
			$this->addActions();
		}

		private function addActions() {
			add_action('save_post', array($this, 'possiblyAddPostThumbnail'), 10, 2);
		}


		public function possiblyAddPostThumbnail($postId, $post=false) {
                    if (!$post) {
                            $post = get_post($postId);
                    }
                    if(false === (wp_is_post_autosave($postId) || wp_is_post_revision($postId)) && post_type_supports($post->post_type, 'thumbnail')) {

                        $thumbnail_overwite = get_post_meta( $postId, '_mp_featured_video_overwrite_thumbnail', true ) ? true : false;


                        // Set attachment as featured image if enabled
                        if ( !has_post_thumbnail($postId) || (bool)$thumbnail_overwite ) {


                            $video_url = get_post_meta( $postId, '_mp_featured_video', true ) ? get_post_meta( $postId, '_mp_featured_video', true ) : '';
                            if ( $video_url == '' ) {
                                $video_url = get_post_meta( $postId, '_mp_page_featured_video', true ) ? get_post_meta( $postId, '_mp_page_featured_video', true ) : '';
                            }

                            if ( $video_url != '' ) {
                                require_once(ABSPATH.'wp-includes/class-oembed.php');
                                $oembed= new WP_oEmbed;
                                $provider = $oembed->discover($video_url);
                                $video = $oembed->fetch($provider, $video_url, array('width' => 1200, 'height' => 1200));

                                $attachment_id = $this->save_to_media_library( $video->thumbnail_url, $postId );
                                if ( is_wp_error( $attachment_id ) ) {
                                    return $attachment_id;
                                }
                                set_post_thumbnail( $postId, $attachment_id );
                            }
                        }

                    }
		}


                /**
                * Creates a file name for use when saving an image to the media library.
                * It will either use a sanitized version of the title or the post ID.
                * @param  int    $post_id The ID of the post to create the filename for
                * @return string          A filename (without the extension)
                */
               static function construct_filename( $post_id ) {
                       $filename = get_the_title( $post_id );
                       $filename = sanitize_title( $filename, $post_id );
                       $filename = urldecode( $filename );
                       $filename = preg_replace( '/[^a-zA-Z0-9\-]/', '', $filename );
                       $filename = substr( $filename, 0, 32 );
                       $filename = trim( $filename, '-' );
                       if ( $filename == '' ) $filename = (string) $post_id;
                       return $filename;
               }


                /**
                * Saves a remote image to the media library
                * @param  string $image_url URL of the image to save
                * @param  int    $post_id   ID of the post to attach image to
                * @return int               ID of the attachment
                */
               public static function save_to_media_library( $image_url, $post_id ) {

                       $error = '';
                       $response = wp_remote_get( $image_url );
                       if( is_wp_error( $response ) ) {
                               $error = new WP_Error( 'thumbnail_retrieval', sprintf( esc_html__( 'Error retrieving a thumbnail from the URL <a href="%1$s">%1$s</a> using <code>wp_remote_get()</code><br />If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.', 'video-thumbnails' ), $image_url ) . '<br>' . esc_html__( 'Error Details:', 'video-thumbnails' ) . ' ' . $response->get_error_message() );
                       } else {
                               $image_contents = $response['body'];
                               $image_type = wp_remote_retrieve_header( $response, 'content-type' );
                       }

                       if ( $error != '' ) {
                               return $error;
                       } else {

                               // Translate MIME type into an extension
                               if ( $image_type == 'image/jpeg' ) {
                                       $image_extension = '.jpg';
                               } elseif ( $image_type == 'image/png' ) {
                                       $image_extension = '.png';
                               } elseif ( $image_type == 'image/gif' ) {
                                       $image_extension = '.gif';
                               } else {
                                       return new WP_Error( 'thumbnail_upload', esc_html__( 'Unsupported MIME type:', 'video-thumbnails' ) . ' ' . $image_type );
                               }

                               // Construct a file name with extension
                               $new_filename = self::construct_filename( $post_id ) . $image_extension;

                               // Save the image bits using the new filename
                               do_action( 'video_thumbnails/pre_upload_bits', $image_contents );
                               $upload = wp_upload_bits( $new_filename, null, $image_contents );
                               do_action( 'video_thumbnails/after_upload_bits', $upload );

                               // Stop for any errors while saving the data or else continue adding the image to the media library
                               if ( $upload['error'] ) {
                                       $error = new WP_Error( 'thumbnail_upload', esc_html__( 'Error uploading image data:', 'video-thumbnails' ) . ' ' . $upload['error'] );
                                       return $error;
                               } else {

                                       do_action( 'video_thumbnails/image_downloaded', $upload['file'] );

                                       $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );

                                       $upload = apply_filters( 'wp_handle_upload', array(
                                               'file' => $upload['file'],
                                               'url'  => $upload['url'],
                                               'type' => $wp_filetype['type']
                                       ), 'sideload' );

                                       // Contstruct the attachment array
                                       $attachment = array(
                                               'post_mime_type'	=> $upload['type'],
                                               'post_title'		=> get_the_title( $post_id ),
                                               'post_content'		=> '',
                                               'post_status'		=> 'inherit'
                                       );
                                       // Insert the attachment
                                       $attach_id = wp_insert_attachment( $attachment, $upload['file'], $post_id );

                                       // you must first include the image.php file
                                       // for the function wp_generate_attachment_metadata() to work
                                       require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                       do_action( 'video_thumbnails/pre_generate_attachment_metadata', $attach_id, $upload['file'] );
                                       $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
                                       do_action( 'video_thumbnails/after_generate_attachment_metadata', $attach_id, $upload['file'] );
                                       wp_update_attachment_metadata( $attach_id, $attach_data );

                                       // Add field to mark image as a video thumbnail
                                       update_post_meta( $attach_id, 'video_thumbnail', '1' );

                               }

                       }

                       return $attach_id;

               }


	}

	global $MipThemeFramework_Thumbnailer;
	$MipThemeFramework_Thumbnailer = new MipThemeFramework_Thumbnailer;
}
