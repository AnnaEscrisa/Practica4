# Pràctica 2 + 3

Projecte realitzat amb **PHP**, establint connexions amb bases de dades **MYSQL** mitjançant **PDO**. Permet a l'usuari la inserció, edició, eliminació i consulta dels diversos articles de la base de dades.


# Instal·lació

Situar la carpeta del projecte a *htdocs* en cas d'utilitzar XAMPP i accedir a *localhost* (en cas d'utilitzar altre programari, consultar la seva guia).
No cal importar la base de dades; és allotjada al núvol (dinahosting).

# Estructura
El projecte està estructurat seguint el sistema MVC + una carpeta public.

### Models
Conté classes que representen l'accés a les dades de la base de dades.
La clase database serveix com a base per realizar les principals interaccions amb una bbdd (conexio, insertar, modificar, eliminar, seleccionar...) i algunes comprovacions de dades (aquelles que requereixen una petició a la bbd o coneixement d'aquesta). 
La classe article hereta tots els mètodes i els aplica a les seves caracteristiques concretes, al igual que la classe usuari.


### Controllers
- **HomeController**
Carrega i mostra els articles. Es utilitzat tant per mostrar tots els articles com pels de l'usuari especific de la sessió a través de paràmetres a la URL.

- **FormController**
Tracta la insercio, modificació i eliminacio dels articles.
Mitjançant les variables isEdit o isDelete ( o l'absencia d'elles ) determina el mètode a emprar. Processa dos formularis: el de inserció/edició (form.vista) i el de eliminació (mitjançant missatge d'error). Empra les funcions de `MessageController` per donar feedback a l'usuari.

- **UserController**
Tracta la inserció, login i logout d'usuaris. Fa comprovacions dels camps mitjançant 
`ValidacioController`. Inicia sessió i guarda les variables de sessió.

- **PaginationController**
Divideix els articles en grups i configura el número de pàgines i la classe dels botons de paginació.

 - **MessageController**
Ofereix funcionalitat per mostrar missatges a l'usuari. Reutilitzable i ampliable segons canviin les necessitats del projecte.

 - **ValidacioController**
Fa validacions inicials dels inputs introduits per l'usuari. Comprova aquells possibles errors no relacionats amb la base de dades (inputs buits, contrasenyes no segures, formats incorrectes...) i els transforma en errors del controlador `MessageController`.

- **SessionController**
Controla la duració de la sessió de l'usuari. Cada vegada que aquest carrega una pàgina, es cridat i fa la comprovació. Redirecciona amb un missatge si la sessió ha sigut tancada.

### Vistes
Dividit entre vistes i partials. Les vistes només inclouen el body de l'html per reduir el codi repetit.