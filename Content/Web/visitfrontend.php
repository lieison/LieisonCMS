<?php

include   '../Conf/Include.php';
$front = new FrontEndController();

$result = $front->InsertVisit(FunctionsController::get_month(), FunctionsController::get_year());
echo FunctionsController::get_month();

if($result):
    echo true;
else:
    echo false;
endif;


