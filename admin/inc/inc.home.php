<?php
    if (isset($_POST['modifier']) && $_POST['modifier'] == 'Modifier')
    {
        $statuts = $_POST['id_statuts']; 
        $id = $_POST['commandes_id'];
        $date = $_POST['commandes_modif'];
        $modification = new commandes();
        $res2 = $modification->updateCommandes($id, $statuts, $date);
    }
?>

<?php 
    if (isset($_POST['livreur']) && $_POST['livreur'] == 'Livreur')
    {
        $id = $_POST['commandes_id'];
        $livraison_date = $_POST['livraisons_date'];
        $transporteur = $_POST['id_transporteurs'];
        $update = new commandes();
        $res = $update->addLivraison($id, $livraison_date, $transporteur);
    }
?>
<div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Accueil</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php   
                                        $client = new clients();
                                        $nbClient = $client->countClients();
                                    ?>
                                    <div class="huge"><?php echo $nbClient[0]; ?></div>
                                    <div>Clients inscrits</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php   
                                        $produit = new produits();
                                        $nbProduit = $produit->countProduits();
                                    ?>
                                    <div class="huge"><?php echo $nbProduit[0]; ?></div>
                                    <div>Produits différents</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php   
                                        $attente = new commandes();
                                        $nbAttente = $attente->countAttente();
                                    ?>
                                    <div class="huge"><?php echo $nbAttente[0]; ?></div>
                                    <div>Cmds en cours</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php   
                                        $transporteur = new transporteurs();
                                        $nbTransporteurs = $transporteur->countTransporteurs();
                                    ?>
                                    <div class="huge"><?php echo $nbTransporteurs[0]; ?></div>
                                    <div>Transporteurs</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Commandes Floris <?php if(!empty($res2)) { ?>(<?php echo $res2['value']; ?>)<?php } ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Cmd n°</th>
                                            <th>Règlement</th>
                                            <th>Ajouter le</th>
                                            <th>Modifier le</th>
                                            <th>Statut</th>
                                            <th>Modifier</th>
                                            <th>Transporteur</th>
                                            <th>Détails</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $infos = new commandes();
                                            $infos->allInfosCommandes();
                                            foreach($infos->commandes as $result)
                                            {  
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $result['commandes_id']; ?></td>
                                            <td class="center"><?php echo $result['reglements_type']; ?></td>
                                            <td class="center"><?php echo $result['commandes_ajout']; ?></td>
                                            <td class="center"><?php echo $result['commandes_modif']; ?></td>
                                            <form action="index.php?p=home" method="post">
                                                <td class="center">
                                                    <select name="id_statuts" class="form-control">
                                                        <option value="1" <?php if($result['id_statuts'] == 1) { echo "selected";  }?>>En attente</option>
                                                        <option value="2" <?php if($result['id_statuts'] == 2) { echo "selected"; } ?>>Terminer</option>
                                                    </select>
                                                    <input type="hidden" name="commandes_modif" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                                    <input type="hidden" name="commandes_id" value="<?php echo $result['commandes_id']; ?>">
                                                </td> 
                                                <td><button type="submit" class="btn btn-success" name="modifier" value="Modifier">Modifier</button></td>
                                            </form>
                                            <!-- Button trigger modal -->
                                            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $result['commandes_id']; ?>">Ajouter un transporteur</button></td>
                            <!-- /.modal -->
                                        <td><a type="button" class="btn btn-primary btn-circle" href="index.php?p=details&id=<?php echo $result['commandes_id']; ?>"><i class="fa fa-list"></i>
                                        </button></td>
                                        </tr>
                                        <div class="modal fade" id="<?php echo $result['commandes_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Ajouter un transporteur</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form method="post" action="./index.php?p=home" role="form">
                                            <input type="hidden" name="commandes_id" value="<?php echo $result['commandes_id']; ?>">
                                            <select class="form-control" name="id_transporteurs">
                                                <?php
                                                    $infos = new transporteurs();
                                                    $infos->allInfosTransporteurs();
                                                    foreach($infos->transporteurs as $result)
                                                    {  
                                                ?>
                                                <option value="<?php echo $result['transporteurs_id']; ?>"><?php echo $result['transporteurs_nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="text" class="form-control" name="livraisons_date" placeholder="Date (AAAA/MM/JJ)" autofocus>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            <button type="submit" name="livreur" value="Livreur" class="btn btn-primary">Ajouter</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
