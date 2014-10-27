<?php 

return array(

		// Activation 
		'active' => true,

		// Unmonitored Urls
		'ban_url_array' => array(
                'ahir/velocity',
                'ahir/velocity/slowspeed',
                'ahir/velocity/memory_usage',
                'ahir/velocity/stats',
                'ahir/velocity/row_detail',
                'ahir/velocity/url_detail',
                'ahir/velocity/controller_detail'
			),

		// Monitor filter for user login
		'monitor_filter' => 'Sentry'

	);