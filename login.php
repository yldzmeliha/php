<?php
$page = "login";
require "bootstrap.php";
include "includes/header.php"
?>

<?php
$active_page = 'login';

if (request_is('post')) {

    $email = request('email');
    $password = request('password');

    if ($email === '') {
        $errors['email'] = 'Geben Sie bitte Ihre Email-Adresse ein.';
    }

    if ($password === '') {
        $errors['password'] = 'Bitte geben Sie Ihr Passwort ein.';
    }

    if (!$errors) {
        $user = db_raw_first(
            "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
        );

        if (!$user) {
            $errors['email'] = 'Ihre Anmeldeinformationen sind falsch!';
        }
    }

    if (!$errors) {
        if (!password_verify($password, $user['password'])) {
            $errors['email'] = 'Ihre Anmeldeinformationen sind falsch!';
        }
    }

    if (!$errors) {
        login($user);
        redirect(BASE_URL . 'admin.php');
    }
}

?>

<div id="wrap">
    <div class="flex">

        <!--formular anfang-->
        <article>
            <div class="formular">
                <fieldset>
                    <form action="<?= BASE_URL . 'login.php' ?>" method="post">
                        <div class="form-group">

                            <h3>Bei bestehendem Konto Anmelden </h3>
                            <?= error_for($errors, 'email') ?>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <?= error_for($errors, 'password') ?>
                            <label for="password">Passwort</label>
                            <input type="text" name="password" id="password" required>
                        </div>

                        <div class="form-group">
                            <button class="buttonfarbe" type="submit">Einloggen</button>
                        </div>
                    </form>

                    <div>
                        Du hast noch keine Konto ? <a href="<?= BASE_URL . 'register.php' ?>">Jetzt Registrieren</a>.
                    </div>

        </article>
    </div>


</div>


</fieldset>


<?php
include "includes/footer.php"
?>