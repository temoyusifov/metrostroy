<?php

    $defaultController = 'home'; // Default controller.
    $defaultMethod = 'index'; // If call class but not call method.




    class Route{

        public function get(string $uri, string $call){

            if(is_string($uri)){

                $action = explode('@', $call);
                $segments = explode('/', $uri);

                $a = array_shift($action);
                $b = array_shift($action);

                $c = array_shift($segments);
                $_GET[$c] = $c;

                
                $d = array_shift($segments);
                $_GET[$d] = $d;



                print_r($_GET);



            }

        }



    }


    Route::get('/welcome', 'homeController@main');


?>