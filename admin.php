<?php
$page = "admin";
require "bootstrap.php";
include "includes/header.php";
?>
<?php 
    // initialize errors variable
	$errors = [];
	$right = [];

	// connect to database
	$db = mysqli_connect("92.205.00.000", "meliha", "asdf", "yoga");

	$kurs = request('kurs');
	$kurs2 = request('kurs2');
	$therapie_name = request('therapie_name');
	$preis = request('preis');
	$preis2 = request('preis2'); 
	$action=request('action');
	
	
	
	
	if (request_is('post')) {
		if($action ==='speichern'){
				if($kurs === ''){
						$errors['kurs']='Geben Sie bitte einen Kursnamen an.';
				} 
	
				$preis=(float)str_replace(',', '.', $preis);
				if(!is_numeric($preis)){
						$errors['preis']='Eingabefeld muss eine Zahl sein.';
				}
				if($preis === ''){
						$errors['preis']='Geben Sie bitte den Betrag ein.';
				}
			 
			
				if(!is_float($preis)){
					$errors['preis']='Bitte geben Sie eine Kommazahl ein.';
				}
				if(!$errors){
						$right['right']= "<p style='color:green'> Ihre neue Daten wurden abgespeichert!</p>";
				}
				if(!$errors){
					db_insert('preisliste',[
						'user_id'=>auth_id(),
						'therapie_name'=>$kurs,
						'preis'=>$preis
				]);
				}
		}  
	}
	$temps=db_raw_select('SELECT * FROM preisliste  ORDER BY therapie_name');
	$temps2=db_raw_select('SELECT * FROM preisliste WHERE therapie_name = "'.$therapie_name.' " ');
	$preis = isset($temps2[0]['preis'])?$temps2[0]['preis']: '';
	// var_dump($temps2[0]['id']);
	
	//löschen//
	if($action==='löschen') {
		$sql='DELETE FROM preisliste WHERE id ='.$temps2[0]['id'];
	$shoot=  mysqli_query($db, $sql);
	}
	

	// var_dump($preis2);
	// var_dump($kurs2);
	// var_dump($temps2[0]['id']);
	
//preis ändern//	
if($action ==='ändern'){
			if($kurs2===''){
					$errors['errors2']= 'Bitte geben Sie den neuen Preis ein.';
			}

		 $preis2=(float)str_replace(',', '.', $preis2);
	
				if(!is_numeric($preis2)){
						$errors['preis2']='Eingabefeld muss eine Zahl sein.';
				}
				if($preis2 === ''){
						$errors['preis2']='Geben Sie bitte den Betrag ein.';
				}
			 
			
				if(!is_float($preis2)){
					$errors['preis2']='Bitte geben Sie eine Kommazahl ein.';
				}
	
			if(!$errors){
				$id= $temps2[0]['id'];
				$kurs2 = mysqli_escape_string($db, $kurs2);
				$preis2 = mysqli_escape_string($db, $preis2);
				// var_dump($temps2[0]['id']);
							$right['right2']='Vielen Dank! Ihre Daten wurden geändert!';
						
								// $sql='UPDATE  preisliste set preis = "'.$preis2.'
								//  WHERE id = '.$temps2[0]['id'];
								$sql = "UPDATE  `preisliste` SET  `preis` = '$preis2',`therapie_name`= '$kurs2'
								 WHERE `id`= $id ";
	


								// $sql = "UPDATE  `preisliste` SET  `therapie_name` = '$kurs2',`preis`= '$preis2', 
								//              WHERE `id`= .$temps2[0]['id']";

						


								$shoot= mysqli_query($db,$sql);
											
					 }
			}
		
	
			// aus der DB auslesen
			$sql =  "SELECT * FROM preisliste ";
			$infos = db_raw_select ($sql);

			$sql1 =  "SELECT * FROM kontakt ";
			$infos1 = db_raw_select ($sql1);
	
	
	?>

			<div id="wrap6">
			<div> 
				<h1>
					<b>Preisliste für unsere Therapie</b>
				</h1>
			   Schön, dass du da bist!<br> Wähle den Therapie, der am besten zu dir passt.  
			</div>
	<!-- sichtbar  für authuser -->

		<?php if(auth_user()): ?>

			<form class="f_p_l_t" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <!-- neue einträge speichern -->
      <div class="formular">
        <h3>Neuen Eintrag erstellen:</h3>

        <?= error_for($errors, 'kurs') ?>

        <label class="label" for="kurs">Bitte geben Sie einen Kurs ein.</label>
        <input class="input" type="text" name="kurs" id="kurs">
      </div>

      <div class="formular">
        <?= error_for($errors, 'preis') ?>
        <label class="label" for="preis">Bitte geben Sie den Preis für den Kurs ein.</label>
        <input type="text" name="preis" id="preis" class="input">
      </div>

      <button class="btn" value="speichern" name="action" type="submit">Speichern</button>
      <?= right_for($right, 'right') ?>
  </form>
      <!-- bearbeiten -->
      <div class="">
        <form action="admin.php" method="post">
        <h3 class="h3_b">Bearbeiten:</h3>
        <span class="span">Wählen Sie eine Therapie die Sie bearbeiten möchten:</span><br><br>


        <select name="therapie_name" id="therapie_name">
          <option value="" selected disabled>--bitte auswählen--</option>
          <?php foreach ($temps as $temp) : ?>
            <option value="<?= e($temp['therapie_name']) ?>"><?= e($temp['therapie_name']) ?></option>
          <?php endforeach; ?>
        </select>

        <input type="submit" name="action" value="bearbeiten"></input>
         <?= right_for($right, 'right2') ?>
        </form>

        <!-- therapiename ändern -->

        <form action="admin.php" method="post"><br>
        <div>
          <span class="span">Wählen Sie die Therapie aus die Sie bearbeiten möchten:</span>
          <div>

            <div ><?= $therapie_name ?></div>
            <?= error_for($errors, 'errors2') ?><br>
            <input type="text" name="kurs2" id="input1" placeholder="Ändern Sie den Therapie" value="<?= $therapie_name ?>">
            <?= error_for($errors, 'errors2') ?>

            <!-- preis ändern -->
            <input type="text" name="preis2" id="input2" placeholder="neuer Preis" value="<?= $preis ?>">
            <?= error_for($errors, 'preis2') ?>
            <input type="hidden" name="therapie_name" value="<?= $therapie_name ?>">

            <div>
        

              <input type="submit" name="action" value="ändern" class="b">

              <input type="submit" name="action" value="löschen" class="b">
            </div>
          </div>
        </div>
      </div>
    </form>
    <?= right_for($right, 'right2') ?>




    <?php endif; ?> 


  <!-- Ausgabe der Liste -->

  <p> User Nachrichten ! </p>
    <table>
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
						<th>Geschlecht</th>
            <th>Ort</th>
						<th>Subject</th>
            <th>Nachricht</th>
        </tr>
      <?php foreach($infos1 as $info):?>
      <tr>
        <td><?=$info['vorname'];?></td>
        <td><?=$info['nachname'];?></td>
				<td><?=$info['gender'];?></td>
        <td><?=$info['ort'];?></td>
				<td><?=$info['subject'];?></td>
        <td><?=$info['text'];?></td>


      </tr>
      <?php endforeach;?>
</table>

<table>
        <tr>
            <th>Kursname</th>
            <th>Preis in Euro</th>
        </tr>
      <?php foreach($infos as $info):?>
      <tr>
        <td><?=$info['therapie_name'];?></td>
        <td><?=$info['preis'];?></td>
      </tr>
      <?php endforeach;?>
</table>

</div>

<div class="anmeldebutton">
<?php if(!auth_id()!= null) : ?> 

	<button class="buttonfarbe"  onclick="window.location.href='login.php'">Einloggen</button>

<?php endif;?>

<?php if(auth_id()!= null) : ?>
<button class="buttonfarbe"  onclick="window.location.href='logout.php'">Ausloggen</button>

<?php endif;?>
</div>
</div>
</div>

</div>



<?php
include "includes/footer.php"
?>