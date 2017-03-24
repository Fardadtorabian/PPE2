<?php
	class Clients {
		 
        /* --- Attributs --- */
        public $clients;
        public $erreur;
        public $success;
        public $mess=array();
        
        /* --- Methodes --- */
        
        /* --- Permet de compter les Clients Floris avec un compte actif --- */
        public function countClients()
        {
            $sql = new BDD();
            $sql->getInstance();
            $req = $sql->query("SELECT count(*) FROM clients WHERE etats_id = 2");
            $res = $req->fetch();
            return $res;
        }
        
        /* --- Permet de compter les Clients Floris avec un compte non actif --- */
//        public function countClientsEnCours()
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req = $sql->query("SELECT count(*) FROM clients WHERE etats_id = 1");
//            $res = $req->fetch();
//            return $res;
//        }
        
        /* --- Permet de compter la totalité d'inscription sur le site FLORIS --- */
        public function countInscriptionTotal() 
        {
            $sql = new BDD();
            $sql->getInstance();
            $req = $sql->query("SELECT count(*) FROM clients");
            $res = $req->fetch();
            return $res;
        }
        
        /* --- Permet d'affciher les informations des clients avec un compte actif --- */
//        public function getInfosClients() 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT membres_id, membres_mail, membres_nom, membres_prenom, membres_tel, membres_fax, etats_id, genres_id, DATE_FORMAT(membres_date_inscription, '%d/%m/%Y / %Hh%i') AS membres_date_inscription FROM membres
//            ORDER BY membres_id ASC");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->clients = $req->fetchAll();
//            return $this->clients;
//        }
        
        /* --- Permet d'affciher les informations des clients avec un compte non actif --- */
//        public function getInfosClientsEnCours()
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT membres_id, membres_mail, membres_nom, membres_prenom, membres_tel, membres_fax, etats_id, DATE_FORMAT(membres_date_inscription, '%d/%m/%Y / %Hh%i') AS membres_date_inscription FROM membres WHERE membres_actif = 0
//            ORDER BY membres_id ASC");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->clients = $req->fetchAll();
//            return $this->clients;
//        }
        
        /* --- Permet d'afficher la totalité d'incription sur le site FLORIS --- */ 
//        public function getInscriptionsClients()
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $req=$sql->query("SELECT membres_id, membres_mail, membres_nom, membres_prenom, membres_tel, membres_fax, etats_id, DATE_FORMAT(membres_date_inscription, '%d/%m/%Y / %Hh%i') AS membres_date_inscription FROM membres
//            ORDER BY membres_id ASC");
//            $req->setFetchMode(PDO::FETCH_ASSOC);
//            $this->clients = $req->fetchAll();
//            return $this->clients;
//        }
        
        /* --- Permet d'accepter un client à travers le BackOffice --- */
//        public function acceptClient($id, $etats_id)
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $requete = $sql->query("UPDATE membres
//                                    SET etats_id = '$etats_id'
//                                    WHERE membres_id = '$id' ");
//
//            //affichage des résultats, pour savoir si la modification a marchée:
//            if($requete)
//            { 
//            $this->mess['value'] = 'Le client à été correctement accepté';
//            } else { 
//            $this->mess['value'] = 'ECHEC';
//            }
//            return $this->mess;
//        }
//        
//        /* --- Permet de refuser un client à travers le BackOffice --- */
//        public function refuClient($id, $etats_id) 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $requete = $sql->query("UPDATE membres
//                                    SET etats_id = '$etats_id'
//                                    WHERE membres_id = '$id' ");
//
//            //affichage des résultats, pour savoir si la modification a marchée:
//            if($requete)
//            { 
//            $this->mess['value'] = 'Le client à été correctement refusé';
//            } else { 
//            $this->mess['value'] = 'ECHEC';
//            }
//            return $this->mess;
//        }
//        
//        /* --- Permet de bloquer un client à travers le BackOffice --- */
//        public function bloqueClient($id, $etats_id) 
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            $requete = $sql->query("UPDATE membres
//                                    SET etats_id = '$etats_id'
//                                    WHERE membres_id = '$id' ");
//
//            //affichage des résultats, pour savoir si la modification a marchée:
//            if($requete)
//            { 
//            $this->mess['value'] = 'Le client à été correctement bloqué';
//            } else { 
//            $this->mess['value'] = 'ECHEC';
//            }
//            return $this->mess;
//        }
//        
//        /* --- Permet de supprimer un client de la BDD -- */
//        public function dellClient()
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            //récupération de la variable d'URL,
//            //qui va nous permettre de savoir quel enregistrement supprimer:
//            $id  = $_GET["id"] ;
//            //requête SQL:
//            $requete = $sql->query("DELETE FROM membres WHERE membres_id = ".$id);
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
//        
//        /* --- Permet d'afficher l'historique des commandes d'un client --- */
//        public function clientCommandes($r) 
//        {
//			$sql = new BDD();
//			$sql->getInstance();
//			$req = $sql->query("SELECT * FROM commandes AS t1 
//            LEFT JOIN reglements AS t2 ON (t1.commandes_reglements=t2.reglements_id)
//            RIGHT JOIN status AS t3 ON (t1.commandes_status=t3.status_id) 
//            WHERE membres_id=$r");
//			$req->setFetchMode(PDO::FETCH_ASSOC);
//			$this->infos = $req->fetchAll();
//			return $this->infos;
//		}
//        
//        /* --- Permet de créer un membre pour le site FLORIS  (Pas fonctionnel) --- */
//        public function addClient($membres_mail,$membres_password,$membres_passconf,$membres_nom,$membres_prenom,$membres_tel,$membres_fax)
//        {
//            $sql = new BDD();
//            $sql->getInstance();
//            // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
//            if (!empty($membres_mail) && !empty($membres_password) && !empty($membres_passconf) && !empty($membres_nom) && !empty($membres_prenom) && !empty($membres_tel))
//            {
//                $etats_id = "1";
//                $membres_date_inscription = date("Y-m-d H:i:s");
//                //$refused = "0";
//                // on teste les deux mots de passe
//                if ($membres_password != $membres_passconf)
//                {
//                    return "Les 2 mots de passe sont différents.";
//                } else 
//                {
//                    // on recherche si ce login est déjà utilisé par un autre membre
//                    $membres_mail = $sql->quote($membres_mail);
//                    $req2 = $sql->query("SELECT * FROM membres WHERE membres_mail=$membres_mail");
//                    $res = $req2->fetch(PDO::FETCH_ASSOC);
//                    $count = count($res['membres_mail']);
//                    if ($count < 1)
//                    {
//                        //$grade = 1;
//                        $req2=$sql->query('INSERT INTO membres VALUES(NULL, '.$membres_mail.','.$sql->quote(hash('sha512',$membres_password)).','.$sql->quote($membres_nom).','.$sql->quote($membres_prenom).','.$sql->quote($membres_tel).','.$sql->quote($membres_fax).','.$sql->quote($etats_id).','.$sql->quote($membres_date_inscription).')');
//                        die('<META HTTP-equiv="refresh" content=0;URL=./inc/inc.inscription_confirm.php>');
//                        exit();
//                    } else 
//                    {
//                        return 'Un membre possède déjà ce login.';
//                    } 
//                }
//            } else
//            {
//                return 'Au moins un des champs est vide.';
//            }
//        }
	}
?>


