//! PENDENT
    //// - escollir tema
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
    //403 (entrada no permesa) a l'htaccess
    ////vista amb tots usuaris per Admin
    //rols d'usuari (user per defecte, admin per admin)
    ////@ts-check recaptcha en 3 intents fallits
    //ordenacio de articles, guardat a cookies
        //array_order 
    //recuperar contrasenya verifica tambe email, 
    //canviar metode enviar codi, amb un enllaç, per contrasenya
        //si es usuari oAuth, no pot canviar contrasenya
            //a desplegable if !user_ouath enseña eso
        //que l'enllaç sigui nomes un boto (recuperar contrasenya)
        //format bonic, com fer filegetcontent en un template a part
        //bin2hex(randombytes 16)

    

    //no mostrar ingredients, nomes desc
        //ingredients a detall
    //implementar imatges
    ////mailer per contrasenya
    ////username a article (by pepito)
    //data creacio article
    //data modificacio article
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