<?php
	class produits {
		/* --- Attributs --- */
		public $produits;
        
		/* --- Methodes --- */
        /* --- Permet d'afficher les produits en promo de la semaine --- */
        public function getProduitsPromoSem() 
        {
            $sql = new BDD();
            $sql->getInstance();
            $req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            WHERE t1.id_promos=1 AND t1.id_taux=2");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $this->produits = $req->fetchAll();
            return $this->produits;
        }
        
        /* --- Permet d'afficher les produits en promo du mois --- */
        public function getProduitsPromoMois() 
        {
            $sql = new BDD();
            $sql->getInstance();
            $req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            LEFT JOIN taux AS t4 ON (t1.id_taux=t4.taux_id)
            WHERE t1.id_promos=1 AND t1.id_taux=1");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $this->produits = $req->fetchAll();
            return $this->produits;
        }
        
        /* --- Permet d'afficher tout les produits de la BDD --- */
        public function getAllProduits() {
            $sql = new BDD();
            $sql->getInstance();
            $req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            ORDER BY produits_prix ASC");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $this->produits = $req->fetchAll();
            return $this->produits;
            
        }
        
        /* --- Permet d'afficher les produits en fonction du type choisi --- */
        public function getTypeProduits($r) 
        {
			$sql = new BDD();
			$sql->getInstance();
			$req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            WHERE id_types='$r' ORDER BY produits_prix ASC");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->produits = $req->fetchAll();
			return $this->produits;
		}
        
        /* --- Permet d'afficher tout les produits qui sont promotions --- */
//        public function getProduitsRentable() 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
//            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
//            LEFT JOIN taux AS t4 ON (t1.id_taux=t4.taux_id)
//            WHERE id_promos=1 ORDER BY produits_prix ASC");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->produits = $req->fetchAll();
//            return $this->produits;
//        }
        
        /* --- Permet d'afficher les produits de même type dans une limite de 3 --- */ 
//        public function getTypeIdentique($r) 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
//            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
//            LEFT JOIN taux AS t4 ON (t1.id_taux=t4.taux_id)
//            WHERE id_types='$r' LIMIT 3");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->produits = $req->fetchAll();
//            return $this->produits;
//        }
        
        /* --- Permet d'afficher tout les produits en promotion dans une limite de 3 --- */ 
//        public function getBestSeller() 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
//            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
//            LEFT JOIN taux AS t4 ON (t1.id_taux=t4.taux_id)
//            WHERE id_promos=1 LIMIT 3");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->produits = $req->fetchAll();
//            return $this->produits;
//        }
        
        /* --- Permet d'afficher le détail d'un produit selectionne --- */
        public function getDetailsProduits($r)
        {
            $sql = new BDD();
            $sql->getInstance();
            $req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            WHERE produits_id='$r'");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->produits = $req->fetchAll();
			return $this->produits;
        }
        
        /* --- Permet d'ajouter une quantite au panier en fonction du stock (lien avec la class Panier)--- */
        public function getStock($r)
        {
			$sql = new BDD();
            $sql->getInstance();
			$req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            WHERE produits_id='$r'");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->produits = $req->fetchAll();
			return $this->produits[0]['produits_conditionnement'];
		}
        
        /* --- Permet d'afficher dans le panier, le nombre de produit qu'on a selectionne --- */
        public function getproduit($r)
        {
			$sql = new BDD();
            $sql->getInstance();
			$req=$sql->query("SELECT * FROM produits AS t1 
            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id)
            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
            WHERE produits_id='$r'");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->produits = $req->fetchAll();
			return $this->produits;
		}
        
        /* --- Permet de rechercher un produit --- */
//        public function getRecherche($Mot)
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT * FROM produits AS t1 
//            LEFT JOIN types AS t2 ON (t1.id_types = t2.types_id) 
//            LEFT JOIN promos AS t3 ON (t1.id_promos=t3.promos_id)
//            LEFT JOIN taux AS t4 ON (t1.id_taux=t4.taux_id)
//            WHERE produits_nom LIKE \"%$Mot%\" OR types_nom LIKE \"%$Mot%\"");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->produits = $req->fetchAll();
//            return $this->produits;
//        }
	}
?>