# Routes de l'API

### Ces Controllers sont dans un dossier Api (Front)

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


### Ces Controllers sont dans un dossier Api (Back)
Connexion sécurisée obligatoire

| Endpoint | Méthode HTTP | Contrôleur       | Methode |  Description     | Code de retour |
| ------------------- | ------------ | ---------- | ------ | ------------------------------- | -----| 
| `/api/admin/cities` | GET | CityController | list | récupérer toutes les villes | 200 |
| `/api/admin/cities` | POST | CityController | create | ajouter une nouvelle ville | 201 |
| `/api/admin/cities/{id}` | GET | CityController | read | afficher une ville {id} = city_id| 200 ou 404 |
| `/api/admin/cities/{id}` | PATCH | CityController | update | modifier une ville {id} = city_id | 200, 204 ou 404 |
| `/api/admin/cities/{id}` | DELETE | CityController | delete | supprimer une ville {id} = city_id | 200 ou 404 |
| `/api/admin/users` | GET | UserController | list | récupérer tous les utilisateurs | 200 |
| `/api/admin/users` | POST | UserController | create | ajouter un utilisateur | 201  |
| `/api/admin/users/{id}` | GET | UserController | read | afficher un utilisateur {id} = user_id | 200 ou 404 |
| `/api/admin/users/{id}` | PATCH | UserController | update | modifier un utilisateur {id} = user_id | 200, 204 ou 404 |
| `/api/admin/users/{id}` | DELETE | UserController | delete | supprimer un utilisateur {id} = user_id | 200 ou 404 |
| `/api/admin/categories` | GET | CategoryController | list | récupérer toutes les catégories | 200 |
| `/api/admin/categories` | POST | CategoryController | create | ajouter une catégorie | 201 |
| `/api/admin/categories/{id}` | GET | CategoryController | read | afficher une catégorie {id} = category_id | 200 ou 404 |
| `/api/admin/categories/{id}` | PATCH | CategoryController | update | modifier une catégorie {id} = category_id | 200, 204 ou 404 |
| `/api/admin/categories/{id}` | DELETE | CategoryController | delete | supprimer une catégorie {id} = category_id | 200 ou 404 |
| `/api/admin/cities/{id}/posts` | GET | PostController | list | récupérer tous les points d’intérêt d’une ville {id} = city_id | 200 |
| `/api/admin/cities/{id}/posts` | POST | PostController | create | ajouter un nouveau point d’intérêt d’une ville {id} = city_id | 201 |
| `/api/admin/posts/{id}` | GET | PostController | read | afficher le point d’intérêt {id} = post_id| 200 ou 404 |
| `/api/admin/posts/{id}` | PATCH | PostController | update | modifier un point d’intérêt {id} = post_id | 200, 204 ou 404 |
| `/api/admin/posts/{id}` | DELETE | PostController | delete | supprimer un point d’intérêt {id} = post_id | 200 ou 404|
| `` | | | | | |