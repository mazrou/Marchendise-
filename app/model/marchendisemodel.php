<?php
namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Model\AbstractModel;

class MarchendiseModel extends AbstractModel
{
    /*-------------- attributs d'un transportateur --------------------*/
    private $id;
    private $description = "";
    private $lieu_depart = "";
    private $lieu_arrive = "";
    private $photos = null;
    private $demande_speciale = null;
    private $volume = "0";
    private $poids = "0";
    private $id_client = -1;
    private $id_transportatuer = null;
    private $date_arrive;
    private $date_depart;
    private $tarif = null;
    private $done = false;
    /*-----------------------------------------------------------------*/

    private static $conn;
    protected static $primaryKey = 'id';
    protected static $tableName = 'marchendise';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'description' => self::DATA_TYPE_STR,
        'lieu_depart' => self::DATA_TYPE_STR,
        'lieu_arrive' => self::DATA_TYPE_STR,
        'photos' => self::DATA_TYPE_STR,
        'demande_speciale' => self::DATA_TYPE_STR,
        'volume' => self::DATA_TYPE_STR,
        'poids' => self::DATA_TYPE_STR,
        'date_arrive' => self::DATA_TYPE_DATE,
        'date_depart' => self::DATA_TYPE_DATE,
        'id_client' => self::DATA_TYPE_INT,
        'id_transportatuer ' => self::DATA_TYPE_INT,
        'tarif' => self::DATA_TYPE_INT,
        'done' => self::DATA_TYPE_BOOL,
    );

    public function __construct($row, $exist = true) /* after database request */
    {
        if ($exist) {
            $this->description = $row["description"];
            $this->lieu_depart = $row["lieu_depart"];
            $this->lieu_arrive = $row["lieu_arrive"];
            $this->photos = $row["photos"];
            $this->demande_speciale = $row["demande_speciale"];
            $this->volume = $row["volume"];
            $this->poids = $row["poids"];
            $this->id_client = $row["id_client"];
            $this->date_depart = $row["date_depart"];
            $this->date_arrive = $row["date_arrive"];
            $this->done =$row["done"];
            $this->tarif = $row["tarif"] ; 
            $this->id_transportatuer = $row["id_transportatuer"];
            $this->id = $row["id"];
        } else {

            $this->description = $row[0];
            $this->lieu_depart = $row[1];
            $this->lieu_arrive = $row[2];
            $this->photos = $row[3];
            $this->demande_speciale = $row[4];
            $this->volume = $row[5];
            $this->poids = $row[6];
            $this->id_client = $row[7];
            $this->date_depart = $row[8];
            $this->date_arrive = $row[9];

        }
    }

    private function buildNameParametersSQL()
    {
        $namedParams = '';
        foreach (static::$tableSchema as $columnName => $type) {
            $namedParams .= $columnName . ' = :' . $columnName . ', ';
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
        $sql = 'INSERT INTO ' . static::$tableName . ' (id , description , lieu_depart, lieu_arrive , photos , demande_speciale , volume , poids , date_arrive , date_depart , id_client , id_transportatuer , tarif ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);';
        $stmt = self::$conn->prepare($sql);
        $obj = array(
            $this->id,
            $this->description,
            $this->lieu_depart,
            $this->lieu_arrive,
            $this->photos,
            $this->demande_speciale,
            $this->volume,
            $this->poids,
            $this->date_depart,
            $this->date_arrive,
            $this->id_client,
            $this->id_transportatuer,
            $this->tarif,

        );
        if ($stmt->execute($obj)) {
            
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    private function prepareValues(\PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $columnName => $type) {
            if ($type == 4) {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitizedValue);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
                var_dump($type);

            }
        }
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

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed|string
     */
    public function getLieuDepart()
    {
        return $this->lieu_depart;
    }

    /**
     * @return mixed|string
     */
    public function getLieuArrive()
    {
        return $this->lieu_arrive;
    }

    /**
     * @return mixed
     */
    public function getDateArrive()
    {
        return $this->date_arrive;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->date_depart;
    }

    /**
     * @return mixed|null
     */
    public function getTarif()
    {
        return $this->tarif;
    }
   

}
