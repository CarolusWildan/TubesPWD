<?php

// Panggil namespace PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Panggil Autoloader dari Composer (PENTING!)
require_once __DIR__ . '../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

class Mailer {
    
    public static function sendEmail($to, $subject, $message) {
        // Buat instance PHPMailer baru
        $mail = new PHPMailer(true);

        try {
            // ===============================================
            // 1. SETTING SERVER GMAIL (SMTP)
            // ===============================================
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Nyalakan ini kalau mau lihat log error detail
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth   = true;
            
            $mail->Username   = $_ENV['MAIL_USERNAME'];
            $mail->Password   = $_ENV['MAIL_PASSWORD'];
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // ===============================================
            // 2. PENGIRIM & PENERIMA
            // ===============================================
            $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($to); // Email tujuan (User)

            // ===============================================
            // 3. ISI KONTEN
            // ===============================================
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = strip_tags($message); // Versi teks polos

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Jika gagal, bisa cek errornya disini: $mail->ErrorInfo
            return false;
        }
    }
}