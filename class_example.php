<?php
    class Example{

        public $message;
        private $secret;

        //constructor 用两个下划线
        //可以在$message前加 int类型 string等类型，去强迫这个argument的类型，也可以不加
        public function __construct (string $message){
            $this->message=$message;
            $this->secret ="PSST...";
        }


        public function display_message(){
            echo $this->message."<br/>";
        }

        public function yell_message(){
            //str to upper 把这个大写打印出来
            echo strtoupper($this->message."<br/>");
        }


        public function get_secret(){
            return $this->secret;
        }

        public function set_secret($secret){
            $this->secret = $secret;
        }
    }


    //cast the 5.5 to string
    $example = new Example("Hello World");
    $example->display_message();
    $example->yell_message();
    $example->message = "Goodbye.";
    $example->yell_message();
    $example->set_secret("shhhh");
    echo $example->get_secret();


?>