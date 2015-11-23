<div class="container">
	<nav class="navbar navbar-default">
	 	<div class="container-fluid">
			<p class="navbar-left navbar-text"><strong>Домашняя бухгалтерия</strong></p>
			<p class="navbar-right navbar-text">
				<a href="javascript:void(0);"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
			</p>
	  	</div>
	</nav>
    {{ flash.output() }}
     {% if h1 is defined %}<h1>{{ h1 }}{% if h1_small is defined %} <br /><small>Раздел - {{ h1_small }}</small>{% endif %}</h1>{% endif %}
    {{ content() }}
</div>