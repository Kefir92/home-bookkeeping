<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/utils.js') }}		
    </head>
    <body>
        {{ content() }}
    </body>
</html>