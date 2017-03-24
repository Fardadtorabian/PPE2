<?php
	class commandes {
		/* --- Attributs --- */
		public $commandes;
		public $details;
		public $infos;
        public $erreur;
        public $success;
        public $adresse;
        public $livraison;
        public $mess = array();

		/* --- Methodes --- */
        /* --- Permet d'afficher la totalité des commandes associé au client --- */
		public function allInfosCommandes() 
        {
            $sql = new BDD();
            $sql->getInstance();
			$req = $sql->query("SELECT * FROM commandes AS t1 
            LEFT JOIN clients AS t2 ON (t1.id_clients=t2.clients_id) 
            LEFT JOIN statuts AS t3 ON (t1.id_statuts=t3.statuts_id)
            LEFT JOIN reglements AS t4 ON (t1.id_reglements=t4.reglements_id)
            LEFT JOIN entreprises AS t6 ON (t1.commandes_id=t6.entreprises_id)
            LEFT JOIN pays AS t7 ON (t6.id_pays=t7.pays_id)
            ORDER BY commandes_ajout DESC");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->commandes = $req->fetchAll();
			return $this->commandes;
		}
        
        /* --- Permet d'afficher le transporteur d'une commande --- */
        
//        public function infosLivraison($r) 
//        {
//			$sql = new BDD();
//			$sql->getInstance();
//			$req = $sql->query("SELECT * FROM livraisons AS t1 LEFT JOIN transporteurs AS t2 ON (t1.id_transporteurs=t2.transporteurs_id) WHERE id_commandes=$r");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->livraison = $req->fetchAll();
//			return $this->livraison;
//		}
        
        /* --- Permet d'afficher la totalité des commandes associé au client, à son détail pour impression --- */
		public function allInfosCommandesDetails($id) 
        {
            $sql = new BDD();
            $sql->getInstance();
			$req = $sql->query("SELECT * FROM commandes AS t1 
            LEFT JOIN clients AS t2 ON (t1.id_clients=t2.clients_id) 
            LEFT JOIN statuts AS t3 ON (t1.id_statuts=t3.statuts_id)
            LEFT JOIN reglements AS t4 ON (t1.id_reglements=t4.reglements_id)
            LEFT JOIN entreprises AS t6 ON (t1.commandes_id=t6.entreprises_id)
            LEFT JOIN pays AS t7 ON (t6.id_pays=t7.pays_id)
            LEFT JOIN livraisons AS t8 ON (t1.commandes_id=t8.id_commandes)
            LEFT JOIN transporteurs AS t9 ON (t8.id_transporteurs=t9.transporteurs_id)
            WHERE commandes_id=$id");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->commandes = $req->fetchAll();
			return $this->commandes;
		}
        
//        public function infosTransporteur()
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//			$req = $sql->query("SELECT * FROM transporteurs");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->transporteurs = $req->fetchAll();
//			return $this->transporteurs;
//        }
    
        /* Permet de compter le nombre de commande qui ne sont pas encore terminé */
		public function countAttente()
        {
            $sql = new BDD();
            $sql->getInstance();
			$req = $sql->query("SELECT count(*) FROM commandes WHERE id_statuts<2");
			$res = $req->fetch();
			return $res;
		}
        
        /* --- Permet d'afficher les champs à modifier --- */
//        public function modifCommandes($id)
//        {
//			$sql = new BDD();
//			$sql->getInstance();
//			$req = $sql->query("SELECT * FROM commandes WHERE commandes_id=$id");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->infos = $req->fetchAll();
//			return $this->infos;
//		}
        
        /* --- Permet de mettre à jour les champs modifiable --- */
        public function updateCommandes($id, $statuts, $date) 
        {
            $sql = new BDD();
			$sql->getInstance();
            $requete = $sql->query("UPDATE commandes
                                    SET id_statuts = '$statuts',
                                    commandes_modif = '$date'
                                    WHERE commandes_id = '$id' ");

            //affichage des résultats, pour savoir si la modification a marchée:
            if($requete)
            { 
                $this->mess['value'] = 'La modification à été correctement effectuée';
            } else { 
                $this->mess['value'] = 'La modification à échouée';
            }
            return $this->mess;
        }
        
        public function addLivraison($id, $date_livraison, $transporteur)
        {
            $sql = new BDD();
			$sql->getInstance();
            
            $requete = $sql->query('INSERT INTO livraisons VALUES(NULL, '.$sql->quote($date_livraison).','.$sql->quote($transporteur).','.$sql->quote($id).')');

            //affichage des résultats, pour savoir si la modification a marchée:
            if($requete)
            { 
                $this->mess['type'] = "success";
                $this->mess['value'] = "Le transporteur à bien été assigné à la commande.";
                return $this->mess;
            } 
            else 
            { 
                $this->mess['type'] = "error";
                $this->mess['value'] = "Une erreur a empeché l'assignement.";
                return $this->mess;
            }
        }
        
        public function detailsCommandes($r) 
        {
			$sql = new BDD();
			$sql->getInstance();
			$req = $sql->query("SELECT * FROM lignes WHERE id_commandes=$r");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->details = $req->fetchAll();
			return $this->details;
		}
        
        public function montantTotal($r)
        {
            $sql = new BDD();
            $sql->getInstance();
            $req = $sql->query("SELECT SUM(lignes_prix*lignes_quantite) AS prix_total FROM lignes WHERE id_commandes =$r");
            $res = $req->fetch();
            return $res;
        }
	}
?>
