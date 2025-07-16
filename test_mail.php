<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Grant\AuthorizationCode;
use PHPMailer\PHPMailer\OAuth;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Set up Google OAuth 2.0
    $provider = new Google([
        'clientId'     => 'YOUR_CLIENT_ID',
        'clientSecret' => 'YOUR_CLIENT_SECRET',
        'redirectUri'  => 'http://localhost/oauth2callback',
    ]);

    // Get authorization code
    if (!isset($_GET['code'])) {
        $authUrl = $provider->getAuthorizationUrl(['scope' => 'https://mail.google.com/']);
        header('Location: ' . $authUrl);
        exit;
    } else {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    }

    // Set up PHPMailer
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->AuthType   = 'XOAUTH2';
    $mail->setOAuth(
        new OAuth([
            'provider' => $provider,
            'clientId' => 'YOUR_CLIENT_ID',
            'clientSecret' => 'YOUR_CLIENT_SECRET',
            'refreshToken' => $token->getRefreshToken(),
            'userName' => 'YOUR_EMAIL@gmail.com',
        ])
    );

    // Recipients
    $mail->setFrom('YOUR_EMAIL@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email Subject';
    $mail->Body    = 'This is a test email body <b>in bold!</b>';
    $mail->AltBody = 'This is the plain text version of the email content';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>