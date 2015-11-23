{{ content() }}
{% for category in categories %}
	<div class="btn-group btn-group-justified">
		<div class="btn-group btn-group__large">
			{{ link_to('categories/' ~ category.id ~ '/elements', category.title, 'class': 'btn btn-default') }}
		</div>
		<div class="btn-group btn-group__small">
			{{ link_to('categories/' ~ category.id ~ '/elements/new', '', 'class': 'btn btn-success glyphicon glyphicon-plus') }}	
		</div>
	</div>
{% endfor %}
<div class="btn-group btn-group-justified">
	<div class="btn-group btn-group__large">
		{{ link_to('categories/', 'Разделы', 'class': 'btn btn-default') }}
	</div>
	<div class="btn-group btn-group__small">
		{{ link_to('categories/new', '', 'class': 'btn btn-success glyphicon glyphicon-plus') }}	
	</div>
</div>