<?php 

Route::group(
	array(
		'prefix' => 'ahir/velocity',
		'before' => Config::get('velocity::monitor_filter')
	), function() {
		Route::get('/', 'VelocityStatsController@getLive');
		Route::get('slowspeed', 'VelocityStatsController@getSlowspeed');
		Route::get('memory_usage', 'VelocityStatsController@getMemoryUsage');
		Route::get('stats', 'VelocityStatsController@getStats');
		Route::get('row_detail/{id}', 'VelocityDetailController@getDetail');
	}
);


