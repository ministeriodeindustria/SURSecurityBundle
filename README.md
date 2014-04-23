SURSecurityBundle
=================

Bundle de integracion SUR con aplicaciones Symfony

Pasos para configurar el SURSecurityBundle:

##### 1- Actualizar el composer.json del proyecto con:
        ```"ministeriodeindustria": "sur-security-bundle"```
		
##### 2- Agregarle:  ```"minimum-stability": "dev",```

##### 3- En AppKernel agregar: 
```php
	new Knp\Bundle\MenuBundle\KnpMenuBundle(),
	new SUR\SecurityBundle\SURSecurityBundle(),
```
##### 4- En config.yml agregar: 
	```
	- { resource: '@SURSecurityBundle/Resources/config/security.yml' }
	.....
	# SUR Configuration
	sur_security:
		login_url: "%login_url%"
		ws_url: "%ws_url%"
	```
		
##### 5- En parameters.yml agregar:
	```
	login_url: 'http://localhost/sur/intranet/index.php'
	ws_url: 'http://localhost/industriaws/web/app_dev.php/ws/SURAuthentication'
	```
    
##### 6- En routing.yml agregar:
```
	sur_security:
		resource: "@SURSecurityBundle/Controller/"
		type:     annotation
		prefix:   /
```		  
##### 7- El layout de la aplicación debe extender: 
	```{% extends "SURSecurityBundle::layout.html.twig" %}```
	
##### 8- Ponerle el alias ```"_inicio"``` a la pagina principal
