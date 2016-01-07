<?php
	//custom helper function 
    //added on 2015/12/09
	//===========================
	if (!function_exists('formatPrice')) {
		/**
		 * Format integer to a price
		 *
		 * @param integer $price
		 *
		 * @return string
		 */
		function formatPrice($price)
		{
			return number_format($price,2);
		}
	}
?>