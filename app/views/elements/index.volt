{{ link_to(addUrl, '<i class="glyphicon glyphicon-plus"></i> Добавить', 'class': 'btn btn-back btn-success') }}
{% if elements %}
	<table class="table table-stripped">
		<tr>
			<td>Дата</td>
			<td>Теги</td>
			<td>Сумма</td>
			<td></td>
		</tr>
		{% for element in elements %}
			<tr>
				<td class="td__date">{{ date('d.m.Y', strtotime(element.created)) }}</td>
				<td>
					{% if element.elementsHashtags %}
						{% for elementHashtags in element.elementsHashtags %}
							<span class="label label-primary">{{ elementHashtags.hashtags.title }}</span>
						{% endfor %}				
					{% endif %}
				</td>
				<td>{{ element.sum }}</td>
				<td width="40">
					{{ link_to(['for': 'edit_element', 'elementID': element.id, 'categoryID': categoryID], '', 'class': 'btn btn-primary btn-xs  glyphicon glyphicon-pencil') }}
				</td>
			</tr>
		{% endfor %}
	</table>

{% else %}
	<div>Записей не найдено.</div>
{% endif %}