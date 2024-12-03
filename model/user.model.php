<?php
//Anna Escribano

require_once 'database.model.php';
class Usuari extends Database
{
    private $taula;
    private $taula_codis;
    private $taula_socials;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->taula = "users";
        $this->taula_codis = "user_codes";
        $this->taula_socials = "user_social_tokens";
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
        return $resultat ? $resultat[0] : null;
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
        $comprovacions = $this->comprovarDades("insert", $usuari, $nom, $email);

        if ($comprovacions == NULL) {
            $contrasenyaEncriptada = password_hash($contrasenya, PASSWORD_DEFAULT);
            $valors = [$usuari, $contrasenyaEncriptada, $nom, $email];
            return $this->insert($this->taula, "user, password, name, email", $valors, "?, ?, ?, ?");

        } else {
            return $comprovacions;
        }

    }

    function updateUsuari($id, $username, $email, $name)
    {
        $user = $this->selectUserById($id);
        $usernameActual = $user['user'];

        $comprovacions = $this->comprovarDades('edit', $username, $name, $email, $usernameActual);

        if ($comprovacions == NULL) {
            $reassignacions = "user = ?, email = ?, name = ?";
            return $this->update($this->taula, $id, [$username, $email, $name], $reassignacions) ? 1 : 0;
        } else {
            return $comprovacions;
        }
    }

    //comprova si l'usuari existeix, i si és així comprova que la contrasenya es correspon amb la de la bbdd
    function login($possibleUsuari, $possibleContrasenya)
    {
        $usuari = $this->selectUserbyUsername($possibleUsuari);

        if ($usuari) {
            $usuari = $usuari[0];

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
        $result = $this->selectBy($this->taula_codis, 'user_id', $user_id)[0];
        if ($result && $possibleCodi == $result['code'] && $result['expiration'] > time()) {
            return true;
        }
    }

    function inserirSocialUser($user, $possibleEmail = null)
    {
        $valors = [$user, $possibleEmail, true]; // null per indicar que es un nou social user
        return $this->insert($this->taula, "user, email, isSocial", $valors, "?, ?, ?");
    }

    function inserirSocialToken($user_fk, $token, $social, $socialId = null)
    {
        $valors = [$user_fk, $token, $social, $socialId];
        $this->insert($this->taula_socials, 'user_fk, token, social, social_id', $valors, '?, ?, ?, ?');
    }

    function updateSocialToken($user_fk, $token)
    {
        $this->updateBy($this->taula_socials, 'user_fk', $user_fk, [$token], 'token = ?');
    }

    function comprovarSocial($columna, $valor)
    {
        $result = $this->selectBy($this->taula_socials, $columna, $valor);
        return $result ? $result[0] : null;
    }

    //comprovacio inicial abans de la inserció. Comprova que l'usari no existeixi i que la mida no sigui excessiva
    function comprovarDades($operacio, $user, $nom, $email, $userVell = null)
    {
        if (($operacio == 'insert' || $user != $userVell) && $this->selectUserByUsername($user)) {
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





