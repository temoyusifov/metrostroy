<?php

    include 'appCoreController.php';

    //use coreControllers;

    class Home extends coreControllers\AppCoreController{

        public function main(){

            // Some statement

            $languages = array(
                'GEO' => 'Georgian',
                'ENG' => 'English',
                'RUS' => 'Russian'
            );

            $this->load->library('load'); // This line for load module when we get library object

            $this->load->model('usersModel');
            $usersObject = $this->usersModel->getUsers(); // returns object

            
            //$this->load->view('welcome', $languages);
           // $this->load->view('welcome2', $languages);
           // $this->load->view('welcome3', $languages);

        }



    }

?>