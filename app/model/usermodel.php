<?php
namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Model\AbstractModel;

class UserModel extends AbstractModel
{
    private $id;
    private $nom;
    private $mot_de_passe;
    private $email;
    private $telephone;
    private $adresse;

    private static $conn;

    protected static $tableName = 'client';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'nom' => self::DATA_TYPE_STR,
        'mot_de_passe' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'telephone' => self::DATA_TYPE_INT,
        'adresse' => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'id';

    public function __construct($row, $exist = true) /* after database request */
    {
        if ($exist) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->mot_de_passe = $row['mot_de_passe'];
            $this->email = $row['email'];
            $this->adresse = $row['adresse'];
            $this->telephone = $row['telephone'];
        } else {
            $this->nom = $row[0];
            $this->adresse = $row[1];
            $this->telephone = $row[2];
            $this->email = $row[3];
            $this->mot_de_passe = sha1($row[4]);
        }

    }

    public function cryptPassword($password)
    {
        $this->password = sha1($password);
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
        $sql = 'INSERT INTO client (nom,adresse,telephone,email,mot_de_passe)   VALUES (?,?,?,?,?)';
        $stmt = self::$conn->prepare($sql);
        $obj = array($this->nom,
            $this->adresse,
            $this->telephone,
            $this->email,
            $this->mot_de_passe,
        );

        if ($stmt->execute($obj)) {
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            $sql = "SELECT id FROM client WHERE email = '" . $this->email . "'";
            $stmt = self::$conn->prepare($sql);
            if ($stmt->execute()) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $this->id = $row["id"];
            }
            return true;
        }
        return false;

    }

    public static function authenticate($email, $password)
    {
        self::getConnection();
        $stmt = self::$conn->prepare(" SELECT *  FROM client WHERE mot_de_passe =:mot_de_passe AND email= :email");
        $stmt->bindParam('email', $email, \PDO::PARAM_STR);
        $stmt->bindValue('mot_de_passe', sha1($password), \PDO::PARAM_STR);
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
    public function getMarchendise()
    {
        self::getConnection();
        $sql = "SELECT * FROM marchendise WHERE id_client = " . (int) $this->id;
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $marchendises = array();
            foreach ($rows as $row) {
                array_push($marchendises, new MarchendiseModel($row));
            }
            return $marchendises;
        }
        return null;
    }

    public static function getAll()
    {
        self::getConnection();
        $sql = "SELECT * FROM client";
        $stmt = self::$conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $client = array();
            foreach ($rows as $row) {
                array_push($client, new UserModel($row));
            }
            return $client;
        }
        return null;
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
     * @return UserModel
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
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

}
