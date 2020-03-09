<?php
use PDO;

namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;

class TransportateurModel extends AbstractModel
{
    /*-------------- attributs d'un transportateur --------------------*/
    private $id;
    private $nom = "";
    private $mot_de_passe = "";
    private $email = "";
    private $telephone = "";
    private $addresse = "";
    private $blocker = false;
    private $supprimer = false;
    /*-----------------------------------------------------------------*/
    
    private static $conn;
    protected static $primaryKey = 'id';
    protected static $tableName = 'transportateur';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'nom' => self::DATA_TYPE_STR,
        'mot_de_passe' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'telephone' => self::DATA_TYPE_STR,
        'addresse' => self::DATA_TYPE_STR,
        'supprimer' => self::DATA_TYPE_BOOL,
        'blocker' => self::DATA_TYPE_BOOL,
    );

    public function __construct($row, $exist=true) /* after database request */
    {
        if ($exist) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->mot_de_passe = $row['mot_de_passe'];
            $this->email = $row['email'];
            $this->addresse = $row['addresse'];
            $this->telephone = $row['telephone'];
            $this->blocker = $row['blocker'];
            $this->supprimer = $row['supprimer'];
        } else {
            $this->nom = $row[0];
            $this->addresse= $row[1];
            $this->telephone = $row[2];
            $this->email= $row[3];
            $this->mot_de_passe = sha1($row[4]);
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
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    public static function authenticate($email, $mot_de_passe)
    {
        self::getConnection();
        $stmt = self::$conn->prepare(" SELECT *  FROM ".static::$tableName ." WHERE mot_de_passe =:mot_de_passe AND email= :email");
        $stmt->bindParam('email', $email, \PDO::PARAM_STR);
        $stmt->bindValue('mot_de_passe', sha1($mot_de_passe), \PDO::PARAM_STR);
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
   
    public function cryptPassword($password)
    {
        $this->password = sha1($password);
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed|string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    /**
     * @param string $mot_de_passe
     */
    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed|string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed|string
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * @param mixed|string $addresse
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;
    }

    /**
     * @return bool|mixed
     */
    public function getBlocker()
    {
        return $this->blocker;
    }

    /**
     * @param bool|mixed $blocker
     */
    public function setBlocker($blocker)
    {
        $this->blocker = $blocker;
    }

    /**
     * @return bool|mixed
     */
    public function getSupprimer()
    {
        return $this->supprimer;
    }

    /**
     * @param bool|mixed $supprimer
     */
    public function setSupprimer($supprimer)
    {
        $this->supprimer = $supprimer;
    }


}