<?php
namespace PHPMVC\Model;

session_start();
use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Model\AbstractModel;

class TraductionModel extends AbstractModel
{
    private $id;
    private $id_client;
    private $id_traducteur;
    private $date_debut;
    private $devis;
    private $date_fin;
    private $type;
    private $etat;
    private $specification = "";
    private $langue_fichier = "";
    private $langue_traduction = "";
    private $fichier = "";
    private static $conn;

    private static $types_traduction = array(0 => 'Site Web ', 1 => 'Scientifique', 2 => 'Général');
    protected static $tableName = 'traduction';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'id_client' => self::DATA_TYPE_INT,
        'id_traducteur' => self::DATA_TYPE_INT,
        'devis' => self::DATA_TYPE_INT,
        'date_debut' => self::DEFAULT_MYSQL_DATE,
        'date_fin' => self::DEFAULT_MYSQL_DATE,
        'specefication' => self::DATA_TYPE_STR,
        'fichier' => self::DATA_TYPE_STR,
        'etat' => self::DATA_TYPE_INT,
        'type' => self::DATA_TYPE_INT,
        'langue_fichier' => self::DATA_TYPE_INT,
        'langue_traduction' => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';

    public function __construct($row, $exist = true) /* after database request */
    {

        if ($exist) {
            $this->id = $row['id'];
            $this->id_client = $row['id_client'];
            $this->id_traducteur = $row['id_traducteur'];
            $this->devis = $row['devis'];
            $this->date_debut = $row['date_debut'];
            $this->date_fin = $row['date_fin'];
            $this->specification = $row['specefication'];
            $this->fichier = $row['fichier'];
            $this->type = self::$types_traduction[$row['type'] - 1];
            $this->putAll($row['etat']);
            $this->putLangues($row['langue_fichier'], $row['langue_traduction']);

        } else {
            $this->id_client = $row[0];
            $this->id_traducteur = $row[1];
            $this->devis = null;
            $this->date_debut = date("Y-m-d");
            $this->date_fin = null;
            $this->type = self::$types_traduction[$row[2] - 1];
            $this->fichier = $row[5];
            $this->putAll(3);
            $this->putLangues($row[3], $row[4]);
        }
    }

    private function buildNameParametersSQL()
    {
        $namedParams = '';
        foreach (static::$tableSchema as $columnName => $type) {
            if ($columnName != 'id') {
                $namedParams .= $columnName . ' = :' . $columnName . ', ';
            }
        }
        return trim($namedParams, ', ');
    }

    public function update()
    {
        self::getConnection();
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function create()
    {
        self::getConnection();
        $this->getIntValues($this->langue_traduction, $this->langue_fichier, $this->etat);
        $sql = 'INSERT INTO ' . static::$tableName . ' (id_client,id_traducteur,devis,date_debut,date_fin,specefication,fichier,etat,type,langue_fichier,langue_traduction)  VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        $stmt = self::$conn->prepare($sql);
        $obj = array((int) $this->id_client,
            (int) $this->id_traducteur,
            $this->devis,
            $this->date_debut,
            $this->date_fin,
            $this->specefication,
            $this->fichier,
            $this->etat,
            $this->type,
            $this->langue_fichier,
            $this->langue_traduction,
        );
        // reset the values to they're format
        $this->putLangues($this->langue_traduction, $this->langue_fichier);
        $this->putAll($this->etat);
        $this->type = self::$types_traduction[$this->type - 1];

        if ($stmt->execute($obj)) {
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    private function prepareValues(\PDOStatement &$stmt)
    {
        $this->getIntValues($this->langue_traduction, $this->langue_fichier, $this->etat);
        foreach (static::$tableSchema as $columnName => $type) {
            var_dump($type);

            if ($type == 4) {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitizedValue);

            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
            }
        }
    }

    private function getIntValues($id1, $id2, $id_etat)
    {
        self::getConnection();
        $stmt = self::$conn->prepare('SELECT *  FROM  langues WHERE name_langue  ="' . $id1 . '"');
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->langue_fichier = (int) $row['id_langue'];

        $stmt = self::$conn->prepare('SELECT *  FROM  langues WHERE name_langue  ="' . $id2 . '"');
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->langue_traduction = (int) $row['id_langue'];

        $stmt = self::$conn->prepare('SELECT * FROM etat  WHERE nom ="' . $id_etat . '"');
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->etat = (int) $row['id'];

        $this->type = array_search($this->type, self::$types_traduction) + 1;

    }

    private static function getConnection()
    {
        if (self::$conn == null) {
            self::$conn = new \PDO(
                'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
                DATABASE_USER_NAME,
                DATABASE_PASSWORD,
                array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                )
            );
        }
    }

    private function putLangues($id1, $id2)
    {
        self::getConnection();
        $stmt = self::$conn->prepare('SELECT *  FROM  langues WHERE id_langue  =' . $id1);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->langue_fichier = $row['name_langue'];

        $stmt = self::$conn->prepare('SELECT *  FROM  langues WHERE id_langue  =' . $id2);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->langue_traduction = $row['name_langue'];

    }

    private function putAll($id_etat)
    {
        self::getConnection();
        $stmt = self::$conn->prepare('SELECT * FROM etat  WHERE id  =' . $id_etat);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->etat = $row['nom'];

    }

    public static function getByTraducteur($id_traducteur)
    {
        static::getConnection();
        $sql = 'SELECT * FROM traduction WHERE id_traducteur =' . $id_traducteur;
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;
        }
        return false;
    }

    public static function getByClient($id_client)
    {
        static::getConnection();

        $sql = 'SELECT * FROM traduction WHERE id_client =' . $id_client;
        $stmt = self::$conn->prepare($sql);

        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $rows;
        }
        return false;
    }

    public function getClient()
    {
        self::getConnection();
        $sql = 'SELECT * FROM client WHERE id = ' . (int)$this->id_client;
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetch(\PDO::FETCH_ASSOC);

            return  new UserModel($rows) ;
        }
        return false;

    }
      public function getTraducteur()
    {
        self::getConnection();
        $sql = 'SELECT * FROM traducteur WHERE id = ' . (int)$this->id_traducteur;
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetch(\PDO::FETCH_ASSOC);
            return new UserModel($rows);
        }
        return false;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getIdTraducteur()
    {
        return $this->id_traducteur;
    }

    /**
     * @param mixed $id_traducteur
     */
    public function setIdTraducteur($id_traducteur)
    {
        $this->id_traducteur = $id_traducteur;
    }

    /**
     * @return false|string
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param false|string $date_debut
     */
    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return null
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * @param null $devis
     */
    public function setDevis($devis)
    {
        $this->devis = $devis;
    }

    /**
     * @return null
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param null $date_fin
     */
    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed|string
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * @param mixed|string $specification
     */
    public function setSpecification($specification)
    {
        $this->specification = $specification;
    }

    /**
     * @return string
     */
    public function getLangueFichier()
    {
        return $this->langue_fichier;
    }

    /**
     * @param string $langue_fichier
     */
    public function setLangueFichier($langue_fichier)
    {
        $this->langue_fichier = $langue_fichier;
    }

    /**
     * @return string
     */
    public function getLangueTraduction()
    {
        return $this->langue_traduction;
    }

    /**
     * @param string $langue_traduction
     */
    public function setLangueTraduction($langue_traduction)
    {
        $this->langue_traduction = $langue_traduction;
    }

    /**
     * @return mixed|string
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * @param mixed|string $fichier
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * @return mixed
     */
    public static function getConn()
    {
        return self::$conn;
    }

    /**
     * @param mixed $conn
     */
    public static function setConn($conn)
    {
        self::$conn = $conn;
    }

    /**
     * @return array
     */
    public static function getTypesTraduction()
    {
        return self::$types_traduction;
    }

    /**
     * @param array $types_traduction
     */
    public static function setTypesTraduction($types_traduction)
    {
        self::$types_traduction = $types_traduction;
    }

}
