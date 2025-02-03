# Pràctica 4

Projecte realitzat amb **PHP**, establint connexions amb bases de dades **MYSQL** mitjançant **PDO**. Permet a l'usuari crear un compte i inserir, editar, eliminar i consultar els diversos articles de la base de dades.


# Instal·lació

Situar la carpeta del projecte a *htdocs* en cas d'utilitzar XAMPP i accedir a *localhost* (en cas d'utilitzar altre programari, consultar la seva guia).
No cal importar la base de dades; és allotjada al núvol (dondominio).


- **Rutes**
Les rutes (home, login, registre...) passen per un primer filtre per l'htacces, que les canvia de ""index?route=home" a "home". Secundariament, passen per altre filtre als controladors, que les redirigeixen a la funcionalitat especifica (edicio, inserció, etc).

### Models
Conté classes que representen l'accés a les dades de la base de dades.
La clase database serveix com a base per realizar les principals interaccions amb una bbdd (conexio, insertar, modificar, eliminar, seleccionar...).


### Controllers
Organitzats per carpetes depenent de les seves funcions.

- **Access**
Controladors per l'acces a la aplicació (login, registre...). No es prohibeix que un email estigui a més d'un compte (tant socials com normals). 

- **Admin**
En eliminar un usuari, passa els seus articles a anònim.

- **Articles**
Els usuaris nomès podràn editar o eliminar articles de la seva possesió. 

- **Utils**
Diversos controladors amb funcionalitats extra utilitzades a diferents seccions del codi, pero que no pertanyen a una secció especifica.


### Vistes
Incorporen un layout, que estableix la base del diseny de les pàgines. Serà inclòs a totes les vistes principals. 
Dividit entre vistes i partials. Les vistes només inclouen el body de l'html per reduir el codi repetit.

### API
Present a la carpeta Api. Utilitzable des de Postman.

La validació de l'entrada a la api es fa mitjançant API KEY, no JWT.

Presenta tres endpoints principals: key, users i articles.
- Key (POST)
Per creació de api keys. És l'únic endpoint que no requereix una api key per accedir. Requereix l'id de l'usuari pel qual es crea la key. Exemple d'endpoint: /api/key?id=17
- Users (GET / GET?id)
Requereix api key d'administrador per accedir. Exemple d'endpoint: /api/users o /api/users?id=17
- Articles (GET / GET?id)
Requereix api key per accedir. Exemple d'endpoint: /api/articles o /api/articles?id=17

A postman, cal afegir la api key als headers, i seleccionar especificament API KEY. Com a "Key", escriure la variable "api-key", i el valor de la key a "value".

### QR

Implementat tant la lectura com la creació de QR. Per estètica, s'ha implementat la creació de qr a partir de l'API de qrmonkey. La creació de qr amb la llibreria de chillerlean encara està implementada però comentada. Per utilitzar aquesta en comptes de la de qrmonkey, al controlador creador.controller.php, a la funció articleQR(), comentar la secció "Funcionament mitjan QRMonkey" i descomentar la secció "Funcionament original".

### AJAX
Utilitzat als scripts de JavaScript (alertes.js i qr.js) per carregar el codi QR i actualitzar-lo en base als canvis que fa l'usuari.

