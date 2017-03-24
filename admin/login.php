<?php
    session_start();
    // Si user déjà logué
    if (!empty($_SESSION['operateurs_pseudo']))
    {
        die('<META HTTP-equiv="refresh" content=0;URL=./index.php>');
        exit();
    }
    require('./class/class.mysql.php');
    require('./class/class.login.php');
    if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') 
    {
		$pseudo = $_POST['operateurs_pseudo'];
		$pass = $_POST['operateurs_password'];
		$login = new Login();
		$res = $login->Connexion($pseudo,$pass);
	}
?>
<?php require('./inc/req.header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <center><h3 class="panel-title">Connexion au Back Office</h3></center>
                    <?php if(!empty($res)) { ?>
					   <div class="alert alert-error cntr"><?php echo $res ?></div>
				    <?php } ?>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="./login.php">
                        <fieldset>
                            <div class="form-group">
                                <input type="text" placeholder="pseudo" name="operateurs_pseudo" class="form-control" value="<?php if (isset($_POST['operateurs_pseudo'])) echo htmlentities(trim($_POST['operateurs_pseudo'])); ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Mot de passe" name="operateurs_password" class="form-control" value="<?php if (isset($_POST['operateurs_password'])) echo htmlentities(trim($_POST['operateurs_password'])); ?>">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" name="connexion" value="Connexion" class="btn btn-lg btn-success btn-block">Connexion</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
