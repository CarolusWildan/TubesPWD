<?php

// Panggil namespace PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Panggil Autoloader dari Composer (PENTING!)
require_once __DIR__ . '../../../vendor/autoload.php';

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
            $mail->Host       = 'sandbox.smtp.mailtrap.io'; //ganti sesuai host di mailtrap
            $mail->SMTPAuth   = true;
            
            // --- GANTI DENGAN EMAIL & APP PASSWORD KAMU ---
            $mail->Username   = '6074dc9b73bb1f'; //username credential
            $mail->Password   = 'a040f60d6028cd'; // Pakai APP PASSWORD, bukan password login biasa!
            // ----------------------------------------------
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // ===============================================
            // 2. PENGIRIM & PENERIMA
            // ===============================================
            $mail->setFrom('emailmu@gmail.com', 'GMS Library Admin'); // Ganti dengan emailmu
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