# PHPEXTENSIVE

### Instalação

    composer require junior-shyko/keycloak-integ-php


### 💡 - Instalação

```php
    require  __DIR__.'/vendor/autoload.php';
    
    use JuniorShyko\Phpextensive\Extensive;
```

## 🚀 Rota
1- Adicionar no arquivo web.yaml

	   ``web_keycloak:
		  resource: 'junior_shyko_keycloak.yaml'
		  name_prefix: junior_shyko_keycloak_auth_``

2- Criar o arquivo junior_shyko_keycloak.yaml

    connect:
	    path:       /auth/keycloak/connect
    	controller: Junior\KeycloakIntegPhp\Controller\KeycloakController::connect

3 - Adicionar no arquivo services.yaml

        JuniorShyko\KeycloakIntegPhp\Controller\KeycloakController:
	        autowire: true
	        autoconfigure: true
	        public: true

