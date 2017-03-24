<?php
    $id = $_GET['id'];
    $details = new produits();
    $details->getDetailsProduits($id);

    function stock($count){
		if ($count!=0) 
        {
			$stock = '<strong>'.$count."</strong> en stock";
        }
		else 
        {
			$stock = "Rupture de stock";
        }
		return $stock;
	}

    if(!empty($_POST['submit'])) 
    {
        if ($_POST['submit']=='Add') 
        {  
            $nom = $_POST['produits_nom'];
            $ref = $_POST['produits_id'];
            $prix = $_POST['produits_prix'];
            $qte = $_POST['qte'];
            $panier = new panier();
            $addpanier = $panier->AddProduit($ref,$nom,$qte,$prix);
        }
    }
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Categories</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Choisir
                                    </a>
                                </h4>
                            </div>
                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="./index.php?p=catalogue&t=4">Tous </a></li>
                                        <li><a href="./index.php?p=catalogue&t=2">Nos plantes </a></li>
                                        <li><a href="./index.php?p=catalogue&t=1">Nos fleurs </a></li>
                                        <li><a href="./index.php?p=catalogue&t=3">Nos accessoires</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--/category-products-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <?php if(!empty($addpanier)) { ?>
                    <center><?php echo $addpanier['value']; ?></center>
                <?php } ?>
                <?php foreach($details->produits as $result) { ?>
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="./assets/images/produits/<?php echo $result['produits_id']; ?>.jpg" alt="" />
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <h2><?php echo utf8_encode($result['produits_nom']); ?></h2>
                            <p>Catégorie : <?php echo $result['types_nom']; ?></p>
                            <span>
                                <?php $newPrice = ($result['produits_prix']-((($result['produits_prix']*$result['promos_taux'])/100))); ?>
                                <p><span>Prix <?php if ($result['id_promos'] == 1) { ?> <span style="text-decoration:line-through; color:red"><?php echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); ?>€</span> / <?php echo $nombre_format_francais = number_format($newPrice, 2, ',', ' '); ?><?php } else { echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); } ?>&euro;</span></p>
									<label>Quantité:</label>
                                <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST"> 
                                    <input type="number" step="1" min="0" max="<?php echo $result['produits_conditionnement']?>" name="qte" id="qte" placeholder="1">
                                    <input type="hidden" name="produits_nom" id="produits_nom" value="<?php echo $result['produits_nom']?>" />
                                    <input type="hidden" name="produits_id" id="produits_id" value="<?php echo $result['produits_id']?>" />
                                    <input type="hidden" name="produits_prix" id="produits_prix" value="<?php echo $result['produits_prix']?>" />
                                    <button type="submit" class="btn btn-fefault cart" name="submit" id="submit" value="Add" <?php if ($result['produits_conditionnement'] < 10) { ?>disabled="disabled"<?php } ?>><i class="fa fa-shopping-cart"></i>Ajouter au panier</button>
                                </form> 
                            <p><b>Disponibilité :</b> <?php if ($result['produits_conditionnement'] < 10) { echo 'Rupture de stock'; } else { echo 'En stock'; } ?></p>
                            <p><b>Statut : </b><?php if ($result['id_promos'] != 3) { echo 'en solde'; } else { echo 'non soldé'; } ?></p>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">Description</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                <p><?php echo utf8_encode($result['produits_description']); ?></p>
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
                    <?php } ?>
            </div>
        </div>
    </div>
</section>