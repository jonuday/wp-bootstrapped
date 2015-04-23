<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <label class="screen-reader-text" for="s">Search for:</label>
    <input class="form-control" type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="search..." />
    <input type="submit" class="btn" value="Search" />
</form>