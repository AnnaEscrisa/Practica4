# Pràctica 2 + 3

Projecte realitzat amb **PHP**, establint connexions amb bases de dades **MYSQL** mitjançant **PDO**. Permet a l'usuari la inserció, edició, eliminació i consulta dels diversos articles de la base de dades.


# Instal·lació

Situar la carpeta del projecte a *htdocs* en cas d'utilitzar XAMPP i accedir a *localhost* (en cas d'utilitzar altre programari, consultar la seva guia).
No cal importar la base de dades; és allotjada al núvol (dinahosting).

# Estructura
El projecte està estructurat seguint el sistema MVC + una carpeta public.

### Models
La clase database serveix com a base per realizar les principals interaccions amb una bbdd (conexio, insertar, modificar, eliminar, seleccionar...) i algunes comprovacions de dades. 
La classe article hereta tots els mètodes i els aplica a les seves caracteristiques concretes.


### Controllers
- **HomeController**
Carrega i mostra els articles.

- **FormController**
Tracta la insercio, modificació i eliminacio dels articles.
Mitjançant les variables isEdit o isDelete ( o l'absencia d'elles ) determina el mètode a emprar. Processa dos formularis: el de inserció/edició (form.vista) i el de eliminació (mitjançant missatge d'error). Empra les funcions de `MessageController` per donar feedback a l'usuari.

- **PaginationController**
Divideix els articles en grups i configura el número de pàgines i la classe dels botons de paginació.

 - **MessageController**
Ofereix funcionalitat per mostrar missatges a l'usuari. Reutilitzable i ampliable segons canviin les necessitats del projecte.


### Vistes
Dividit entre vistes i partials. Les vistes només inclouen el body de l'html per reduir el codi repetit.