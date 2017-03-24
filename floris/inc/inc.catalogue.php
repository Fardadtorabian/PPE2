<?php
    if (empty($_GET['t']))
    {
		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=catalogue&t=4>');
		exit();
    }

    $sql = new produits();
	if ($_GET['t']==4)
    {
		$sql->getAllProduits();
    }
	if ($_GET['t']<4) {
		$sql->getTypeProduits($_GET['t']);
    }
?>	
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Catégories</h2>
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
                    </div><!--/category-productsr-->
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Nos produits</h2>
                    <?php foreach($sql->produits as $result){ ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img alt="" src="./assets/images/produits/<?php echo $result['produits_id']; ?>.jpg">
                                    <?php $newPrice = ($result['produits_prix']-((($result['produits_prix']*$result['promos_taux'])/100))); ?>
                                    <h2><?php if ($result['id_promos'] != 3) { ?> <span style="text-decoration:line-through; color:red"><?php echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); ?>€</span> / <b><?php echo $nombre_format_francais = number_format($newPrice, 2, ',', ' '); ?>€</b><?php } else { echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); ?>€<?php  } ?></h2>
                                    <p><?php echo utf8_encode($result['produits_nom']); ?></p>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2><?php if ($result['id_promos'] != 3) { ?> <span style="text-decoration:line-through; color:red"><?php echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); ?>€</span> / <b><?php echo $nombre_format_francais = number_format($newPrice, 2, ',', ' '); ?>€</b><?php } else { echo $nombre_format_francais = number_format($result['produits_prix'], 2, ',', ' '); ?>€<?php  } ?></h2>
                                        <p><?php echo utf8_encode($result['produits_nom']); ?></p>
                                        <a href="./index.php?p=details&id=<?php echo $result['produits_id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Voir de détails</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="<?php if ($result['id_types'] == 1) { ?>index.php?p=catalogue&t=1 <?php } if ($result['id_types'] == 2) { ?>index.php?p=catalogue&t=2<?php } if ($result['id_types'] == 3) { ?>index.php?p=catalogue&t=3<?php } ?>"><i class="fa fa-plus-square"></i><?php echo $result['types_nom']; ?></a></li>
                                    <li><a><i class="fa fa-plus-square"></i><?php if ($result['id_promos'] != 3) { echo 'en solde'; } else { echo 'non soldé'; } ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
<!--
                    <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>
-->
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>