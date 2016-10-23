<?php


    namespace coreControllers;

    class Route{

        

    }

    class ApplicationCoreController{

        public $load;

        public function __construct(){
            $this->load = $this;
        }

        public static function view($view_name, array $array = null){

            /*if(!empty($array)){
                foreach($array as $key => $value){
                    $$key = $value;
                }
            }*/

            $file_path = $_SERVER['DOCUMENT_ROOT']."/views/$view_name.php";

            if(file_exists($file_path))
                include './views/'.$view_name.'.php';
            else{
                echo "<div style='display: block; width: 50%; border: 1px solid #f7dbdb; padding: 10px; margin: 0 auto; text-align: center; border-radius:6px;'>View <strong>$view_name</strong> not found. </div><br />";
                exit;
            }


        }

        public function __set($property,  $value){
            $property = $value;
        }

        public function __get($property){
            return new $property;
        }


        public function model($model_name){

            $file_path = $_SERVER['DOCUMENT_ROOT']."/models/$model_name.php";

            if(file_exists($file_path)){
                include './Models/'.$model_name.'.php'; // Include model
                self::__set($model_name,  $model_name);


            }else{
                echo "<div style='display: block; width: 50%; border: 1px solid #f7dbdb; padding: 10px; margin: 0 auto; text-align: center; border-radius:6px;'>Model <strong>$model_name</strong> not found. </div><br />";
                exit;
            }

        }


        public static function library($library_name){

            if(is_string($library_name))
                include './Libraries/'.$library_name.'.php';
            else{
                echo 'This library not found.';
                exit;
            }

        }
        
        


    }

?>