<?php
$page = "kontakt";
require "bootstrap.php";
include "includes/header.php"
?>

<?php
// Datenbank

$database = mysqli_connect('localhost', 'root', '', 'yoga', 3306);
mysqli_set_charset($database, 'utf8mb4');

if (mysqli_connect_errno()) {
  trigger_error('DB ERORR:' . mysqli_connect_error(), E_USER_ERROR);
}

//------------------------------------------------------------
$errors = [];
$right = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $gender = ($_POST['gender']) ?? '';
  $vorname = ($_POST['vorname']) ?? '';
  $nachname = ($_POST['nachname']) ?? '';
  $ort = $_POST['ort'] ?? '';
  $subject = ($_POST['subject']) ?? '';
  $text = ($_POST['text']) ?? '';
  $check = ($_POST['check']) ?? '';


  if ($gender === '') {
    $errors['gender'] = 'PHP!!! Bitte geben Sie Ihren Geschlecht ein';
  }
  if ($vorname === '') {
    $errors['vorname'] = 'PHP!!! Bitte geben Sie Ihren  Ihre vorname ein';
  }
  if ($nachname === '') {
    $errors['nachname'] = 'Bitte geben Sie Ihren  Ihre Nachname ein';
  }

  if ($ort === '') {
    $errors['ort'] = 'Bitte wählen Sie ein Ort aus';
  }

  if ($subject === '') {
    $errors['subject'] = 'Bitte wählen Sie ihr Anliegen aus ';
  }
  if ($text === '') {
    $errors['text'] = 'Bitte Schreib mir was';
  }

  if ($check === '') {
    $errors['check'] = 'Bitte akzeptieren';
  }

  if (!$errors) {
    $right['right'] = 'Vielen Dank! ' .$vorname. '<br> Ihre Nachricht wurde in unser System eingetragen.';
    $sql = "INSERT INTO `kontakt`(`gender`, `vorname`,`nachname`,`ort`, `subject`,`text`,`check`) VALUES ('$gender', '$vorname', '$nachname','$ort', '$subject', '$text','$check')";

    mysqli_query($database, $sql);
  }
}

?>

<div id="wrap3">
  <div class="flex">

    <!--formular anfang-->
    <article>
      <div class="formular">
       <fieldset>
          <form action="#" method="post" >
            <div>
              <h3>Nehmen Sie Kontakt mit uns auf</h3>
              <label id="label11" class="labels required" >Geschlecht:</label>

              <label id="label1" for="male">Männlich
                <input type="radio" name="gender" id="male" value="männlich" required>
              </label>

              <label id="label2" for="female">Weiblich
                <input type="radio" name="gender" id="female" value="weiblich" required>
              </label>

              <label id="label3" for="x">Anderes
                <input type="radio" name="gender" id="x" value="x" required>
              </label>
              <?php if (isset($errors['gender'])) : ?>
                <div class="error"><?= $errors['gender'] ?></div>
              <?php endif; ?>
              <br><br>


              <label id="label4" >Vorname: </label>
              <input type="text" name="vorname" maxlength="19" id="user" required>
              <?php if (isset($errors['vorname'])) : ?>
                <div class="error"><?= $errors['vorname'] ?></div>
              <?php endif; ?>
              <br>
            </div>

            <div>
              <label id="label5" for="nachname">Nachname: </label>
              <input type="text" name="nachname" id="nachname" required>
              <?php if (isset($errors['nachname'])) : ?>
                <div class="error"><?= $errors['nachname'] ?></div>
              <?php endif; ?>
              <br>
            </div>
            <div>
              <label id="label6" for="ort">Ort: </label>
              <input type="text" name="ort" id="ort" required>
              <?php if (isset($errors['ort'])) : ?>
                <div class="error"><?= $errors['ort'] ?></div>
              <?php endif; ?>
              <br>
            </div>
            <div>

              <label id="label7" class="labels required" for="subject">Betreff</label>
              <select name="subject" id="subject" required>
                <option value="" disabled selected>--Bitte wählen--</option>
                <option value="Anfrage">Therapie Anfrage</option>
                <option value="Termin">Therapie Termin</option>
                <option value="Anliegen">Anderes Anliegen</option>
              </select>
              <?php if (isset($errors['subject'])) : ?>
                <div class="error"><?= $errors['subject'] ?></div>
              <?php endif; ?>
              <br>


            </div>
            <div>
              <p>Ihre Mitteilung</p>

              <textarea name="text" id="message" cols="40" rows="10" required></textarea>
              <?php if (isset($errors['text'])) : ?>
                <div class="error"><?= $errors['text'] ?></div>
              <?php endif; ?>
              <br>
            </div>
            <div>

              <label id="label8" for="check">Bitte bestätigen: </label>
              <input type="checkbox" name="check" id="check" value="AGB" required>
              <?php if (isset($errors['check'])) : ?>
                <div class="error"><?= $errors['check'] ?></div>
              <?php endif; ?>
              <br>
            </div>

            <div>
              <input class="buttonfarbe" type="submit" value="Absenden">
            </div>

            <?= right_for($right, 'right') ?>
          </form>
      </div>
      <!--formular ende-->
    </article>

  </div>
  
</div>
              </fieldset>



<?php
include "includes/footer.php"
?>