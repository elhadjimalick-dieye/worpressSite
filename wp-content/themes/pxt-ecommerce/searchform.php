<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url() ); ?>" _lpchecked="1">
	<fieldset>
		<input type="text" name="s" id="s" placeholder="<?php esc_attr_e('Search for...','pxt-ecommerce'); ?>" />
		<input type="submit" value="<?php esc_attr_e( 'Search', 'pxt-ecommerce' ); ?>" />
	</fieldset>
</form>
