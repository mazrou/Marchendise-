<?php
namespace PHPMVC\Model;

use PHPMVC\Lib\Database\DatabaseHandler;
use PHPMVC\Model\AbstractModel;

class UserModel extends AbstractModel
{
    private $id;
    private $nom;
    private $prenom;
    private $password;
    private $email;
    private $phone;
    private $adresse;
    private $blocker = false;
    private $suppimer = false;
    private static $conn;

    protected static $tableName = 'client';
    protected static $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'nom' => self::DATA_TYPE_STR,
        'prenom' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'phone' => self::DATA_TYPE_INT,
        'adresse' => self::DATA_TYPE_STR,
        'blocker' => self::DATA_TYPE_STR,
        'suprimer' => self::DATA_TYPE_INT,

    );

    protected static $primaryKey = 'id';

    public function __construct($row, $exist = true) /* after database request */
    {
        if ($exist) {
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->password = $row['password'];
            $this->email = $row['email'];
            $this->adresse = $row['adresse'];
            $this->phone = $row['phone'];
            $this->blocker = (boolean) $row['blocker'];
            $this->supprimer = (boolean) $row['supprimer'];
        } else {
            $this->nom = $row[0];
            $this->prenom = $row[1];
            $this->adresse = $row[2];
            $this->phone = $row[3];
            $this->email = $row[4];
            $this->password = sha1($row[5]);
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
        $sql = 'INSERT INTO client (nom,prenom,adresse,phone,email,password,blocker,suprimer)   VALUES (?,?,?,?,?,?,false,false)';
        $stmt = self::$conn->prepare($sql);
        $obj = array($this->nom,
            $this->prenom,
            $this->adresse,
            $this->phone,
            $this->email,
            $this->password,
        );
        if ($stmt->execute($obj)) {
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;

    }
    public static function authenticate($email, $password)
    {
        self::getConnection();
        $stmt = self::$conn->prepare(" SELECT *  FROM client WHERE password =:password AND email= :email");
        $stmt->bindParam('email', $email, \PDO::PARAM_STR);
        $stmt->bindValue('password', sha1($password), \PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        var_dump($row);

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
        $this->password = $password;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     * @return bool
     */
    public function isSuppimer()
    {
        return $this->suppimer;
    }

    /**
     * @param bool $suppimer
     */
    public function setSuppimer($suppimer)
    {
        $this->suppimer = $suppimer;
    }

}
