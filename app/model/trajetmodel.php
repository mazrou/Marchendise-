<?php
namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Model\AbstractModel;

class TrajetModel extends AbstractModel
{
    /*-------------- attributs d'un transportateur --------------------*/
    private $id;
    private $lieu_depart = "";
    private $lieu_arrive = "";
    private $kilo_metre;
    private $devis;
    private $date_retour;
    private $regulier = false;
    private $frequence = 0;
    private $moyen_transpor;
    private $lieu_intermediare;
    private $volume = "0";
    private $poids = "0";
    private $id_client = null;
    private $id_transportatuer = -1;
    private $date_arrive;
    private $date_depart;
    private $date_voyage;
    private $done = false;
    /*-----------------------------------------------------------------*/

    private static $conn;
    protected static $primaryKey = 'id';
    protected static $tableName = 'trajet';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'lieu_depart' => self::DATA_TYPE_STR,
        'lieu_arrive' => self::DATA_TYPE_STR,
        'kilo_metre' => self::DATA_TYPE_INT,
        'devis' => self::DATA_TYPE_INT,
        'date_arrive' => self::DATA_TYPE_DATE,
        'date_depart' => self::DATA_TYPE_DATE,
        'date_retour' => self::DATA_TYPE_DATE,
        'volume' => self::DATA_TYPE_STR,
        'poids' => self::DATA_TYPE_STR,
        'id_client' => self::DATA_TYPE_INT,
        'id_transportatuer ' => self::DATA_TYPE_INT,
        'done' => self::DATA_TYPE_BOOL,
        'regulier' => self::DATA_TYPE_BOOL,
        'frequence' => self::DATA_TYPE_STR,
        'moyen_transpor' => self::DATA_TYPE_STR,
        'lieu_intermediare' => self::DATA_TYPE_STR,
        'date_voyage' => self::DATA_TYPE_DATE,
        'done' => self::DATA_TYPE_BOOL,

    );

    public function __construct($row, $exist = true) /* after database request */
    {
        if ($exist) {
            $this->id = $row['id'];
            $this->lieu_depart = $row['lieu_depart'];
            $this->lieu_arrive = $row['lieu_arrive'];
            $this->lieu_intermediare = $row['lieu_intermediare'];
            $this->date_depart = $row['date_depart'];
            $this->date_arrive = $row['date_arrive'];
            $this->kilo_metre = $row['kilo_metre'];
            $this->volume = $row['volume'];
            $this->poids = $row['poids'];
            $this->regulier = $row['regulier'];
            $this->date_retour = $row['date_retour'];
            $this->frequence = $row['frequence'];
            $this->date_voyage = $row['date_voyage'];
            $this->moyen_transpor = $row['moyen_transpor'];
            $this->devis = $row['devis'];
            $this->done = $row['done'];
            $this->id_client = $row['id_client'];
            $this->id_transportatuer = $row['id_transportatuer'];

        } else {
            $this->lieu_depart = $row[0];
            $this->lieu_arrive = $row[1];
            $this->lieu_intermediare = $row[2];
            $this->date_depart = $row[3];
            $this->date_arrive = $row[4];
            $this->kilo_metre = (int) $row[5];
            $this->volume = $row[6];
            $this->poids = $row[7];
            $this->regulier = (int) $row[8];
            $this->date_retour = $row[9];
            $this->frequence = $row[10];
            $this->date_voyage = $row[11];
            $this->moyen_transpor = $row[12];
            $this->devis = (int) $row[13];
            $this->id_transportatuer = (int) $row[14];
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
        $sql = 'INSERT INTO ' . static::$tableName . ' SET
                                         lieu_depart="' . $this->lieu_depart . '",
                                         lieu_arrive ="' . $this->lieu_arrive . '",
                                         lieu_intermediare="' . $this->lieu_intermediare . ' ",
                                         date_arrive ="' . $this->date_arrive . '",
                                         date_depart="' . $this->date_depart . '" ,
                                         kilo_metre =' . $this->kilo_metre . ',
                                         volume ="' . $this->volume . '",
                                         poids ="' . $this->poids . ' ",
                                         regulier =' . $this->regulier . ',
                                         frequence="' . $this->frequence . '",
                                         date_voyage="' . $this->date_voyage . '",
                                         devis=' . $this->devis . ',
                                         moyen_transpor="' . $this->moyen_transpor . '",
                                         id_transportatuer=' . $this->id_transportatuer . ';';
        $stmt = self::$conn->prepare($sql);

        $obj = array(
            $this->id,
            $this->lieu_depart,
            $this->lieu_arrive,
            $this->lieu_intermediare,
            $this->date_depart,
            $this->date_arrive,
            $this->kilo_metre,
            $this->volume,
            $this->poids,
            $this->regulier,
            $this->date_retour,
            $this->frequence,
            $this->date_voyage,
            $this->devis,
            $this->moyen_transpor,
            $this->id_transportatuer,
            $this->id_client,
            $this->done,
        );

        if ($stmt->execute($obj)) {

            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }
   public static function getTrajet()
    {
        self::getConnection();
        $sql = "SELECT * FROM trajet ";
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $marchendises = array();
            foreach ($rows as $row) {
                array_push($marchendises, new TrajetModel($row));
            }
            return $marchendises;
        }
        return null;

    }
    private function prepareValues(\PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $columnName => $type) {
            if ($type == 4) {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitizedValue);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);

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
     * @return mixed|string
     */
    public function getLieuDepart()
    {
        return $this->lieu_depart;
    }

    /**
     * @param mixed|string $lieu_depart
     */
    public function setLieuDepart($lieu_depart)
    {
        $this->lieu_depart = $lieu_depart;
    }

    /**
     * @return mixed|string
     */
    public function getLieuArrive()
    {
        return $this->lieu_arrive;
    }

    /**
     * @param mixed|string $lieu_arrive
     */
    public function setLieuArrive($lieu_arrive)
    {
        $this->lieu_arrive = $lieu_arrive;
    }

    /**
     * @return int
     */
    public function getKiloMetre()
    {
        return $this->kilo_metre;
    }

    /**
     * @param int $kilo_metre
     */
    public function setKiloMetre($kilo_metre)
    {
        $this->kilo_metre = $kilo_metre;
    }

    /**
     * @return int
     */
    public function getDevis()
    {
        return $this->devis;
    }

    /**
     * @param int $devis
     */
    public function setDevis($devis)
    {
        $this->devis = $devis;
    }

    /**
     * @return mixed
     */
    public function getDateRetour()
    {
        return $this->date_retour;
    }

    /**
     * @param mixed $date_retour
     */
    public function setDateRetour($date_retour)
    {
        $this->date_retour = $date_retour;
    }

    /**
     * @return bool|int
     */
    public function getRegulier()
    {
        return $this->regulier;
    }

    /**
     * @param bool|int $regulier
     */
    public function setRegulier($regulier)
    {
        $this->regulier = $regulier;
    }

    /**
     * @return int|mixed
     */
    public function getFrequence()
    {
        return $this->frequence;
    }

    /**
     * @param int|mixed $frequence
     */
    public function setFrequence($frequence)
    {
        $this->frequence = $frequence;
    }

    /**
     * @return mixed
     */
    public function getMoyenTranspor()
    {
        return $this->moyen_transpor;
    }

    /**
     * @param mixed $moyen_transpor
     */
    public function setMoyenTranspor($moyen_transpor)
    {
        $this->moyen_transpor = $moyen_transpor;
    }

    /**
     * @return mixed
     */
    public function getLieuIntermediare()
    {
        return $this->lieu_intermediare;
    }

    /**
     * @param mixed $lieu_intermediare
     */
    public function setLieuIntermediare($lieu_intermediare)
    {
        $this->lieu_intermediare = $lieu_intermediare;
    }

    /**
     * @return mixed|string
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed|string $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed|string
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @param mixed|string $poids
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    /**
     * @return mixed|null
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed|null $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return int
     */
    public function getIdTransportatuer()
    {
        return $this->id_transportatuer;
    }

    /**
     * @param int $id_transportatuer
     */
    public function setIdTransportatuer($id_transportatuer)
    {
        $this->id_transportatuer = $id_transportatuer;
    }

    /**
     * @return mixed
     */
    public function getDateArrive()
    {
        return $this->date_arrive;
    }

    /**
     * @param mixed $date_arrive
     */
    public function setDateArrive($date_arrive)
    {
        $this->date_arrive = $date_arrive;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->date_depart;
    }

    /**
     * @param mixed $date_depart
     */
    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;
    }

    /**
     * @return mixed
     */
    public function getDateVoyage()
    {
        return $this->date_voyage;
    }

    /**
     * @param mixed $date_voyage
     */
    public function setDateVoyage($date_voyage)
    {
        $this->date_voyage = $date_voyage;
    }

    /**
     * @return bool|mixed
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @param bool|mixed $done
     */
    public function setDone($done)
    {
        $this->done = $done;
    }

}
