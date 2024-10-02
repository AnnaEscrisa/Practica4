-Estructura
El projecte està estructurat seguint el sistema MVC + una carpeta public.
	
-Model
Dintre del model trobem les classes database i article. 
La clase database serveix com a base per realizar les principals interaccions amb una bbdd (conexio, insertar, modificar, eliminar, seleccionar...) i algunes comprovacions de dades. 
Article hereta tots els mètodes i els aplica a les seves caracteristiques concretes.
D'aquesta manera, podrem establir classes filles de database per totes les futures taules de la bbdd.

-Controller
-form controller
Tracta tant la insercio, modificació i eliminacio dels articles.
Mitjançant les variables isEdit o isDelete ( o l'absencia d'elles) determina el mètode a emprar. 

-message controller
Ofereix funcionalitat per mostrar missatges a l'usuari. 


-Vista
Dividit entre vistes i partials. Les vistes només inclouen el body de l'html 


-bbdd
No cal descarregar o configurar la bbdd, ja que està allotjada a dinahosting.