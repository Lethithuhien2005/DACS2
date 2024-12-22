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
                $email->Body    = '<p>Dear, ' . $user->name . '</p>' . '<br>'.
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
        public function sendUpdatingAccount($user) {
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
                $email->Subject = 'Confirmation of Account Information Update';
                $email->Body    = '<p>Dear, ' . $user->name . '</p>' . '<br>'.
                                '<p>We have received your request to update your account information. Below is the updated account information for your reference:</p><br>'.
                                '<ul>'.
                                '<li><strong>Your name: </strong>' . $user->name . '</li>' .
                                '<li><strong>Account name: </strong>' . $user->account_name .  '</li>' .
                                '<li><strong>Date of birth: </strong>' . $user->date_of_birth .  '</li>' .
                                '<li><strong>Gender: </strong>' . $user->gender .  '</li>' .
                                '<li><strong>Address: </strong>' . $user->address .  '</li>' .
                                '<li><strong>Phone: </strong>' . $user->phone .  '</li>' .
                                '<li><strong>Email: </strong>' . $user->email .  '</li>' .
                                '</ul>' . 
                                '<p>Thank you for keeping your information up to date. If you have any questions or need assistance, feel free to reach out to us.</p><br>'.
                                '<p>Best regards,</p><br>' . 
                                '<p>Savory</p><br>';
        
                // Gửi email
                $email->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                \Log::error("Mail Error: " . $email->ErrorInfo);
            }
        }
        public function sendReservation($reservation, $user) {
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
                if ($reservation->email !== $user->email) {
                    $email->addAddress($user->email, $user->account_name); 
                    $email->addAddress($reservation->email, $reservation->name); 
                }
                else {
                    $email->addAddress($user->email, $user->account_name); 
                }
                // Content
                $email->isHTML(true);
                $email->Subject = ' Thank You for Your Reservation!';
                $email->Body    = '<p>Dear, ' . $user->name . '</p>' . '<br>'.
                                '<p>Thank you for choosing Savory for your upcoming visit. Here are the details of your reservation:' . '<br>'.
                                '<ul>'.
                                '<li><strong>Name: </strong>' . $reservation->name . '</li>' .
                                '<li><strong>Email: </strong>' . $reservation->email .  '</li>' .
                                '<li><strong>Phone: </strong>' . $reservation->phone .  '</li>' .
                                '<li><strong>Date: </strong>' . $reservation->res_date .  '</li>' .
                                '<li><strong>Time: </strong>' . $reservation->res_time .  '</li>' .
                                '<li><strong>Number of people: </strong>' . $reservation->number_of_people .  '</li>' .
                                '</ul>' . 
                                '<p>We’re excited to have the opportunity to serve you and ensure you have a wonderful dining experience.
                                If you have any special requests or need to make changes to your reservation, please don’t hesitate to contact us at ' . '<strong>0123456789 </strong>' . '<p> or '. '<strong> lethithuhien2582005@gmail.com </p></strong>' . 
                                '<p>We look forward to serving you and hope you have a wonderful dining experience with us.</p><br>' . 
                                '<p>Best regards,</p><br>' . 
                                '<p>Savory</p><br>';
        
                // Gửi email
                $email->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                \Log::error("Mail Error: " . $email->ErrorInfo);
            }
        }
        public function sendUpdatingReservation($reservation, $user) {
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
                if ($reservation->email !== $user->email) {
                    $email->addAddress($user->email, $user->account_name); 
                    $email->addAddress($reservation->email, $reservation->name); 
                }
                else {
                    $email->addAddress($user->email, $user->account_name); 
                }
                // Content
                $email->isHTML(true);
                $email->Subject = 'Reservation Details Update Notification';
                $email->Body    = '<p>Dear, ' . $user->name . '</p>' . '<br>'.
                                '<p>We would like to inform you that your reservation details have been successfully updated. Below are the most recent details of your reservation:' . '<br>'.
                                '<ul>'.
                                '<li><strong>Name: </strong>' . $reservation->name . '</li>' .
                                '<li><strong>Email: </strong>' . $reservation->email .  '</li>' .
                                '<li><strong>Phone: </strong>' . $reservation->phone .  '</li>' .
                                '<li><strong>Date: </strong>' . $reservation->res_date .  '</li>' .
                                '<li><strong>Time: </strong>' . $reservation->res_time .  '</li>' .
                                '<li><strong>Number of people: </strong>' . $reservation->number_of_people .  '</li>' .
                                '</ul>' . 
                                '<p>If the information above is correct, no further action is required. However, if there are any additional changes or special requests, please do not hesitate to contact us at ' . '<strong>0123456789 </strong>' . '<p> or '. '<strong> lethithuhien2582005@gmail.com </p></strong>' . 
                                '<p>We look forward to serving you and hope you have a wonderful dining experience with us.</p><br>' . 
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
