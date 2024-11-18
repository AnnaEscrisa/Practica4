//! PENDENT
    //// - escollir tema
    //! NO ESTA AGAFANT el id de l'article i del user, i mirant si es seu bé
        //cuando un user entra en un articulo siyo, le dice que no tiene permiso
    // fer mes users i canviar articles
    // canviar de posicio login i logout
    // fer ${nomUser} a navbar, per perfil, i que sigui desplegable
        //login
        //logout
        //perfil
    //// posar id user a articles 
    //// afegir comprovacio dos contrasenyes iguals a controller
    //// arreglar validacio
        //funcio comprovar a cada model
        //canviar nums de article a validacio cont
        //implementar validacio a controller
    //// fer que la session duri 40 min -- aixo de ini funciona malament no passa res
    ////ficar nom user a cookies en remember me
    ////fer myarticles page en nav (solo cuando login)
    ////fer logout (cuando login) en nav
    ////readme -- apuntar diviiso model/controller validacio
    ////oblit contrasenya
    ////comprovar si funciona cookie -- guarda pero sempre, encara que no check
    ////a form recuperacio, posarse el nom user automatic
    ////missatge misterios a recupera.php
    ////entra per user, no per codi
    //403 i 404 htaccess no surt visible
    //

    ////vista amb tots usuaris per Admin
    //rols d'usuari (user per defecte, admin per admin)
    ////@ts-check recaptcha en 3 intents fallits
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
    //! SI USER NO TE ARTICLES, NO VA A SECCIO MYARTICLES

    //social auth
        // te guarda usuario?
        // te pide que crees un nombre de user??
        // que no permeti canviar contrasenya
        //camp is socialUser? true - false
        // altre taula amb user_id + socials
    

    //no mostrar ingredients, nomes desc
        //ingredients a detall
    //implementar imatges
    ////mailer per contrasenya
    ////username a article (by pepito)
    //eliminacio d'usuaris posa els seus articles en anonim
    ////paginacio selectiva

    


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