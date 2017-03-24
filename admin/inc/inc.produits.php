<?php
    if (isset($_POST['modifier']) && $_POST['modifier'] == 'Modifier')
    {
        $promos = $_POST['id_promos']; 
        $id = $_POST['produits_id'];
        $visibles = $_POST['id_visibles'];
        $modification = new produits();
        $res2 = $modification->updateProduits($id, $promos, $visibles);
    }
?>`
<div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Produits</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Produits Floris <?php if(!empty($res2)) { ?>(<?php echo $res2['value']; ?>)<?php } ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Identifiant</th>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Prix</th>
                                            <th>Promos</th>
                                            <th>Visible</th>
                                            <th>Modifier</th>
                                            <th>Fiche</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $infos = new produits();
                                            $infos->getInfosProduits();
                                            foreach($infos->produits as $result)
                                            {  
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $result['produits_id']; ?></td>
                                            <td><?php echo utf8_encode($result['produits_nom']); ?></td>
                                            <td><?php echo $result['types_nom']; ?></td>
                                            <td><?php echo $result['produits_prix']; ?></td>
                                            <form action="index.php?p=produits" method="post">
                                                <td class="center">
                                                    <select name="id_promos" class="form-control">
                                                        <option value="1" <?php if($result['id_promos'] == 1) { echo "selected";  }?>>-20%</option>
                                                        <option value="2" <?php if($result['id_promos'] == 2) { echo "selected"; } ?>>-50%</option>
                                                        <option value="3" <?php if($result['id_promos'] == 3) { echo "selected"; } ?>>-0%</option>
                                                    </select>
                                                    <input type="hidden" name="produits_id" value="<?php echo $result['produits_id']; ?>">
                                                </td>
                                                <td>
                                                <select name="id_visibles" class="form-control">
                                                    <option value="1" <?php if($result['id_visibles'] == 1) { echo "selected";  }?>>Oui</option>
                                                    <option value="2" <?php if($result['id_visibles'] == 2) { echo "selected"; } ?>>Non</option>
                                                </select>
                                                </td>
                                                <td><button type="submit" class="btn btn-success" name="modifier" value="Modifier">Modifier</button></td>
                                            </form>
                                            <td><button class="btn btn-default" data-toggle="modal" data-target="#<?php echo $result['produits_id'];?>">Voir le détail &raquo;</button>
                                                <div class="modal fade" id="<?php echo $result['produits_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Informations sur : <?php echo $result['produits_nom']; ?> (Produit numéro : <?php echo $result['produits_id']; ?>)</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Name : <b><?php echo utf8_encode($result['produits_nom']);?></b><br /><hr>Description : <b><?php echo utf8_encode($result['produits_description']); ?></b><br /><hr>Prix : <b><?php echo $result['produits_prix']; ?></b><br /><hr>Type : <b><?php echo $result['types_nom']; ?></b><br /><hr>Image : <img src="../assets/images/produits/<?php echo $result['produits_id']; ?>.jpg" height="100px" width="100px"><br /><hr>En stock : <b><?php echo $result['produits_conditionnement']; ?></b><br /><hr>Promo : <b>-<?php echo $result['promos_taux']; ?>%</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
    <script language="javascript">
          function supprimer( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment supprimer ce transporteur ?" ) ;
	if( supprimer )
	{
	  document.location.href = "./index.php?p=produits&id="+identifiant ;
	}
      }
    </script>