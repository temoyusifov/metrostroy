<?php

    include 'appCoreModel.php';

    class usersModel extends coreModels\applicationCoreModel{

        
        public function getUsers(){

            $fields = array('username', 'password', 'email');
            $where = array('id', 2);
            $orderBy = array('id', 'ASC');
            $limit = array(0, 10);

            //$result = $this->db->select('users', $fields, $where, $limit, $orderBy);

            $result = $this->db->select('users');
            //$result = $this->db->select('users', null, $where, $orderBy);


            var_dump( $result );


            /*$this->select('username, password')->
                        from('users')->
                            innerJoin('settings')->
                                on('users.id = settings.uid')->
                                    where('users.id = 23')->execute();*/

        }

    }


?>