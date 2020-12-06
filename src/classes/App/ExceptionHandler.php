<?php
namespace dhope0000\SnapMosaic\App;

class ExceptionHandler
{
    public function register()
    {
        set_exception_handler([$this, "handle"]);
    }

    public function handle($exception)
    {
        $message = $exception->getMessage();

        echo json_encode([
            "state"=>"error",
            "message"=>$message . " " . $exception->getFile() . " " . $exception->getLine()
        ]);
    }
}
