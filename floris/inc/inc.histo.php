
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <center><h1>Votre Historique de commande</h1></center>
        </div>
        <br />
        <div class="table-responsive cart_info">
            <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du produit</th>
                                    <th>Quantité</th>
                                    <th>Prix Unitaire</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php 
                                    if (!empty($_SESSION['clients_mail'])) { 
                                    $req = $sql->query("SELECT * FROM lignes WHERE id_commandes=$req");
                                    $req->setFetchMode(PDO::FETCH_ASSOC);
                                    $this->details = $req->fetchAll();
                                    return $this->details;
                    
                                    $infos->detailsHisto($result['commandes_id']);
                                    foreach($infos->details as $details) {
                                ?>
                                <tr>
                                    <td><?php echo $details['produits_id']; ?></td>
                                    <td><?php echo $details['lignes_nom'];?></td>
                                    <td><?php echo $details['lignes_quantite']?></td>
                                    <td><?php echo $details['lignes_prix']; ?></td>
                                    <td><?php $montant = (($details['lignes_prix'])*($details['lignes_quantite'])); echo $montant; ?>€</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
        </div>
    </div>
</section> <!--/#cart_items-->
