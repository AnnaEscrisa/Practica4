<?php

// Anna Escribano Sabio

class Database
{
    protected $db; //connexió a la bbdd a través de PDO
    protected $db_server; //servidor que allotja bbdd
    protected $db_user; //usuari de la bbdd
    protected $db_pass; //contrasenya
    protected $db_name; //nom de la bbdd

    public function __construct()
    {
        $this->db_server = "mysql-8001.dinaserver.com";
        $this->db_user = "p2_admin";
        $this->db_pass = "Practica_02";
        $this->db_name = "Pt02_Ana_Escribano";
        $this->db = $this->connectarDB("mysql", $this->db_server, $this->db_user, $this->db_pass, $this->db_name);
    }

    //crea una instancia PDO i crea la connexió a la bbdd o llença un error
    function connectarDB($SGBD, $server, $user, $pass, $db_name)
    {
        try {
            $db = new PDO("$SGBD:host=$server;dbname=$db_name", $user, $pass);

            //Atributs i dades extra
            $db->query("set names utf8;");
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $db;

        } catch (Exception $e) {
            echo "Error obtenint base de dades: " . $e->getMessage();
            return null;
        }
    }

    //Retorna tots els registres d'una taula en format array de registres
    function selectAll($taula)
    {
        $sql = "SELECT * FROM $taula";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    // //!ALERTA POTSEr millor com un resultat = sleectAll , split o algo asi, first - last
    // function selectAllLimit($taula, $first, $last)
    // {
    //     $sql = "SELECT * FROM $taula LIMIT $first, $last";

    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute();
    //     $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $resultat;
    // }

    //Retorna tots els registres d'una taula basant-se en el valor d'un camp concret
    function selectBy($taula, $columna, $valor)
    {
        $sql = "SELECT * FROM $taula WHERE $columna = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$valor]);

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }


    //Inserta un nou registre a la taula determinada.
    //$valors ha de ser un array amb els valors a introduir
    //$params fa referencia a la quantitat de camps que seran introduits
    //p. ex: $params = "?, ?"
    //       $valors = ["Pedro", 23]
    function insert($taula, $columnes, $valors, $params)
    {
        try {
            $sql = "INSERT INTO $taula ($columnes)
                VALUES ($params)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($valors);
            return true;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* Fa un update de la taula determinada
    $valors ha de ser un array amb els nous valors a introduir
    $reassignacions ha de ser un string 
    permet reassignar tants camps com tingui la taula
    */
    function update($taula, $id, $valors, $reassignacions)
    {
        try {
            $sql = "UPDATE $taula SET $reassignacions WHERE id = $id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($valors);
            return true;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fa un delete a la taula determinada
    function delete($taula, $id)
    {
        try {
            $sql = "DELETE FROM $taula WHERE id = $id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } catch  (\Throwable $th){
            throw $th;
        }
    }

    //Comprova si ja existeix un registre amb un determinat valor a un determinat camp
    //retorna true si existeix i fals si no
    function comprovarExistent($taula, $columna, $valor)
    {
        $resultat = $this->selectBy($taula, $columna, $valor);
        if (count($resultat) > 0) {
            return true;
        }
        return false;
    }

    //comprova si un determinat valor sobrepassa un nombre de caràcters màxim 
    function comprovarCaractersMaxims($chars_maxims, $valor)
    {
        if (strlen($valor) > $chars_maxims) {
            return true;
        }
    }

    //comprova si hi ha elements html al parametre
    function comprovarHtml($valor){
        if(htmlspecialchars($valor) != $valor){
            return true;
        }
    }

}

?>