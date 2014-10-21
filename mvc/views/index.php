{% extends layout.base %}
{% block content %}
	<h2>{{ data.titulo }}</h2>
	<p>{{ data.mensaje }} </p>
	<p> {{ Route::assets("js/jquery.min.js") }} </p>
	<p> {{ Route::action("HolaController@hola2", array("mensaje2"=>"...hola mundo 2...", "mensaje"=>"...hola mundo...")) }} </p>
	<p>
		<div>Enlace:</div>
		<span>
			{{ HTML::a('HolaController@hola2', "Hola 2", array("class"=>"boton"), array("mensaje2"=>"...hola mundo 2...", "mensaje"=>"...hola mundo...") ) }}
		</span>
	</p>
	<p>
		<div>Enlace:</div>
		<span>
			{{ HTML::a('https://google.com/', "Google", array("class"=>"boton")) }}
		</span>
	</p>
{% endblock content %}

{% block footer %}
	<footer>Footer</footer>
{% endblock footer %}