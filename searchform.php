<form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <label class="screen-reader-text" for="s">Search for:</label>
    <div class="input-group">
	    <input class="form-control" type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="search..." />
	    <span class="input-group-btn"><button type="submit" class="btn" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></span>
	</div>
</form>