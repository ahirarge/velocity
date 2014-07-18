<td>
	<strong>
		<a href="/ahir/velocity/row_detail/{{ $value->id }}">
			{{ ( ($lives->getCurrentPage() - 1) * 15 + $key + 1) }})
		</a>
	</strong>
</td>
<td>
	@if ($value->method == 'GET')
		<span class="label label-success">
			{{ $value->method }}
		</span>
	@else 
		<span class="label label-danger">
			{{ $value->method }}
		</span>
	@endif 
</td>
<td>
	<a href="/ahir/velocity/url_detail/{{ $value->id }}">
		{{ $value->url }}
	</a>
</td>
<td>
	<a href="/ahir/velocity/controller_detail/{{ $value->id }}">
		{{ $value->controller }}
	</a>
</td>

