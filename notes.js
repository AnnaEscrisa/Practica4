//! PENDENT
   
    //! OJO en form.vista, esta puesto session user id como campo id, vigila que en edit de admin esto no puede ser


    //! readme
        // que hem fet amb articles orfes?
        // com es processa canvi pass per logats
        //com funciona remember me
        

    //! SI NO FA REGISTRE, hauria de guardar les dades al form, pero les esborra

    //!vigilar paginacion
        //cuando pasas de pagina, no lo haces en myArticles
        //en users (admin)
   
    
    //!ordenacio de articles, guardat a cookies
        //array_order 

    ////canviar metode enviar codi, amb un enllaç, per contrasenya
        //si es usuari oAuth, no pot canviar contrasenya
            //a desplegable if !user_ouath no enseña eso de canviar
        //que l'enllaç sigui nomes un boto (recuperar contrasenya)
        //format bonic, com fer filegetcontent en un template a part
    

    //! fer DETALLL    

    //!implementar imatges
    
    //!eliminacio d'usuaris posa els seus articles en anonim

    //! CAPTCHA KEY NECESITA VERSION PARA DONDOMINIO 

    //! implementar ingredients

    //!implementar tipus pocio

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