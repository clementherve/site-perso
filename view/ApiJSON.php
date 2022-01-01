<?php
namespace Blog;

require_once __DIR__ . "/../vendor/autoload.php";

class ApiJSON {

    public function ok($message) {
        $this->response("ok", $message);
    }


    public function failed($message, $header="200 OK") {
        $this->response("failed", $message, $header);
    }


    private function response($status, $message, $header="200 OK") {
        header("HTTP/1.1 $header");
        header("Content-Type: application/json");
        echo json_encode(array(
            "status" => $status,
            "message" => $message
        ));
    }
    
}