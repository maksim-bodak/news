<?php
    $mip_current_page   = new MipThemeFramework_Page();
?>
<!-- start:sidebar -->
<div id="sidebar" class="sidebar">
    <div class="theiaStickySidebar">
  	<?php
  	    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
      		if ( ($mip_current_page->page_sidebar_source != 'None') && !empty($mip_current_page->page_sidebar_source) ) :
      		    dynamic_sidebar ( $mip_current_page->page_sidebar_source );
      		else :
      		    dynamic_sidebar( 'primary-widget-area' );
      		endif;
  	    endif;
  	?>
    </div>
</div>
<!-- end:sidebar -->
