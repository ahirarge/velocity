@extends('velocity::layout')

@section('title')
{{ $title }} 
@stop

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="list-group">
			  	<span class="list-group-item active">
			    	<h4 class="list-group-item-heading">
			    		{{ $record->controller }} 
			    		<small>
			    			[{{ $record->method }}]
			    		</small>
			    	</h4>
			    	<p class="list-group-item-text">
			    		URL: {{ $record->url }}
			    	</p>
			  	</span>
			</div>
			<ul class="list-group">
			  	<li class="list-group-item">
			    	Response Time
			    	<span class="badge">
			    		{{ number_format($record->response_time, 4) }}
			    	</span>
			  	</li>
			  	<li class="list-group-item">
			    	Memory Usage
			    	<span class="badge">
						{{ Velocity::sizeToStr($record->memory_usage) }}
			    	</span>
			  	</li>
			  	<li class="list-group-item">
			    	Create Date
			    	<span class="badge">
			    		{{ $record->created_at }}
			    	</span>
			  	</li>
			  	<li class="list-group-item">
			    	Update Date
			    	<span class="badge">
			    		{{ $record->updated_at }}
			    	</span>
			  	</li>
			</ul>

			<ul class="list-group">
			  	<li class="list-group-item">
			    	<h4 class="list-group-item-heading">
			    		POST DATAS
			    	</h4>
			    	<code>
			    		{{ $record->post_data }}
			    	</code>
			  	</li>

			</ul>
		</div>
	</div>

@stop