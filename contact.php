<?php

$file = 'emails.txt';

$name = $email = $subject = $message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Neplatný formát emailu';
        exit;
    }
    $entry = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message\n---\n";
    $file_handle = fopen($file, 'a');

    if ($file_handle) {
        fwrite($file_handle, $entry);
        fclose($file_handle);
        echo 'Vaše zpráva byla odeslána!';
    } else {
        echo 'Zprávu nelze odeslat.';
    }
} else {
    echo 'Neplatná metoda požadavku.';
}

