<form method="get" class="search-form" action="<?php echo home_url( '/' ); ?>" autocomplete="off">
  <div class="search-field-w">
    <input type="search" autocomplete="off" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'osetin' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'osetin' ) ?>" />
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'osetin' ) ?>" />
  </div>
</form>