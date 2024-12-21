<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class MailHandler extends Controller{
        public function notifyRegister($user) {
            $email = new PHPMailer(true);
            try {
                // Server settings
                $email->isSMTP();
                $email->Host = 'smtp.gmail.com';  // Server SMTP của bạn
                $email->SMTPAuth = true;
                $email->Username = 'lethithuhien9a1920@gmail.com';    // Tài khoản email của bạn
                $email->Password = 'bmuk kwwu bggt wvzc';       // Mật khẩu email của bạn
                $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $email->Port = 587;
        
                //Recipients
                $email->setFrom('lethithuhien9a1920@gmail.com', 'Savory Restaurant');
                $email->addAddress($user->email, $user->account_name);     // Gửi email đến người dùng mới
        
                // Content
                $email->isHTML(true);
                $email->Subject = 'Welcome to Our Savory Restaurant';
                $email->Body    = '<p>Dear, </p>' . $user->name . '<br>'.
                                '<p>Congratulations! Your account has been successfully registered on our <strong>Savory Restaurant Website</strong></p><br>'.
                                '<p>Your account details:</p>'. 
                                '<ul>'.
                                '<li><strong>Your name: </strong>' . $user->name . '</li>' .
                                '<li><strong>Account name: </strong>' . $user->account_name .  '</li>' .
                                '</ul>' . 
                                '<p>We are excited to welcome you to our restaurant. You can now enjoy all the features and services we offer.</p><br>'.
                                '<p>If you encounter any issues while using your account, please don\'t hesitate to contact us</p><br>' . 
                                '<p>We hope you have a wonderful experience!</p><br>' . 
                                '<p>Best regards,</p><br>' . 
                                '<p>Savory</p><br>';
        
                // Gửi email
                $email->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                \Log::error("Mail Error: " . $email->ErrorInfo);
            }
        }
    }
