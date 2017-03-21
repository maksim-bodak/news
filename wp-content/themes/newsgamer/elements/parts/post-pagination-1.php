<?php
    /*
     * Thx Kriesi for this code
     * http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
    */

    if ( ! function_exists( 'mipthemeframework_set_post_pagination' ) ) {
        function mipthemeframework_set_post_pagination($wp_query) {
            if ($wp_query->max_num_pages > 1) :

                $pages = '';
                $range = 3;

                $showitems = ($range * 2)+1;

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                if(empty($paged)) $paged = 1;

                if($pages == '')
                {
                    global $wp_query;
                    $pages = $wp_query->max_num_pages;
                    if(!$pages)
                    {
                        $pages = 1;
                    }
                }

                if(1 != $pages)
                {
                    echo '<div class="post-pagination">';
                    echo '<span class="info">'. esc_html__('Page', 'Newsgamer') .' '.$paged.' '. esc_html__('of', 'Newsgamer') .' '.$pages.'</span>';
                    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<a href="'.get_pagenum_link(1).'" title="'. esc_html__('Go to first page', 'Newsgamer') .'"><i class="fa fa-chevron-left"></i></a><span class="bullets">...</span>';
                    if($paged > 1 && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged - 1).'" title="'. esc_html__('Previous page', 'Newsgamer') .'"><i class="fa fa-chevron-left"></i></a>';

                    for ($i=1; $i <= $pages; $i++)
                    {
                        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                        {
                            echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                        }
                    }

                    if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'" title="'. esc_html__('Next page', 'Newsgamer') .'"><i class="fa fa-chevron-right"></i></a>';
                    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<span class="bullets">...</span><a href="'.get_pagenum_link($pages).'" title="'. esc_html__('Go to last page', 'Newsgamer') .'"><i class="fa fa-chevron-right"></i></a>';
                    echo '</div>';
                }

            endif;
        }
    }
    mipthemeframework_set_post_pagination($wp_query);

?>
