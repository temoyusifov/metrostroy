<?php

    namespace Connection;
    use PDO;

    class DB{

        private $db = 'cms';
        private $dbUser = 'db_user';
        private $dbUserPass = 'db_user_pass';
        private static $_instance = null;


        private function __construct(){

            try{
                $this->connection = new PDO("mysql:host=localhost; dbname=$this->db", $this->dbUser, $this->dbUserPass);
            }catch(PDOException $e){
                echo $e->getMessage();
            }

        }

        protected function __clone(){}


        static public function getInstance(){

            if(is_null(self::$_instance)){
                self::$_instance = new self();
            }
            return self::$_instance;

        }


        public function getConnection(){

            return $this->connection;

        }

    }


    namespace coreModels;
    use Connection;

    class ApplicationCoreModel{

        protected $db;
        private $connection;

        public function __construct(){
            $this->db = $this;
            $this->getInstance = Connection\DB::getInstance();
        }

        public function select($table, array $fields = null, array $where = null, array $limit = null, $orderBy = null){ // PARAMETERS FOR GENERATING QUERY

            if(is_string($table)){

                // IF SET ROWS PARAMETER
                if(is_array($fields) && !empty($fields)){
                  $rows = "`".implode("`,`", $fields)."`";
                }else
                    $rows = "*";

                // IF SET LIMIT PARAMETER
                if(is_array($limit) && !empty($limit)){
                    $num = implode(",", $limit);
                    $limit = "LIMIT $num";
                }

                // IF SET WHERE PARAMETER
                if(is_array($where) && !empty($where)){
                    $clause = implode("=", $where);
                    $where = "WHERE $clause";
                }

                // IF SET ORDER BY PARAMETER
                if(is_array($orderBy) && !empty($orderBy)){
                    $orderBy = implode(" ", $orderBy);
                    $orderBy = "ORDER BY $orderBy";
                }

            }

            $sql = "SELECT $rows FROM $table $where $orderBy $limit"; // GENERATED SELECT QUERY

           // echo $sql;

            $getInstance = $this->getInstance;
            $connection = $getInstance->getConnection();
            $query = $connection->prepare($sql);

            if($query->execute()){
                return $query->fetchObject();
            }
            else
                echo 'fuck';

          //$query->execute();
          //  var_dump($this->connection);


            //echo $sql;

        }

    }




    //$instance = ApplicationCoreModel::getInstance();



?>