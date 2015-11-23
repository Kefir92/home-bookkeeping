{{ link_to('categories/new', '<i class="glyphicon glyphicon-plus"></i> Добавить', 'class': 'btn btn-back btn-success') }}
<table class="table table-bordered">
	{% for element in elements %}
		<tr>
			<td>{{ element.getTitleFull() }}</td>
			<td width="40">
				{{ link_to('categories/edit/' ~ element.id, '', 'class': 'btn btn-primary btn-xs  glyphicon glyphicon-pencil') }}
				<?/*{{ link_to('categories/delete/' ~ element.id, '', 'class': 'btn btn-danger btn-xs glyphicon glyphicon-remove') }}*/?>
			</td>
		</tr>
	{% endfor %}
</table>