<?php
$page ="register";
require "bootstrap.php";
include "includes/header.php"
?>

<?php

$active_page = 'register';

if (request_is('post')) {

    $name = request('name');
    $email = request('email');
    $password = request('password');
    $password_confirmation = request('password_confirmation');

    if ($name === '') {
        $errors['name'] = 'Name darf nicht leer sein.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'bitte geben Sie eine gültige E-Mail Adresse an.';
    }

    if ($email === '') {
        $errors['email'] = 'E-Mail darf nicht leer sein.';
    }

    if ($password !== $password_confirmation) {
        $errors['password'] = 'Die Passwörter stimmen nicht überein.';
    }

    if (mb_strlen($password) < 6) {
        $errors['password'] = 'Das Passwort muss mindestens 6 Zeichen lang sein.';
    }

    if ($password === '') {
        $errors['password'] = 'Passwort darf nicht leer sein.';
    }

    if (!$errors) {
        $user = db_raw_first(
            "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
        );

        if ($user) {
            $errors['email'] = 'Diese E-Mail ist bereits in unserer Datenbank vorhanden.';
        }
    }

    if (!$errors) {
        db_insert('users', [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        redirect(BASE_URL.'login.php');
    }
}

?>

<div id="wrap8">
    <div class="flex">

<article>
<div class="formular">
<fieldset>
<form action="<?= BASE_URL.'register.php' ?>" method="post">
    <div class="form-group">
    <h3>Erstelle ein neues Konto</h3>
        <?= error_for($errors, 'name') ?>
        <label for="name">Name</label>
        <input type="text" name="name" id="name"  required>
    </div>

    <div class="form-group">
        <?= error_for($errors, 'email') ?>
        <label for="email">Email</label>
        <input type="text" name="email" id="email"  required>
    </div>

    <div class="form-group">
        <?= error_for($errors, 'password') ?>
        <label for="password">Passwort</label>
        <input type="text" name="password" id="password"  required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Passwort wiederholen</label>
        <input type="text" name="password_confirmation" id="password_confirmation"  required>
    </div>

    <div class="form-group">
        <button class="buttonfarbe" type="submit">Anmeldung</button>
    </div>
</form>

<div>
Du hast schon ein Konto. <a href="<?= BASE_URL.'login.php' ?>">Bei bestehendem Konto Anmelden</a>.
</div>
</article>

</div>

</div>

</fieldset>

<?php
include "includes/footer.php"
?>