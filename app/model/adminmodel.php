<?php


namespace PHPMVC\Model;


class AdminModel extends AbstractModel
{

    private $nom;
    private $password;
    private $listClients ;
    private $listTraducteur ;
    private $listTraduction ;

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
    public function getListClients()
    {
        return $this->listClients;
    }

    /**
     * @param mixed $listClients
     */
    public function setListClients($listClients)
    {
        $this->listClients = $listClients;
    }

    /**
     * @return mixed
     */
    public function getListTraducteur()
    {
        return $this->listTraducteur;
    }

    /**
     * @param mixed $listTraducteur
     */
    public function setListTraducteur($listTraducteur)
    {
        $this->listTraducteur = $listTraducteur;
    }

    /**
     * @return mixed
     */
    public function getListTraduction()
    {
        return $this->listTraduction;
    }

    /**
     * @param mixed $listTraduction
     */
    public function setListTraduction($listTraduction)
    {
        $this->listTraduction = $listTraduction;
    }

    /**
     * @return mixed
     */
    public function getListDevis()
    {
        return $this->listDevis;
    }

    /**
     * @param mixed $listDevis
     */
    public function setListDevis($listDevis)
    {
        $this->listDevis = $listDevis;
    }

    /**
     * @return string
     */
    public static function getTableName()
    {
        return self::$tableName;
    }

    /**
     * @param string $tableName
     */
    public static function setTableName($tableName)
    {
        self::$tableName = $tableName;
    }

    /**
     * @return array
     */
    public static function getTableSchema()
    {
        return self::$tableSchema;
    }

    /**
     * @param array $tableSchema
     */
    public static function setTableSchema($tableSchema)
    {
        self::$tableSchema = $tableSchema;
    }
    public $listDevis ;
    
    protected static $tableName = 'admin';
    protected static $tableSchema = array(
        'nom'          => self::DATA_TYPE_STR,
        'password'          => self::DATA_TYPE_STR

    );
    
    //protected static $primaryKey = 'id';

    /* public function __construct($nom,$Prename,$Password,$Email,$PhoneNumber)
     {
         $this->Username=$nom;
         $this->Prename=$nom;
         $this->Password=$nom;
         $this->Email=$nom;
         $this->PhoneNumber=$nom;
     }*/

    public function cryptPassword($password)
    {
        $this->Password = crypt($password, APP_SALT);
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
   
     

    /*public static function authenticate ($username, $password, $session)
    {
        $password = crypt($password, APP_SALT) ;
        $sql = 'SELECT *, (SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId = ' . self::$tableName . '.GroupId) GroupName FROM ' . self::$tableName . ' WHERE Username = "' . $username . '" AND Password = "' .  $password . '"';
        $foundUser = self::getOne($sql);
        if(false !== $foundUser) {
            if($foundUser->Status == 2) {
                return 2;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByPK($foundUser->UserId);
            $foundUser->privileges = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId);
            $session->u = $foundUser;
            return 1;
        }
        return false;
    }*/
}