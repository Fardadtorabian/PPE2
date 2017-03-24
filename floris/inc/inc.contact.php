<?php
if (isset($_POST['ticket']) && $_POST['ticket'] == 'Ticket') {
		$reclamations_commande = $_POST['reclamations_commande'];
		$reclamations_mail = $_POST['reclamations_mail'];
		$reclamations_sujet = $_POST['reclamations_sujet'];
		$reclamations_message = $_POST['reclamations_message'];
		$reclamation = new Commandes();
		$res = $reclamation->addReclamation($reclamations_commande,$reclamations_mail, $reclamations_sujet, $reclamations_message);
	}
?>
<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<!-- <h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				 -->
					<!-- <div id="gmap" class="contact-map"> -->
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Contactez-nous </h2>
                        <?php if(!empty($res)) { ?>
                            <center><?php echo $res['value']; ?></center>
                            <?php if ($res['type'] == 'success') 
                            { 
                                die('<META HTTP-equiv="refresh" content=3;URL=index.php?p=home>');
                                exit();
                            }
                            ?>                     
                        <?php } ?>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" action="./email.php" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="entreprise" class="form-control" required="required" placeholder="Entreprise">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="sujet" class="form-control" required="required" placeholder="Sujet">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Votre message ici ..."></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Envoyer">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Floris Carvin</h2>
	    				<address>
                            <p>Parc d'activités Gare d'Eau</p>
                            <p>ZI du Château</p>
                            <p>Rue Louis Joseph Gay-Lussac</p>
                            <p>BP 90105</p>
                            <p>62211 Carvin Cédex</p>
                            <p>Tél.: +33 3 21 08 57 67</p>
                            <p>Fax: +33 3 21 08 57 75</p>
                            <p>e-mail: secretariat.carvin@agoragroup.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
							</ul>
	    				</div>
                        <?php if (!empty($_SESSION['clients_mail'])) { ?>
                <div class="social-networks">
                    <h2 class="title text-center">Réclamation</h2>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Créer une demande
                </button>
                </div> 
                <br />        
                <?php } ?>  
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Réclamation</h4>
                            </div>
                            <div class="modal-body"> 
                                <p>
                                Vous avez des problèmes avec votre commande lié à un ou plusieurs produits, à un transporteur ou à quelques chose d'autre ? Complétez le formulaire ci-dessous afin de créer une demande et d'ouvrir un ticket pour résoudre votre problème. Nous vous répondrons au plus vite. (* Champ obligatoire)  
                                </p>
                                <br />
                                <form id="main-contact-form" class="contact-form row" action="index.php?p=contact" method="post">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="reclamations_commande" class="form-control" required="required" placeholder="Numéro de commande">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="reclamations_mail" class="form-control" required="required" placeholder="Mail">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" name="reclamations_sujet" class="form-control" required="required" placeholder="Sujet">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="reclamations_message" id="message" required="required" class="form-control" rows="8" placeholder="Votre réclamation"></textarea>
                                    </div>                         
                                        </div>
                                    <div class="modal-footer">
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="ticket" class="btn btn-primary pull-right" value="Ticket">Envoyer</button>
                                        </div>
                                    </div>
                                </form>    
                            </div>
                        </div>
                    </div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->