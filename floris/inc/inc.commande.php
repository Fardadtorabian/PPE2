<?php
    if (!empty($_POST['facturation']))
    {
        $id = $_POST['id_clients'];    
		$nom = $_POST['entreprises_nom'];
		$siret = $_POST['entreprises_siret'];
		$adresse = $_POST['entreprises_adresse'];
		$ville = $_POST['entreprises_ville'];
        $postal = $_POST['entreprises_postal'];
		$mail = $_POST['entreprises_mail'];
		$tel = $_POST['entreprises_tel'];
        $pays = $_POST['entreprises_pays'];
        $reglement = $_POST['commandes_reglements'];
        $facture = new panier();
        $res2 = $facture->CmdPanier($nom,$siret,$adresse,$ville,$postal,$mail,$tel,$pays,$reglement,$id);
    }
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
	$sesspanier = $panier->GetPanier();	
?>
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Résumé de votre commande</h2>
            <?php if(!empty($res)) { ?>
                <center><?php echo $res['value']; ?></center>
    <?php } ?>
    <?php if(!empty($res2)) { ?>
            <center><?php echo $res2['value']; ?></center>
            <?php if ($res2['type'] == 'success') 
            { 
                session_unset();
                die('<META HTTP-equiv="refresh" content=2;URL=index.php?p=home>');
                exit();
                
            }
            ?>                     
    <?php } ?>
        </div>
        <div class="table-responsive cart_info">
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
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Sous-total</td>
                                <td><?php echo $nombre_format_francais = number_format($panier->MontantHorsTaxes(), 2, ',', ' '); ?>&euro;</td>
                            </tr>
                            <tr>
                                <td>Exo Tax</td>
                                <?php $ecoTaxe = 2.00; ?>
                                <td><?php echo $nombre_format_francais = number_format($ecoTaxe, 2, ',', ' '); ?>€</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span><?php $superTotal = $panier->MontantHorsTaxes() + $ecoTaxe; echo $nombre_format_francais = number_format($superTotal, 2, ',', ' '); ?>€</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Client</p>
                        <p>Nom : <?php echo $_SESSION['clients_nom']; ?></p>
                        <p>Prénom : <?php echo $_SESSION['clients_prenom']; ?></p>
                        <p>Email : <?php echo $_SESSION['clients_mail']; ?></p>
                        <p>Téléphone : <?php echo $_SESSION['clients_tel']; ?></p>
                    </div>
                </div>
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Entreprise</p>
                        <div class="form-one">
                            <form method="post" action="./index.php?p=commande">
                                <input type="text" name="entreprises_nom" placeholder="Nom de l'entreprise">
                                <input type="text" name="entreprises_siret" placeholder="Numéro de Siret">
                                <input type="text" name="entreprises_adresse" placeholder="Adresse de l'entreprise">
                                <input type="text" name="entreprises_ville" placeholder="Ville de l'entreprise">
                                <input type="text" name="entreprises_postal" placeholder="Code postal de l'entreprise">
                                <select name="entreprises_pays">
                                    <option>-- Pays --</option>
                                    <option value="1">France</option>
                                    <option value="2">Angleterre</option>
                                    <option value="3">Espagne</option>
                                    <option value="4">Belgique</option>
                                    <option value="5">Allemage</option>
                                </select>
                                <br /><br />
                                <select name="commandes_reglements">
                                    <option>-- Réglement --</option>
                                    <option value="1">Carte bancaire</option>
                                    <option value="2">Versement</option>
                                    <option value="2">Chèque</option>
                                </select><br /><br />
                                <input type="email" name="entreprises_mail" placeholder="Email de l'entreprise">
                                <input type="text" name="entreprises_tel" placeholder="Téléphone de l'entreprise">
                                <input type="hidden" name="id_clients" value="<?php echo $_SESSION['clients_id']; ?>">    
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Ajouter une note sur la commande</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" name="facturation" value="Facturation">Envoyer la commande</button>
                    </form>
                </div>					
            </div>
        </div>

    </div>
</section> <!--/#cart_items-->