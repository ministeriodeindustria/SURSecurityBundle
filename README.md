SURSecurityBundle
=================

Bundle de integracion SUR con aplicaciones Symfony

Pasos para configurar el SURSecurityBundle:

1- Actualizar el composer.json del proyecto con: <br />
        <code>"ministeriodeindustria": "sur-security-bundle"</code>
		
2- Agregarle:  <code>"minimum-stability": "dev",</code>

3- En AppKernel agregar: <br />
		<code>new Knp\Bundle\MenuBundle\KnpMenuBundle(), <br />
		new SUR\SecurityBundle\SURSecurityBundle(), <br /></code>
		
4- En config.yml agregar: <br />
	<code>- { resource: '@SURSecurityBundle/Resources/config/security.yml' }</code><br />
	.....<br />
	<code># SUR Configuration<br />
	sur_security:<br />
		login_url: "%login_url%"\n
		ws_url:    "%ws_url%"<br /></code>
		
5- En parameters.yml agregar:<br />
	<code>login_url: 'http://localhost/sur/intranet/index.php'<br />
    	ws_url: 'http://localhost/industriaws/web/app_dev.php/ws/SURAuthentication'<br /></code>
    
6- En routing.yml agregar:<br />
    <code>sur_security:<br />
		  resource: "@SURSecurityBundle/Controller/"<br />
		  type:     annotation<br />
		  prefix:   /<br /></code>
		  
7- El layout de la aplicación debe extender: <br />
	<code>{% extends "SURSecurityBundle::layout.html.twig" %}<br /></code>
	
8- Ponerle el alias <code>"_inicio"</code> a la pagina principal
