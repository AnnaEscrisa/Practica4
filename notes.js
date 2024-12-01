//! PENDENT
   
    //! readme
        // que hem fet amb articles orfes?
        // com es processa canvi pass per logats
        //com funciona remember me
        

    //! vigilar que si nom, email es null, surti un espai en blanc i no doni erro en profile de user

    //! SI NO FA REGISTRE, hauria de guardar les dades al form, pero les esborra

    //vigilar paginacion
        //cuando pasas de pagina, no lo haces en myArticles
   
    // canviar de posicio login i logout

    //// posar id user a articles 
    //// afegir comprovacio dos contrasenyes iguals a controller
    //// arreglar validacio
        //funcio comprovar a cada model
        //canviar nums de article a validacio cont
        //implementar validacio a controller


    //403 i 404 htaccess no surt visible
    
    //rols d'usuari (user per defecte, admin per admin)
    //ordenacio de articles, guardat a cookies
        //array_order 

    //canviar metode enviar codi, amb un enllaç, per contrasenya
        //si es usuari oAuth, no pot canviar contrasenya
            //a desplegable if !user_ouath no enseña eso de canviar
        //que l'enllaç sigui nomes un boto (recuperar contrasenya)
        //format bonic, com fer filegetcontent en un template a part
        //bin2hex(randombytes 16)

    //canviar lo de las alertes, que se abran solas, cieren? 
        // le pasamos datos a js, i asi no cal hacerlo en php?

    //social auth
        // que no permeti canviar contrasenya
    

    //no mostrar ingredients, nomes desc
        //ingredients a detall

    //! fer DETALLL    

    //implementar imatges
    //eliminacio d'usuaris posa els seus articles en anonim

    //! CAPTCHA KEY NECESITA VERSION PARA DONDOMINIO 


    //! COmprovacions
        //tots errors insert user
        //tots login (login, logout, no pass, no user, no correct)
        //tots insert article
        //tots edit article
        //rutes funcionals
        //redirections funcionals
        //articles correctes (nomes meus, no edicio)

//* VISTAS
    // que se vea bien el login y registre
    ///estil navbar
    //estil general (fons, lletra, cards)


//* navbar
    ////- te una seccio my_articles, nomes mostrat si estem logats
    ////nou article igual
    ////login, i canvia a logout
        ////if Session[user]? logout: login


//* LOGIN
    //// -mateix per login i register
    //// link a register


//* registre
    //// hash a la contra

    
//* Index -- my articles
    ////utilitzar vista i controller index per my articles
    ////pero amb diferent ruta (my_articles)

    //index
    ////if session[user] -- editar i eliminar


//?referencies 
    //captcha --> https://davisonpro.dev/php-recaptcha/