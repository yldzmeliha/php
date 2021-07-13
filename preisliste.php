<?php
$page = "preisliste";
require "bootstrap.php";
include "includes/header.php";
?>
<?php 
    // initialize errors variable
	$errors = [];
	$right = [];

	// connect to database
	$db = mysqli_connect("localhost", "root", "", "yoga");

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

			<div id="wrap4">
			<div> 
				<h1>
					<b>Preisliste für unsere Therapie</b>
				</h1>
			   Schön, dass du da bist!<br> Wähle den Therapie, der am besten zu dir passt.  
			</div>



  <!-- Ausgabe der Liste -->
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

<div id="wrap5">
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

</div>



<?php
include "includes/footer.php"
?>