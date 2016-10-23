<?php

    include 'appCoreController.php';

    //use coreControllers;

    class Blank extends coreControllers\AppCoreController{

        public function main(){

            $this->load->view('404');

        }



    }

?>