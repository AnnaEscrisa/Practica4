<?php
//Anna Escribano
//!ALERTA probar a fer aixo amb namespaces

require_once 'database.model.php';
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

    //selecciona per nom usuari
    function selectUserByUsername($user)
    {
        $resultat = $this->selectBy($this->taula, "user", $user);
        return $resultat;
    }

    //primer valida els valors, i despres inserta l'usuari amb la contraenya hashejada
    function insertUsuari($usuari, $contrasenya, $nom, $email)
    {
        $comprovacions = $this->comprovarDades($usuari, $nom, $email);

        if ($comprovacions == NULL) {
            $contrasenyaEncriptada = password_hash($contrasenya, PASSWORD_DEFAULT);
            $valors = [$usuari, $contrasenyaEncriptada, $nom, $email];
            return $this->insert($this->taula, "user, password, name, email", $valors, "?, ?, ?, ?");

        } else {
            return $comprovacions;
        }

    }

    function updateUsuari($id, $valors, $reassignacions)
    {
        $this->update($this->taula, $id, $valors, $reassignacions);
    }

    //comprova si l'usuari existeix, i si és així comprova que la contrasenya es correspon amb la de la bbdd
    function login($possibleUsuari, $possibleContrasenya)
    {
        $usuari = $this->selectUserbyUsername($possibleUsuari)[0];

        if ($usuari) {

            $contrasenyaReal = $usuari['password'];

            if (password_verify($possibleContrasenya, $contrasenyaReal)) {
                return true;
            }
        }
    }

    //insereix un registre a la taula user_codes, per codis de recuperacio
    function inserirCodiUsuari($codi, $user_id, $expiracio)
    {
        $valors = [$user_id, $codi, $expiracio];
        $this->insert('user_codes', 'user_id, code, expiration', $valors, '?, ?, ?');
    }

    function comprovarCodi($possibleCodi, $user_id)
    {
        $result = $this->selectBy('user_codes', 'user_id', $user_id)[0];
        if ($result && $possibleCodi == $result['code'] && $result['expiration'] > time()) {
            return true;
        }
    }

    //comprovacio inicial abans de la inserció. Comprova que l'usari no existeixi i que la mida no sigui excessiva
    function comprovarDades($user, $nom, $email)
    {
        if ($this->selectUserByUsername($user)) {
            return 3;
        }

        if ($this->comprovarMidaUser($user, $email, $nom)) {
            return 2;
        }

    }

    // comporva la mida dels diferents camps. No comprova la contrasenya perque, en estar hashejada, te una mida variable
    function comprovarMidaUser($user, $email, $nom)
    {
        if (
            $this->comprovarCaractersMaxims(40, $user) ||
            $this->comprovarCaractersMaxims(50, $email) ||
            $this->comprovarCaractersMaxims(50, $nom)
        ) {
            return true;
        }
    }
}





