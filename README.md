# Brace Armchair API - Symfony Project 
## Table des matières
1. [Introduction](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
2. [Fonctionnalités](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
3. [Installation](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
4. [Création des entity](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
5. [Création du User](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
5. [App fixtures](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
5. [Integration de l'API](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
5. [Serialisation des groupes](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
5. [Authentification JWT](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
6. [Tests](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
7. [Contributions](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
8. [Licence](https://github.com/caatwomann69700/Brace-Armchair-API---Symfony-Project/tree/main?tab=readme-ov-file#introduction)
## Introduction 
BraceArmchair API est une application backend développée avec Symfony 6.4 sans l'utilisation de webapp, permettant de gérer des produits, des catégories, des utilisateurs, des paniers, des commandes, et des newsletters. Elle est conçue pour être utilisée comme API RESTful pour une boutique en ligne. Elle utilise API Platform pour la création et la gestion des points de terminaison API, avec une sécurisation via JWT.
## Fonctionnalités
+ CRUD pour les produits,catégories,paniers, commandes et utilisateurs.
+ CRUD complet pour chaque entité.
+ Authentification via JWT.
+ Sérialisation des groupes pour un contrôle granulaire des données exposées
+ Utilisation de Postman pour les tests des points de terminaison.
+ Gestion des images et listes d'images pour chaque produit.
## Installation
### Prérequis
+ PHP 8.1 ou plus 
+ Composer 
+ MySQL ou tout autre SGBD compatible 
+ Symfony CLI 
+ OpenSSL pour la gestion des certificats JWT 
### Étapes d'installation
1. Creation du projet avec la commande suivante 
```php
symfony new Brace_Armchair_API --version=6.4 
```
2. Création d'un fichier .env.local a partir du .env et configuration des informations de la base de donnéess 
```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/bracearmchair_api"
```
3. Creation de la base de données dans le terminal a la racine du projet avec la commande suivante : 
```
php bin/console doctrine:database:create
```
4. Installation de Composer avec la commande suivante : 
```
composer require orm 
```
5.  Installation du Profiler avec la commande suivante :
```
composer require --dev profiler
````
6. Installation du Maker avec la commande suivante :
```
composer require --dev maker
````
7. Installation des Fixtures avec la commande suivante :
```
composer require --dev orm-fixtures
````
7. Installation du Bundles de security avec la commande suivante :
```
composer require security
````
## Création des entity
.1 creation de toutes les entity suivantes : 
+ Product 
+ Category 
+ Image 
+ Imagelist 
+ Cart
+ CartItem
+ Wishlist 
+ Order 
+ Newsletter
---
*Voici Un appercu de mon MPD et des entity que je dois creer pour ce projet :*
![alt text](Base_de_données.png)
Avec la commande suivante : 
``` 
php bin/console make:entity 
```
2. Faire une migration a la base de données avec la commande suivante : 
``` 
php bin\console make:migration
```
3. Executer la migration avec un migrate : 
``` 
php bin\console doctrine:migrations:migrate 
```
4. Faire les relations entres les entity 
## Création du User 
.1 creation du User avec la commande suivante : 
```
php bin\console make:user
```
2. Faire une migration a la base de données avec la commande suivante : 
``` 
php bin\console make:migration
```
3. Executer la migration avec un migrate : 
``` 
php bin\console doctrine:migrations:migrate 
```
## App fixtures 
1. instancier les fixtures avec la méthode load pour toutes les entity 
2. instancier les fixtures pour User , Admin et Utilisateur 
3. loader les fixtures a partir de cette commande : 
```
php bin\console d:f:l 
```
## Integration de l'API
+ Installation de l'api avec la commande suivante : 
````
composer require api
````
Ce bundle nous génere 3 packs (serialiser, doctrine, Api en elle meme).

**Important!** 

Lors de l'integration de l'api au seins de notre projet, il faut indiquer dans chaque entity l'utilisation de l'api on mettant les déclarations d'importations tel que : 
````
use ApiPlatform\Metadata\ApiResource;
````
## Serialisation des groupes 
Chaque entité utilise des groupes de sérialisation pour contrôler les données visibles via l'API
+ inclure les groupes de serialisations dans nos entiy
````
#[groups('product:read')]
````
+ inclure la déclarations d'importation comme ceci : 
````
use symfony compenent\serializer\attribute\groups;
````
Les groupes permettent de spécifier quels champs doivent être visibles pour chaque type de requête (lecture/écriture).
## Authentification JWT
Pour sécuriser l'API, nous utilisons JWT pour l'authentification des utilisateurs.
+ Activer l'extension sodium dans php.ini.
+ Installer LexikJWTAuthenticationBundle 
````
composer require lexik/jwt-authentication-bundle
````
+ Générer une clé SSL pour signer les tokens JWT 
````
php bin/console lexik:jwt:generate-keypair
````
Cela crée les fichiers de clé privée et publique dans le répertoire config/jwt/. 
+ Configurer la sécurité dans security.yaml 

## Tester l'authentification avec Postman
Pour tester l'authentification avec Postman j'ai du faire : 
+ Faire une requête POST à l'URL /api/login_check avec un corps JSON contenant l'email et le mot de passe d'un utilisateur inscrit.
+ Postman retournera un token JWT que vous devrez utiliser pour authentifier les futures requêtes en ajoutant le header Authorization: Bearer {token}.
# Contributions 
Les contributions sont les bienvenues ! Si vous souhaitez ajouter de nouvelles fonctionnalités ou corriger des bogues, suivez les étapes ci-dessous : 
1. Forkez ce dépôt.
2. Créez une nouvelle branche (git checkout -b feature/nouvelle-fonctionnalite).
3. Commitez vos changements (git commit -am 'Ajout d'une nouvelle fonctionnalité')
4. Pushez la branche (git push origin feature/nouvelle-fonctionnalite).
5. Ouvrez une Pull Request
## Licence 
Ce projet est sous licence MIT. Consultez le fichier LICENSE pour plus d'informations. 

