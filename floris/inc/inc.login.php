<?php
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
		$mail = $_POST['clients_mail'];
		$pass = $_POST['clients_password'];
		$login = new Login();
		$res = $login->Connexion($mail,$pass);
	}
elseif (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
		$mail = $_POST['clients_mail'];
		$password = $_POST['clients_password'];
		$passconf = $_POST['clients_passconf'];
        $nom = $_POST['clients_nom'];
		$prenom = $_POST['clients_prenom'];
		$tel = $_POST['clients_tel'];
		$add = new Login();
		$res = $add->addMembres($mail,$password,$passconf,$nom,$prenom,$tel);
	}
?>	

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <center>
                <?php if(!empty($res)) { 
                    echo $res['value'];
                    if ($res['type'] == 'success') 
                    { 
                        die('<META HTTP-equiv="refresh" content=3;URL=index.php?p=home>');
                        exit();
                    }
                 } ?>
            </center>    
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Déja client, je me connecte : </h2>
                    <form action='./index.php?p=login' method="POST">
                        <input type="email" placeholder="Email" name="clients_mail" value="<?php if (isset($_POST['clients_mail'])) echo htmlentities(trim($_POST['clients_mail'])); ?>" />
                        <input type="password" placeholder="Mot de passe" name="clients_password" value="<?php if (isset($_POST['clients_password'])) echo htmlentities(trim($_POST['clients_password'])); ?>"/>
                        <button type="submit" name="connexion" value ="Connexion" class="btn btn-default">Se connecter</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">ou</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Pas encore de compte ?</h2>
                    <form action="./index.php?p=login" method="POST">
                        <input type="email" placeholder="Votre Email" name="clients_mail" value="<?php if (isset($_POST['clients_mail'])) echo htmlentities(trim($_POST['clients_mail'])); ?>"/>
                        <input type="password" placeholder="Votre password" name="clients_password" value="<?php if (isset($_POST['clients_password'])) echo htmlentities(trim($_POST['clients_password'])); ?>"/>
                        <input type="password" placeholder="Confirmer mot de passe" name="clients_passconf" value="<?php if (isset($_POST['clients_passconf'])) echo htmlentities(trim($_POST['clients_passconf'])); ?>"/>
                        <input type="text" placeholder="Votre nom" name="clients_nom" value="<?php if (isset($_POST['clients_nom'])) echo htmlentities(trim($_POST['clients_nom'])); ?>"/>
                        <input type="text" placeholder="Votre prénom" name="clients_prenom" value="<?php if (isset($_POST['clients_prenom'])) echo htmlentities(trim($_POST['clients_prenom'])); ?>"/>
                        <input type="text" placeholder="Votre numéro de téléphone" name="clients_tel" value="<?php if (isset($_POST['clients_tel'])) echo htmlentities(trim($_POST['clients_tel'])); ?>"/>
                        <button type="submit" name="inscription" value ="Inscription" class="btn btn-default">Inscription</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->