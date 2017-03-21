<form id="search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <input type="text" name="s" placeholder="<?php esc_html_e('Search', 'Newsgamer'); ?> <?php bloginfo('name'); ?>" value="<?php echo get_search_query(); ?>" />
    <button><span class="glyphicon glyphicon-search"></span></button>
</form>
