
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="./assets/images/home/logo.png" alt="" width="100px" height="100px" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <?php if (empty($_SESSION['clients_mail'])) { ?>
                <li><a href="./index.php?p=login"><i class="fa fa-user"></i>Inscription</a></li>
                <li><a href="./index.php?p=login"><i class="fa fa-user"></i>Se connecter</a></li>
                <li><a href="./index.php?p=panier"><i class="fa fa-shopping-cart"></i> Panier</a></li>
                <li><a href="./index.php?p=contact"><i class="fa fa-crosshairs"></i> Contact</a></li>
                <?php } else { ?>
                <li><a href="<?php if (!empty($_SESSION['clients_mail'])) { ?>index.php?p=panier <?php } else { ?>index.php?p=home<?php } ?>"><i class="fa fa-shopping-cart"></i>Votre panier</a></li>
                <li><a href="<?php if (!empty($_SESSION['clients_mail'])) { ?>index.php?p=histo <?php } else { ?>index.php?p=home<?php } ?>"><i class="fa fa-shopping-cart"></i>Votre Historique</a></li>

                <li><a href="index.php?p=catalogue"><i class="fa fa-lock"></i>Catalogue</a></li>
                <li><a href="./index.php?p=contact"><i class="fa fa-crosshairs"></i> Contact</a></li>            
                <li><a href="index.php?p=logout"><i class="fa fa-lock"></i>Déconnexion</a></li>
                            
                <?php } ?>	
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

</header><!--/header-->