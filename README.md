SURSecurityBundle
=================

Bundle de integracion SUR con aplicaciones Symfony

Pasos para configurar el SURSecurityBundle:

1- Actualizar el composer.json del proyecto con: <br />
        <code>"ministeriodeindustria": "sur-security-bundle"</code>
		
2- Agregarle:  <code>"minimum-stability": "dev",</code>

3- En AppKernel agregar: <br />
```php
	new Knp\Bundle\MenuBundle\KnpMenuBundle(),
	new SUR\SecurityBundle\SURSecurityBundle(),
```
4- En config.yml agregar: <br />
	<code>- { resource: '@SURSecurityBundle/Resources/config/security.yml' }</code><br />
	.....<br />
	<code># SUR Configuration</code><br />
	<code>sur_security:</code><br />
	<code>	login_url: "%login_url%"</code><br />
	<code>	ws_url:    "%ws_url%"</code><br />
		
5- En parameters.yml agregar:<br />
	<code>login_url: 'http://localhost/sur/intranet/index.php'</code><br />
    	<code>ws_url: 'http://localhost/industriaws/web/app_dev.php/ws/SURAuthentication'</code><br />
    
6- En routing.yml agregar:<br />
    <code>sur_security:</code><br />
		  <code>resource: "@SURSecurityBundle/Controller/"</code><br />
		  <code>type:     annotation</code><br />
		  <code>prefix:   /</code><br />
		  
7- El layout de la aplicación debe extender: <br />
	<code>{% extends "SURSecurityBundle::layout.html.twig" %}<br /></code>
	
8- Ponerle el alias <code>"_inicio"</code> a la pagina principal
