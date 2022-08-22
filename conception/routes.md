# Routes de l'API

### Ces Controllers sont dans un dossier Front (API)

| Endpoint | Méthode HTTP | Contrôleur       | Methode |  Description     |  Code |
| ---------------- | ------------ | ---------- | ------ | ---------------------------- | ---- |
| `/api/cities` | GET | CityController | list | récupérer toutes les villes | 200 |
| `/api/cities/{id}` | GET | CityController | read | afficher une ville {id} = city_id | 200 ou 404 |
| `/api/cities/{id}/posts` | GET | PostController | list | récupérer tous les points d’intérêt d’une ville {id} = city_id | 200 | 
| `/api/cities/{id}/posts` | POST | PostController | create | ajouter un nouveau point d’intérêt d’une ville {id} = city_id | 201 |
| `/api/posts/{id}` | GET | PostController | read | afficher le point d’intérêt d’une ville {id} = post_id | 200 ou 404 |
| `/api/posts/{id}` | PATCH | PostController | update | modifier un point d’intérêt {id} = post_id | 200, 204 ou 404 |
| `/api/users` | POST | UserController | create | ajouter un utilisateur | 201 |
| `/api/users/{id}` | GET | UserController | read | afficher un utilisateur {id} = user_id| | 200 |
| `/api/users/{id}` | PATCH | UserController | update | modifier un utilisateur {id} = user_id| 200, 204 ou 404 |
| `/api/cities/{city_id}/categories{id}/posts` | GET | CategoryController | list | récupérer toutes les postes d’une catégorie {city_id} = city_id {id} = category_id | 200 |
| `/api/login_check` | POST | | | | | `


### Ces Controllers sont dans un dossier Back
Connexion sécurisée obligatoire

| Endpoint | Méthode HTTP | Contrôleur       | Methode |  Description     | Nom |
| ------------------- | ------------ | ---------- | ------ | ------------------------------- | -----| 
| `/admin/cities` | GET | CityController | list | récupérer toutes les villes | admin_city_list |
| `/admin/cities/create` | GET, POST | CityController | create | ajouter une nouvelle ville | admin_city_create |
| `/admin/cities/{id}` | GET | CityController | read | afficher une ville {id} = city_id| admin_city_read |
| `/admin/cities/{id}/update` | GET, POST | CityController | update | modifier une ville {id} = city_id | admin_city_update |
| `/admin/cities/{id}` | POST | CityController | delete | supprimer une ville {id} = city_id | admin_city_delete |
| `/admin/users` | GET | UserController | list | récupérer tous les utilisateurs | admin_user_list |
| `/admin/users/create` | GET, POST | UserController | create | ajouter un utilisateur | admin_user_create  |
| `/admin/users/{id}` | GET | UserController | read | afficher un utilisateur {id} = user_id | admin_user_read |
| `/admin/users/{id}/update` | GET, POST | UserController | update | modifier un utilisateur {id} = user_id | admin_user_update |
| `/admin/users/{id}` | POST | UserController | delete | supprimer un utilisateur {id} = user_id | admin_user_delete |
| `/admin/categories` | GET | CategoryController | list | récupérer toutes les catégories | admin_category_list |
| `/admin/categories/create` | GET, POST | CategoryController | create | ajouter une catégorie | admin_category_create |
| `/admin/categories/{id}` | GET | CategoryController | read | afficher une catégorie {id} = category_id | admin_category_read |
| `/admin/categories/{id}/update` | GET, POST | CategoryController | update | modifier une catégorie {id} = category_id | admin_category_update |
| `/admin/categories/{id}` | POST | CategoryController | delete | supprimer une catégorie {id} = category_id | admin_category_delete |
| `/admin/posts` | GET | PostController | list | récupérer tous les points d’intérêt d’une ville {id} = city_id | admin_post_list |
| `/admin/posts/create` | GET, POST | PostController | create | ajouter un nouveau point d’intérêt d’une ville {id} = city_id | admin_post_create |
| `/admin/posts/{id}` | GET | PostController | read | afficher le point d’intérêt {id} = post_id| admin_post_read |
| `/admin/posts/{id}/update` | GET, POST | PostController | update | modifier un point d’intérêt {id} = post_id | admin_post_update |
| `/admin/posts/{id}` | POST | PostController | delete | supprimer un point d’intérêt {id} = post_id | admin_post_delete |
| `/admin` | GET | MainController| index| afficher le homepage du backoffice| admin_home |
| `/login` | GET, POST | LoginController| login | afficher la page du login de BO | admin_login |