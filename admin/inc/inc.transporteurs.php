<?php
    if (isset($_POST['modifier']) && $_POST['modifier'] == 'Modifier')
    {
        $tel = $_POST['transporteurs_tel']; 
        $id = $_POST['transporteurs_id'];
        $modification = new transporteurs();
        $res2 = $modification->updateTransporteurs($id, $tel);
    }
?>`
<?php if(!empty($_GET['id'])) { ?>
    <?php
        $dell = new transporteurs();
        $res = $dell->dellTransporteur(); 
    ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <?php echo $res['value']; ?></p>
        </div>
    </div>
    <?php 
    { 
        die('<META HTTP-equiv="refresh" content=2;URL=index.php?p=transporteurs>');
        exit();
    }
    ?>
<?php } ?>
<?php 
if (isset($_POST['ajouter']) && $_POST['ajouter'] == 'Ajouter') 
{
    $nom = $_POST['transporteurs_nom'];
    $prenom = $_POST['transporteurs_prenom'];
    $tel = $_POST['transporteurs_tel'];
    $ajouter = new transporteurs();
    $res = $ajouter->addTransporteur($nom,$prenom,$tel);
}
?>`
<div id="wrapper">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transporteurs</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Transporteurs Floris
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Ajouter un transporteur</button>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Ajouter un transporteur</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="index.php?p=transporteurs" method="post">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Nom du transporteur" name="transporteurs_nom" type="text" autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Prénom du transporteur" name="transporteurs_prenom" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Tél du transporteur" name="transporteurs_tel" type="text">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            <button type="submit" name="ajouter" value="Ajouter" class="btn btn-primary">Ajouter</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Identifiant</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Téléphone</th>
                                            <th>Modifier</th>
                                            <th>Supprimer</th>
                                            <th>Détails</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $infos = new Transporteurs();
                                            $infos->allInfosTransporteurs();
                                            foreach($infos->transporteurs as $result)
                                            {  
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $result['transporteurs_id']; ?></td>
                                            <td><?php echo utf8_encode($result['transporteurs_nom']); ?></td>
                                            <td><?php echo utf8_encode($result['transporteurs_prenom']); ?></td>
                                            <form action="index.php?p=transporteurs" method="post">
                                                <td class="center">
                                                    <input type="text" name="transporteurs_tel" value="<?php echo $result['transporteurs_tel']; ?>">
                                                    <input type="hidden" name="transporteurs_id" value="<?php echo $result['transporteurs_id']; ?>">
                                                </td> 
                                            <td><button type="submit" class="btn btn-success" name="modifier" value="Modifier">Modifier</button></td>
                                            </form>
                                            <td><a href="#" onClick='supprimer(<?php echo $result['transporteurs_id']; ?>)' type="button" class="btn btn-danger">Supprimer</a></td>
                                            <td><button class="btn btn-default" data-toggle="modal" data-target="#<?php echo $result['transporteurs_id'];?>">Voir le détail &raquo;</button>
                                                <div class="modal fade" id="<?php echo $result['transporteurs_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Informations sur : <?php echo $result['transporteurs_nom']; echo $result['transporteurs_prenom']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <h3 style="color:#333; font-size:30px" class="sub-header">Historique des livraisons</h3>
                                                            <!-- STRIPED ROWS -->
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr class="info">
                                                                        <th>ID</th>
                                                                        <th>Date de livraison</th>
                                                                        <th>Commmande</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        $infos->infosLivraisons($result['transporteurs_id']);
                                                                        foreach($infos->livraison as $res) {
                                                                    ?>
                                                                  <tr>
                                                                      <td><?php echo $res['livraisons_id']; ?></td>
                                                                      <td><?php echo utf8_encode($res['livraisons_date']); ?></td>
                                                                      <td><?php echo utf8_encode($res['id_commandes']); ?></td>
                                                                  </tr>
                                                                   <?php } ?>
                                                                </tbody>
                                                            </table>
                                                            <!-- END STRIPED ROWS -->
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
	  document.location.href = "./index.php?p=transporteurs&id="+identifiant ;
	}
      }
    </script>