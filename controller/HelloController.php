<?php

class HelloController{
    public function showMessage(){
        $model = new HelloModel();
        $message = $model -> getMessage();
        include 'view/HelloView.php'; //Include the view to display the message
    }

}