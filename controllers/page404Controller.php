<?php

    include 'appCoreController.php';
    use coreControllers as core;

    class Page404 extends core\AppCoreController{

        public function __call($methodName, $methodArguments){
            $this->load->view('404');
        }

        public function main(){

            $this->load->view('404');

        }


    }

?>