<?php
class CategoryRESTController extends WPAPIRESTController {
	protected function __construct() {}
	
	protected function getCategories() {
		global $wpdb;
		$categories = get_categories('hide_empty=0&orderby=count&order=ASC');
		
		// Return categories usgin WordPress native function. (This can be replaced with a custom function)
		if(isset($categories[1]))
			return $this->_return($categories);
		else
			return $this->_return($categories[0]);
		
	}
	
	protected function getCategory($category = 0) {
		$categories = get_tags('hide_empty=0&orderby=count&order=ASC&include='.$category);
		if(isset($categories[1]))
			return $this->_return($categories);
		else
			return $this->_return($categories[0]);
	}
	
	/**
	 * Apply request filter
	 * 
	 * @since 0.1
	 * 
	 * @return (mixed) filtered content
	 */
	private function _return($content) {
		return wpr_filter_content($content,wpr_get_filter("Categories"));
	}
}
?>