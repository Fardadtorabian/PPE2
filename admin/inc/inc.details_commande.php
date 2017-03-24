<?php
    $id  = $_GET["id"] ;
    $infos = new commandes();
    $infos->allInfosCommandesDetails($id);
    foreach($infos->commandes as $result)
    {  
?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Détails de la commande N° # : <?php echo $result['commandes_id']; ?></h1>
                <h4>Transporteur pour cette commande : <?php echo $result['transporteurs_nom']; ?> <?php echo $result['transporteurs_prenom']; ?></h4>
                <h4>Livraison prévu le : <?php echo $result['livraisons_date']; ?></h4>
            </div>
            <!-- /.col-lg-12 -->
        
        <!-- end invoice header -->

        <div class="col-lg-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                   FROM
                </div>
                <div class="panel-body">
                    <h4>FLORIS CARVIN</h4>
                    Parc d'activités Gare d'Eau<br />
                    ZI du Château<br />
                    Rue Louis Joseph Gay-Lussac<br />
                    BP 90105<br />
                    62211 Carvin Cédex<br />
                    <p><span>Email:</span>secretariat.carvin@agoragroup.com</p>
                    <p><span>Phone:</span>+33 3 21 08 57 67</p>
                    <p><span>Fax:</span>+33 3 21 08 57 75</p>
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    To
                </div>
                <div class="panel-body">
                    <h4><?php echo $result['entreprises_nom']; ?></h4>

                    <?php echo $result['entreprises_adresse']; ?>
                    <br /><?php echo $result['entreprises_postal']; ?> <?php echo $result['entreprises_ville']; ?>
                    <br />

                    <p><span>Email:</span> <?php echo $result['entreprises_mail']; ?></p>
                    <p><span>Phone:</span> <?php echo $result['entreprises_tel']; ?></p>
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->                   
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Résumé de la commande
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
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
                                    $infos->detailsCommandes($result['commandes_id']);
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
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->  
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Facture de la commande
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            <?php 
                                $montantTotal = new commandes();
                                $totalCommande = $montantTotal->montantTotal($result['commandes_id']);
                            ?>
                            <tr>
                                <td>H.T</td>
                                <td><?php echo $totalCommande['prix_total']; ?>€</td>
                            </tr>
                            <tr>
                                <td>Eco-Taxe</td>
                                <?php $eco = (int) 2; ?>
                                <td><?php echo $eco; ?>€</td>
                            </tr>
                             <tr>
                                <td>TTC</td>
                                <td><?php $totalTTC = $eco+$totalCommande['prix_total']; echo $totalTTC; ?>€</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- end invoice footer -->
<?php } ?>