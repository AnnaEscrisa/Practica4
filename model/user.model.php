<?php
//Anna Escribano
//!ALERTA probar a fer aixo amb namespaces

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

    //comprova si l'usuari existeix, i si és així comprova que la contrasenya es correspon amb la de la bbdd
    function login($possibleUsuari, $possibleContrasenya)
    {
        $usuari = $this->selectUserbyUsername($possibleUsuari);
        if ($usuari) {
            //!vigila que usuari password existeixi (que no sigui 0, o 2...)
            $contrasenyaReal = $usuari['password'];

            $realEncriptada = password_hash($contrasenyaReal, PASSWORD_DEFAULT);
            $possibleEncriptada = password_hash($possibleContrasenya, PASSWORD_DEFAULT);
            if (comprovarContrasenya($possibleEncriptada, $realEncriptada)) {
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





