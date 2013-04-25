Agregué los selectores necesarios para cumplir lo indicado entre comentarios

<!DOCTYPE html>
<html>
<head>
<title>Ejercicio de selectores</title>
<style type="text/css">
/* Todos los elementos de la pagina */
{ 
	font: 1em/1.3 Arial, Helvetica, sans-serif; 
}
 
/* Todos los parrafos de la pagina */
{ 
	color: #555; 
}
 
/* Todos los párrafos contenidos en #primero */
{ 
	color: #336699; 
}
 
/* Todos los enlaces la pagina */
{ 
	color: #CC3300; 
}
 
/* Los elementos "em" contenidos en #primero */
{ 
	background: #FFFFCC; 
	padding: .1em; 
}
 
/* Todos los elementos "em" de clase "especial" en toda la pagina */
{ 
	background: #FFCC99; 
	border: 1px solid #FF9900; 
	padding: .1em; 
}
 
/* Elementos "span" contenidos en .normal */
{ 	
	font-weight: bold; 
}

/* Todos los títulos h1, h2 y h3 */
{
	color: #FF7373;
}
 
/* Todos los elementos con la clase "especial" */
{
	font-weight: bold;
}

</style>
</head>
 
<body>

<h1>Lorem ipsum dolor</h1>
<div id="primero">
<p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Praesent blandit nibh at felis. Sed nec diam in dolor vestibulum aliquet. Duis ullamcorper, nisi non facilisis molestie, <em>lorem sem aliquam nulla</em>, id lacinia velit mi vestibulum enim.</p>
 
</div>

<h2>Lorem ipsum dolor 2</h2> 
<div class="normal">
<p>Phasellus eu velit sed lorem sodales egestas. Ut feugiat. <span><a href="#">Donec porttitor</a>, magna eu varius luctus,</span> metus massa tristique massa, in imperdiet est velit vel magna. Phasellus erat. Duis risus. <a href="#">Maecenas dictum</a>, nibh vitae pellentesque auctor, tellus velit consectetuer tellus, tempor pretium felis tellus at metus.</p>
 
<p>Cum sociis natoque <em class="especial">penatibus et magnis</em> dis parturient montes, nascetur ridiculus mus. Proin aliquam convallis ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc aliquet. Sed eu metus. Duis justo.</p>
 
<p>Donec facilisis blandit velit. Vestibulum nisi. Proin volutpat, <em class="especial">enim id iaculis congue</em>, orci justo ultrices tortor, <a href="#">quis lacinia eros libero in eros</a>. Sed malesuada dui vel quam. Integer at eros.</p>
</div>
 
</body>
</html>
