SURSecurityBundle
=================

Bundle de integracion SUR con aplicaciones Symfony

Pasos para configurar el SURSecurityBundle:

1- Actualizar el composer.json del proyecto con: <br />
		"ministeriodeindustria": "sur-security-bundle"
		
2- Agregarle:  "minimum-stability": "dev",

3- En AppKernel agregar: <br />
		new Knp\Bundle\MenuBundle\KnpMenuBundle(), <br />
		new SUR\SecurityBundle\SURSecurityBundle(), <br />
		
4- En config.yml agregar: <br />
	- { resource: '@SURSecurityBundle/Resources/config/security.yml' }  <br />
	.....<br />
	# SUR Configuration<br />
	sur_security:<br />
		login_url: "%login_url%"<br />
		ws_url:    "%ws_url%"<br />
		
5- En parameters.yml agregar:<br />
	login_url: 'http://localhost/sur/intranet/index.php'<br />
    	ws_url: 'http://localhost/industriaws/web/app_dev.php/ws/SURAuthentication'<br />
    
6- En routing.yml agregar:<br />
    sur_security:<br />
		  resource: "@SURSecurityBundle/Controller/"<br />
		  type:     annotation<br />
		  prefix:   /<br />
		  
7- El layout de la aplicación debe extender: <br />
	{% extends "SURSecurityBundle::layout.html.twig" %}<br />
	
8- Ponerle el alias "_inicio" a la pagina principal
