<?php
    $panier = new panier();
	if(!empty($_POST['submit'])) 
    {
		if($_POST['submit']=="delete") 
        {
			$id = $_POST['produits_id'];
			$res = $panier->DelProduit($id);
        }
		if($_POST['submit']=="edit") 
        {
			$id = $_POST['produits_id'];
			$qte = $_POST['qte'];
			$res = $panier->SetProduit($id,$qte);
        }
    }
	$count = $panier->CountPanier();
    if($count>0){
	   $sesspanier = $panier->GetPanier();
    }
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <center><h1>VOTRE PANIER</h1></center>
        </div>
        <br />
        <div class="table-responsive cart_info">
            <?php if(!empty($res)) { ?>
                <center><?php echo $res['value']; ?></center>
            <?php } ?>
            <?php if ($count==0) { ?>
                <center><p>Votre panier est actuellement vide.</p></center>
            <?php } else { ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Nom du produit</td>
                        <td class="price">Prix</td>
                        <td class="quantity">Quantité</td>
                        <td class="total">Total</td>
                        <td>Modifier</td>
                        <td>Supprimer</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($sesspanier as $array) { 
                            $produit = new produits();
                            $prd = $produit->getproduit($array['id'])[0];
                    ?>
                    <tr>
                        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
                            <input type="hidden" name="produits_id" id="produits_id" value="<?php echo $prd['produits_id']; ?>">
                            <td class="cart_product"><a href="./index.php?p=details&id=<?php echo $prd['produits_id']; ?>"><img alt="" src="./assets/images/produits/<?php echo $prd['produits_id'];?>.jpg" height="50px" width="50px"></a></td>
                            <td class="cart_description"><?php echo utf8_encode($prd['produits_nom'])?></td>
                            <td class="cart_price"><?php echo $nombre_format_francais = number_format($prd['produits_prix'], 2, ',', ' '); ?>€</td>
                            <td class="cart_quantity"><input type="number" min="0" max="<?php echo $prd['produits_conditionnement']?>" class="form-control" name="qte" id="qte" value="<?php echo $array['qte'] ?>"></td>
                            <td class="cart_total"><?php echo $nombre_format_francais = number_format($array['qte']*$prd['produits_prix'], 2, ',', ' '); ?>€</td>
                            <td>
                                <button type="submit" name="submit" id="submit" value="edit" class="cart_quantity_delete">Modifier</button>
                            </td>    
                            <td>
                                <button type="submit" name="submit" id="submit" value="delete">Supprimer</button>
                            </td>
                        </form>
<!--
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
-->
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Sous-total <span><?php echo $nombre_format_francais = number_format($panier->MontantHorsTaxes(), 2, ',', ' '); ?>&euro;</span></li>
                        <?php $ecoTaxe = 2.00; ?>
                        <li>Eco Tax <span><?php echo $nombre_format_francais = number_format($ecoTaxe, 2, ',', ' '); ?>€</span></li>
                        <li>Total <span><?php $superTotal = $panier->MontantHorsTaxes() + $ecoTaxe; echo $nombre_format_francais = number_format($superTotal, 2, ',', ' '); ?>€</span></li>
                    </ul>
                        <a class="btn btn-default update" href="index.php?p=catalogue&t=4">Continuer vos achats</a>
                        <a class="btn btn-default check_out" href="index.php?p=commande">Commander</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<?php } ?>