<?php
	class produits {
		/* --- Attributs --- */
        public $produits;
		public $req;
        public $success;
        public $erreur;
        public $mess=array();
        
		/* --- Methodes --- */
        /* --- Permet de compter la totalité des produits --- */
        public function countProduits() 
        {
            $sql = new BDD();
			$sql->getInstance();
            $req = $sql->query("SELECT count(*) FROM produits");
            $res = $req->fetch();
            return $res;
        }
        
        /* --- Permet de compter le nombre de produit d'un type (fleurs/plantes/accessoires) --- */
//        public function countProduit($r)
//        {
//            $sql = new BDD();
//			$sql->getInstance();
//            $req = $sql->query("SELECT count(*) FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id) WHERE id_types='$r' ORDER BY produits_nom ASC");
//            $res = $req->fetch();
//            return $res;
//        }
        
        /* --- Permet d'avoir la totalité des informations d'un produit --- */ 
        public function getInfosProduits()
        {
            $sql = new BDD();
			$sql->getInstance();
            $req=$sql->query("SELECT * FROM produits AS t1
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos = t3.promos_id)
            ORDER BY produits_nom ASC");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $this->produits = $req->fetchAll();
            return $this->produits;
        }
        
        /* --- Permet de rechercher un produit (Non fonctionnel) --- */
//        public function getRechercheProduits($r)
//        {
//			$sql = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->bd, $this->user, $this->password);
//			$req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id) WHERE produits_nom LIKE '%$r%' OR produits_description LIKE '%$r%' OR types_nom LIKE '%$r%' ORDER BY produits_nom ASC");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->produits = $req->fetchAll();
//			return $this->produits;
//		}
        
        /* --- Permet d'ajouter un produit à la BDD --- */
//        public function addProduits($nom,$description,$prix,$type,$image,$conditionnement,$promo,$taux,$visible)
//        {
//            $sql = new BDD();
//			$sql->getInstance();
//            // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
//            if (!empty($nom) && !empty($description) && !empty($prix) && !empty($type) && !empty($conditionnement) && !empty($taux)) 
//            {
//                // on recherche si ce login est déjà utilisé par un autre membre
//                $nom = $sql->quote($nom);
//                $req2 = $sql->query("SELECT * FROM produits WHERE produits_nom=$nom");
//                $res = $req2->fetch(PDO::FETCH_ASSOC);
//                $count = count($res['produits_nom']);
//
//                $this->mess['value'] = 'Vous venez d ajouter un produit.';
//
//                if ($count < 1) 
//                {
//                    $req2=$sql->query('INSERT INTO produits VALUES("", '.$nom.', '.$sql->quote($description).','.$sql->quote($prix).', '.$sql->quote($type).', '.$sql->quote($image).', '.$sql->quote($conditionnement).', '.$sql->quote($promo).', '.$sql->quote($taux).', '.$sql->quote($visible).')');
//                    $this->mess['code'] = $sql->lastInsertId();
//                } else 
//                {
//                    $this->mess['value'] = 'Un produit possède déjà ce nom.';
//                }
//                
//            } else 
//            {
//                $this->mess['value'] = 'Au moins un des champs est vide.';
//            }
//            return $this->mess;
//        }
        
        /* --- Permet d'afficher les paramètres modifiable d'un produit --- */
//        public function getProduit($r)
//        {
//			$sql = new BDD();
//			$sql->getInstance();
//			$req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id) WHERE produits_id='$r'");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->produits = $req->fetchAll();
//			return $this->produits;
//		}
        
        /* --- Permet de modifier les champs d'un produit --- */
        public function updateProduits($id, $promos, $visibles)
        {
            $sql = new BDD();
			$sql->getInstance();
            $requete = $sql->query("UPDATE produits
                                    SET id_promos = '$promos',
                                        id_visibles = '$visibles'
                                    WHERE produits_id = '$id' ");

            //affichage des résultats, pour savoir si la modification a marchée:
            if($requete)
            { 
                $this->mess['value'] = 'La modification à été correctement effectuée';
            }
            else 
            { 
                $this->mess['value'] = 'La modification à échouée';
            }
            return $this->mess;
        }
        
        /* --- Permet de supprimer un produit --- */
//        public function dellProduits()
//        {
//            $sql = new BDD();
//			$sql->getInstance();
//            //récupération de la variable d'URL,
//            //qui va nous permettre de savoir quel enregistrement supprimer:
//            $id  = $_GET["id"] ;
//            //requête SQL:
//            $requete = $sql->query("DELETE FROM produits WHERE produits_id = ".$id);
//            //affichage des résultats, pour savoir si la suppression a marchée:
//            if($requete)
//            {
//                $this->mess['value'] = 'La suppression à été correctement effectuée';
//            }
//            else
//            {
//                $this->mess['value'] = 'La suppression à échouée';
//            } 
//            return $this->mess;   
//        }  
	}
?>