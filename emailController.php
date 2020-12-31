<?php
include(ROOT_PATH . '/application/constants.php');
require_once(ROOT_PATH . '/vendor/autoload.php');

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



function sendVerificationMail($email, $token){

    global $mailer;

    //Declare body
    $body = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Verify Email</title>
                </head>
                <body>
                    <div class= "wrapper">
                        <p>
                            Thank you for signing up on Rastot Insight.<br/>
                            Please click on the link below to verify your email.
                        </p>

                        <a href="http://localhost/rastotInsight/public/login.php?token=' . $token .' ">Verify Email</a>
                    </div>
                </body>
                </html>';
    // Create a message
    $message = (new Swift_Message('Verify your email address!'))
    ->setFrom(EMAIL)
    ->setTo($email)
    ->setBody($body, 'text/html')
    ;

    // Send the message
    $result = $mailer->send($message);
}

function sendPasswordResetLink($email, $token){

    global $mailer;

    //Declare body
    $body = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Reset Password</title>
                </head>
                <body>
                    <div class= "wrapper">
                        <p>
                            Please click the link below.<br/>
                            to redirect to our password reset system.
                        </p>

                        <a href="http://localhost/rastotInsight/public/login.php?pass_token=' . $token .' ">Reset Password</a>
                    </div>
                </body>
                </html>';
    // Create a message
    $message = (new Swift_Message('Reset your password!'))
    ->setFrom(EMAIL)
    ->setTo($email)
    ->setBody($body, 'text/html')
    ;

    // Send the message
    $result = $mailer->send($message);
}

function sendFooterMSg($email, $msg){

    global $mailer;
    $text = html_entity_decode($msg);
    $sendMail = "help@rastot.com";
    //Declare body
    $body = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Footer Query</title>
                </head>
                <body>
                    <div class= "wrapper">
                        <p>
                            Dear Admin,
                        </p>

                        <div>
                        <p>' . $text . '</p> 
                        </div>

                        <p> Sincerely</p>' . $email . '</p>
                    </div>
                </body>
                </html>';
    // Create a message
    $message = (new Swift_Message('New Insight Cutomer Query!'))
    ->setFrom($email)
    ->setTo($sendMail)
    ->setBody($body, 'text/html')
    ;

    // Send the message
    $result = $mailer->send($message);
}
?>