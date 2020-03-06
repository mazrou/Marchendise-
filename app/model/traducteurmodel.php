<?php
use PDO;

namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;

class TraducteurModel extends AbstractModel
{
    private $id;
    private $nom = "";
    private $prenom = "";
    private $password = "";
    private $email = "";
    private $phone = "";
    private $adresse = "";
    private $langues = array();
    private $blocker = false;
    private $supprimer = false;
    private $accepter = true;
    private $cv = "";

    private static $conn;

    protected static $primaryKey = 'id';
    protected static $tableName = 'traducteur';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'nom' => self::DATA_TYPE_STR,
        'prenom' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'phone' => self::DATA_TYPE_STR,
        'cv' => self::DATA_TYPE_INT,
        'adresse' => self::DATA_TYPE_STR,
        'accepter' => self::DATA_TYPE_BOOL,
        'supprimer' => self::DATA_TYPE_BOOL,
        'blocker' => self::DATA_TYPE_BOOL,
    );

    public function __construct($row,$exist=true) /* after database request */
    {
        if ($exist) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->password = $row['password'];
            $this->email = $row['email'];
            $this->adresse = $row['adresse'];
            $this->phone = $row['phone'];
            $this->blocker = $row['blocker'];
            $this->supprimer = $row['supprimer'];
            $this->accepter = $row['accepter'];
            $this->cv = $row['cv'];
            /* Recuperer les langues du traduteur */
            $this->putLangues();
        }
        else {
            $this->nom = $row[0];
            $this->prenom = $row[1];
            $this->adresse= $row[2];
            $this->phone = $row[3];
            $this->email= $row[4];
            $this->password = sha1($row[5]);
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
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL();
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        if ($stmt->execute()) {
            var_dump($stmt);
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    public static function authenticate($email, $password)
    {
        self::getConnection();
        $stmt = self::$conn->prepare(" SELECT *  FROM traducteur WHERE password =:password AND email= :email");
        $stmt->bindParam('email', $email, \PDO::PARAM_STR);
        $stmt->bindValue('password', sha1($password), \PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($count == 1 && !empty($row)) {
            return $row;
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

    private function putLangues()
    {
        self::getConnection();
        $stmt = self::$conn->prepare('SELECT l.name_langue  FROM ' . self::$tableName . '  AS t
                                JOIN lagues_traducteur AS lt
                                ON t.id = lt.id_traducteur
                                JOIN langues AS l
                                ON l.id_langue =  lt.id_langue
                                WHERE t.id = ' . $this->id);

        $stmt->execute();

        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($row as $r) {
            array_push($this->langues, $r['name_langue']);
        }
    }

    public function getLanguesString()
    {
        $this->putLangues();
        foreach ($this->langues as $langue) {
            $result .= $langue . ', ';
        }
        return trim($result, ', ');
    }
    public function cryptPassword($password)
    {
        $this->password = sha1($password);
    }
    public static function getAllLangue()
    {
        self::getConnection();

        $stmt = self::$conn->prepare('SELECT * FROM langues ORDER BY id_langue');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public static function getBy($columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);

        $whereClauseValues = array_values($columns);

        $whereClause = [];
        for ($i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }

        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;

        return static::get($sql, $options);
    }
    public static function get($sql, $options = array())
    {
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $columnName => $type) {
                if ($type[0] == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}", $sanitizedValue);
                } elseif ($type[0] == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$columnName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }
        $stmt->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }

    // TODO:: FIX THE TABLE ALIASING
    public static function getUsers(UserModel $user)
    {
        return self::get(
            'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' . $user->id
        );
    }

    public static function userExists($username)
    {
        return self::get('
                SELECT * FROM ' . self::$tableName . ' WHERE Username = "' . $username . '"
            ');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
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
    public function getSupprimer()
    {
        return $this->supprimer;
    }

    /**
     * @param mixed $supprimer
     */
    public function setSupprimer($supprimer)
    {
        $this->supprimer = $supprimer;
    }

    /**
     * @return mixed
     */
    public function getAccepter()
    {
        return $this->accepter;
    }

    /**
     * @param mixed $accepter
     */
    public function setAccepter($accepter)
    {
        $this->accepter = $accepter;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $this->cryptPassword($password);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $mail
     */
    public function setEmail($mail)
    {
        $this->email = $mail;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $tel
     */
    public function setPhone($tel)
    {
        $this->phone = $tel;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getLangues()
    {
        return $this->langues;
    }

    /**
     * @param mixed $langues
     */
    public function setLangues($langues)
    {
        $this->langues = $langues;
    }

    /**
     * @return mixed
     */
    public function getBlocker()
    {
        return $this->blocker;
    }

    /**
     * @param mixed $block
     */
    public function setBlocker($block)
    {
        $this->blocker = $block;
    }
}

/*
public function serialize()
{
var_dump('$ter->serialize()');

return serialize([
$this->id,
$this->nom,
$this->prenom,
$this->password,
$this->email,
$this->adresse,
$this->phone,
$this->blocker,
$this->supprimer,
$this->accepter,
$this->cv,

]);
}

public function unserialize($data)
{
list(
$this->id,
$this->nom,
$this->prenom,
$this->password,
$this->email,
$this->adresse,
$this->phone,
$this->blocker,
$this->supprimer,
$this->accepter,
$this->cv,
) = unserialize($data);
}*/
