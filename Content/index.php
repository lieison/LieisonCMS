d<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

                $server_ = $_COOKIE["SERVER"];
                $folder_ = $_COOKIE["FOLDER"];
                require "/Conf/Include.php";
                $url = "Web/index.php";
                
                $install = new ApiInstall();
                
                $exists_db = $install->exist_database($CONFIG_["DB_MYSQL"]["database"]);
                if(!$exists_db):
                    $url = "Install/index.php";
                endif;
               
                $db_exist = $install->exists_datatable($CONFIG_["DB_MYSQL"]["prefix"]);
                if(!$db_exist):
                    
                endif;
                
              /*  $sesion = new Sessions();
                $sesion->StartSession();
                $sesion->CreateSession(array("nombre"=>"rolando" , "edad"=>"24"));
                $sesion->CreateSession(array("carro"=>"no" , "moto"=>"si"));
                $sesion->Get_sessionId();
                $sesion->DestroySession();*/
               // $sesion->DestroySession();
                
               // $header = new \Http\Header();
                //$header->redirect($url);
                
                
                /*$jason = new \SivarApi\Tools\Services_JSON();
                $arr = array("nombre"=>"roli");
                echo $jason->encode($arr);*/
                
                
               
               
              /*  $public = "6LcHKeMSAAAAAOT44ko9ABNagbFST3RAMrinllIg";
                $private = "6LcHKeMSAAAAAOAoANaejOfQyUw5UyTpGbaeB7YX";
                $captcha = new SivarApi\Tools\Captcha\BaseCaptcha\BaseCaptcha($public , $private);
                echo $captcha->CreateCaptcha();
               */
                
                //$curl_access = new SivarApi\Tools\Curl\Curl_class();
                
                //$oci = new db_oci8();

               
               
                
               // $paginacion = new BasePaginacion();
                
            
                
 
            
               
                
              /*  $traductor = new SivarApi\Tools\Translate\GoogleTranslate("en", "es");
                $traduccion = $traductor->translate("HELLO WORLD");
                echo "<br><br><br>" . $traduccion;
                //echo $traductor->makeCurl("http://laravel.com/");
               
               // echo $traductor->makeCurl("http://codehero.co/laravel-4-desde-cero-estructura-del-proyecto/");*/
                
// $mail = new PHPMailer;

//DOCUMENTACION http://phpmailer.github.io/PHPMailer/
//GITHUB https://github.com/Synchro/PHPMailer
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

/*$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'rolignu90@gmail.com';                 // SMTP username
$mail->Password = 'linux902014';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'rolignu90@gmail.com';
$mail->FromName = 'Rolando como estas';
$mail->addAddress('rolignu90@gmail.com', 'Rolando reportarse'); 
$mail->addReplyTo('rolignu90@gmail.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}*/
                
                /*$paginacion->SetPorPagina(1);
                $paginacion->SetPaginacionData($values);
                $value = $paginacion->GetPaginacion();
                $navegacion = $paginacion->Getnavegacion();
                print_r($value);
                
                echo $navegacion;*/
                
                
                
               /* $insertado = $conn->Insert("datos", 
                        array("Nombre"=>"ANDROID" ,
                            "Descripcion"=>"android es bueno" , 
                            "valor"=>1)
                        );
                if($insertado >= 1) {
                    echo "<br><br>SE HA INSERTADO UN NUEVO REGISTRO";
                }*/
                
               /* $query_ = $conn->Update("datos" , array(
                            "Nombre" => "LARAVEL",
                            "Descripcion"=> "ES UN FRAMEWORK",
                            "valor"=>2
                ) , "Id LIKE 8");
                
                echo $query_;*/
                
              //  $conn->Delete("datos", "Id=6");
                
        ?>
    </body>
</html>
