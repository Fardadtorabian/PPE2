<?php
	class Panier {
		public $details;
        public $r;

		/* --- Methodes --- */
		function __construct()
        {
			$this->histo = &$_SESSION['histo'];
		}

        public function detailsHisto($r) 
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

}