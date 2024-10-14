<?php


require 'database.model.php';
class Usuari extends Database
{
    private $taula;

    public function __construct()
    {
        parent::__construct();
        $this->taula = "users";
    }

    function selectUsers()
    {
        $resultat = $this->selectAll($this->taula);
        return $resultat;
    }

    //Selecciona per id
    function selectUserById($id)
    {
        $resultat = $this->selectBy($this->taula, "id", $id);
        return $resultat;
    }

    function selectUserByUsername($user)
    {
        $resultat = $this->selectBy($this->taula, "user", $user);
        return $resultat;
    }

    function insertUsuari($usuari, $contrasenya, $repeticioContrasenya, $nom, $email)
    {
        $comprovacions = $this->comprovarDades($usuari, $contrasenya, $repeticioContrasenya, $nom, $email);

        //!ALERTA ojo ese igual
        if ($comprovacions === NULL) {
            $contrasenyaEncriptada = password_hash($contrasenya, PASSWORD_DEFAULT);
            $valors = [$usuari, $contrasenyaEncriptada, $nom, $email];
            return $this->insert($this->taula, "usuari, contrasenya, nom, email", $valors, "?, ?, ?, ?");

        } else {
            return $comprovacions;
        }

    }

    function login($possibleUsuari, $possibleContrasenya)
    {
        $usuari = $this->selectUserbyUsername($possibleUsuari);
        if ($usuari) {
            $contrasenyaReal = $usuari['password'];
            if (comprovarContrasenya($possibleContrasenya, $contrasenyaReal)) {
                return true;
            }
            ;
        }
    }

    //comprova les diferents dades necessaries per crear un usuari
    function comprovarDades($user, $contrasenya, $repeticioContrasenya, $nom, $email)
    {
        $dades = [$user, $contrasenya, $nom, $email];

        if (!comprovarContrasenya($contrasenya, $repeticioContrasenya)) {
            return 6;
        }

        if (!contrasenyaSegura($contrasenya)) {
            return 5;
        }

        if ($this->comprovarExistent($this->taula, "user", $user)) {
            return 4;
        }

        if ($this->comprovarHtmlCamps($dades)) {
            return 3;
        }

        if ($this->caractersMaximsCamps($dades)) {
            return 2;
        }

        return NULL;
    }

    function comprovarHtmlCamps($arrayDades)
    {

        foreach ($arrayDades as $dada) {
            if ($this->comprovarHtml($dada)) {
                return true;
            }
        }
    }

    //comprova que el nombre de caracters no exedeix el maxims permetits per tots els camps de User
    function caractersMaximsCamps($arrayDades)
    {
        foreach ($arrayDades as $dada) {
            if ($this->comprovarHtml($dada)) {
                return true;
            }
        }
    }

    //comporva que la contrasenya i la repeticio siguin iguals
    function comprovarContrasenya($contrasenya, $altreContrasenya)
    {
        $esCorrecte = $contrasenya == $altreContrasenya ? true : false;
        return $esCorrecte;
    }

    //comprova si la contrasenya te numeros i lletres
    function contrasenyaSegura($contrasenya)
    {
        if (strlen($contrasenya) >= 8 && preg_match("#[0-9]+#", $contrasenya) && preg_match("#[a-z]+#", $contrasenya)) {
            return true;
        }
    }
}





