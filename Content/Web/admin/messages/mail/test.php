<?php

include   '../../../../Conf/Include.php';

$mail = new PHPMailer(true);

$to = "rmarroquin@lieison.com";
$msj = "this is a test ... please no reply";

echo "1 DATA---> \n";

try{
    
    
$mail->IsSMTP();
/*$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "tls"; //"tls";
$mail->SMTPAuth = true;
$mail->Port = 465 ;
$mail->Username = 'rolignu90@gmail.com';
$mail->Password = 'linux902014';*/



$mail->SetFrom('rolignu90@gmail.com');
$mail->addAddress($to, 'Roli');


$mail->Subject = 'Fisrt Test';
$mail->Body    = $msj;



echo "2 DATA---> \n<br><br>";

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
} catch (phpmailerException $ex){
     echo "ERRO : ->" . $ex->getMessage();
}
