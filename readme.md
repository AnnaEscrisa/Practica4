# Pràctica 4

Projecte realitzat amb **PHP**, establint connexions amb bases de dades **MYSQL** mitjançant **PDO**. Permet a l'usuari crear un compte i inserir, editar, eliminar i consultar els diversos articles de la base de dades.


# Instal·lació

Situar la carpeta del projecte a *htdocs* en cas d'utilitzar XAMPP i accedir a *localhost* (en cas d'utilitzar altre programari, consultar la seva guia).
No cal importar la base de dades; és allotjada al núvol (dondominio).

# Estructura
El projecte està estructurat seguint el sistema MVC + una carpeta public.

### Models
Conté classes que representen l'accés a les dades de la base de dades.
La clase database serveix com a base per realizar les principals interaccions amb una bbdd (conexio, insertar, modificar, eliminar, seleccionar...) i algunes comprovacions de dades (aquelles que requereixen una petició a la bbdd o coneixement d'aquesta). 
La classe article hereta tots els mètodes i els aplica a les seves caracteristiques concretes, al igual que la classe usuari.


### Controllers
Conté els controladors principals (els que s'encarreguen de direccionar el codi, donar resposta a les peticions de l'usuari i carregar les vistes) i els secundaris (aquells que ofereixen funcionalitat extra o d'ajut).
Organitzat per carpetes depenent de les seves funcions.

- **Access**
Controlador base `access.controller`. Controla el login i el registre, inclòs el registre mitjançant xarxes socials (DeviantArt i GitHub). Permet a un mateix email estar en diversos comptes (tant socials com normals). 

- **Adminr**
Controlador base `admin.controller`. En entrar comprovarà que l'usuari te permissos per veure els recursos de la pàgina. Podrà administrar els diversos usuaris de la aplicació. En eliminar un usuari, passa els seus articles a anònim.

- **Articles**
Controlador base `articles.controller`. Mostra els articles i gestiona la seva inserció, eedició i eliminació. Comprova que els usuari puguin fer canvis als articles (només l'autor pot fer canvis).

- **Profile**
Controlador base `profile.controller`. Administra el canvi de les dades de l'usuari, inclosa la contrasenya. No permet canviar la contrasenya als usuaris logats mitjançant xarxes socials.

- **Utils**
Diversos controladors amb funcionalitats extra utilitzades a diferents seccions del codi, pero que no pertanyen a una secció especifica.


### Vistes
Dividit entre vistes i partials. Les vistes només inclouen el body de l'html per reduir el codi repetit. Inclouen certa reactivitat al codi per mantenir dades a formularis o mostrar unes seccions o altres.
