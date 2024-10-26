<?php
// Anna Escribano Sabio

class Database
{
    protected $db; //connexió a la bbdd a través de PDO
    protected $db_server; //servidor que allotja bbdd
    protected $db_user; //usuari de la bbdd
    protected $db_pass; //contrasenya encriptada
    protected $db_name; //nom de la bbdd

    public function __construct()
    {
        $this->db_server = "mysql-8001.dinaserver.com";
        $this->db_user = "p2_admin";
        $this->db_pass = openssl_decrypt("RzsBvtK4pNqPQp2jAY/WEw==","AES-128-ECB","password");
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
    //permet fer un join si aquest es passat per parametre
    function selectAll($taula, $join = NULL)
    {
        $join = $join ?? '';
        $sql = "SELECT * FROM $taula $join";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //Tots els registres, pero permet especificar els camps especifics
     //Permet utilitzar alies per diferenciar camps amb el mateix nom
    function selectAllSpecific($taula, $select, $join = NULL)
    {
        $join = $join ?? '';
        $sql = "SELECT $select FROM $taula $join";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    //Retorna tots els registres d'una taula basant-se en el valor d'un camp concret
    function selectBy($taula, $columna, $valor, $join = NULL)
    {
        $join = $join ?? '';
        $sql = "SELECT * FROM $taula $join WHERE $columna = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$valor]);

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    //Selecciona camps especifics
    function selectSpecific($taula, $select, $columna, $valor, $join = NULL)
    {
        $join = $join ?? '';
        $sql = "SELECT $select FROM $taula $join WHERE $columna = ?";
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
    $reassignacions ha de ser un string. ex:
        $reassignacions = "nom =?, edat =?"
    permet reassignar tants camps com tingui la taula
    */
    function update($taula, $id, $valors, $reassignacions)
    {
        try {
            $sql = "UPDATE $taula SET $reassignacions WHERE id = ?";
            $valors[] = $id;

            $stmt = $this->db->prepare($sql);
            $stmt->execute($valors);
            return true;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //permet fer update en base a un camp concret(no id)
    function updateBy($taula, $campWhere, $valorWhere, $valors, $reassignacions) {

        try {
            $sql = "UPDATE $taula SET $reassignacions WHERE $campWhere = ?";
            $valors[] = $valorWhere;

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
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Delete per camp especific
    function deleteBy($taula, $camp, $valor)
    {
        try {
            $sql = "DELETE FROM $taula WHERE $camp = $valor";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } catch (\Throwable $th) {
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

}

?>