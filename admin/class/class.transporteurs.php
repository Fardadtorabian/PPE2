    <?php   
    class Transporteurs {
        /* Attributs */
    
        public $erreur;
        public $success;
        public $mess=array();
        public $livraison;
        public $transporteurs;    
        //------------------------------------------------------------------//
        // PARTIE TRANSPORTEUR FLORIS //
        //------------------------------------------------------------------//
        
        /* --- Permet de compter le nombre d'employé au sein de FLORIS --- */
        public function countTransporteurs() 
        {
            $sql = new BDD();
            $sql->getInstance();
            $req = $sql->query("SELECT count(*) FROM transporteurs");
            $res = $req->fetch();
            return $res;
        }
        
        /* --- Permet de d'afficher les données des transporteurs --- */
        public function allInfosTransporteurs()
        {
			$sql = new BDD();
            $sql->getInstance();
			$req = $sql->query("SELECT * FROM transporteurs ORDER BY transporteurs_id DESC");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->transporteurs = $req->fetchAll();
			return $this->transporteurs;
		}
        
        /* --- Permet de d'afficher les données liés aux transporteurs --- */
        public function infosLivraisons($r) 
        {
			$sql = new BDD();
			$sql->getInstance();
			$req = $sql->query("SELECT * FROM livraisons WHERE id_transporteurs=$r");
			$req->setFetchMode(PDO::FETCH_ASSOC);
			$this->livraison = $req->fetchAll();
			return $this->livraison;
		}
        
        /* --- Permet d'ajouter un transporteur --- */
        public function addTransporteur($nom,$prenom,$tel) 
        {
            $sql = new BDD();
            $sql->getInstance();
            // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
            if (!empty($nom) && !empty($prenom) && !empty($tel))
            {
                // on recherche si ce login est déjà utilisé par un autre membre
                $nom = $sql->quote($nom);
                $prenom = $sql->quote($prenom);
                $tel = $sql->quote($tel);
                $req2 = $sql->query("SELECT * FROM transporteurs WHERE transporteurs_nom=$nom");
                $res = $req2->fetch(PDO::FETCH_ASSOC);
                $count = count($res['transporteurs_nom']);
                if ($count < 1) 
                {
                    $req2=$sql->query('INSERT INTO transporteurs VALUES(NULL, '.$nom.','.$prenom.','.$tel.')');
                    $this->mess['value'] = 'Vous venez d\'ajouter un transporteur.';
                } else
                {
                    $this->mess['value'] = 'Un transporteur possède déjà ce login.';
                }
            } 
            else
            {
                $this->mess['value'] = 'Au moins un des champs est vide.';
            }
            return $this->mess;
        }
        
        /* --- Permet de de modifier les données transporteur --- */ 
        public function updateTransporteurs($id,$tel) 
        {
            $sql = new BDD();
            $sql->getInstance();
            $requete = $sql->query("UPDATE transporteurs
                                    SET transporteurs_tel = '$tel'
                                    WHERE transporteurs_id = '$id' ");

            //affichage des résultats, pour savoir si la modification a marchée:
            if($requete)
            { 
                $this->mess['value'] = 'La modification à été correctement effectuée.';    
            }
            else
            { 
                $this->mess['value'] = 'La modification à échouée.';    
            }
            return $this->mess;             
        }
        
        /* --- Permet de supprimer un transporteur de chez FLORIS --- */
        public function dellTransporteur()
        {
            $sql = new BDD();
            $sql->getInstance();
            //récupération de la variable d'URL,
            //qui va nous permettre de savoir quel enregistrement supprimer:
            $id  = $_GET["id"] ;
            //requête SQL:
            $requete = $sql->query("DELETE FROM transporteurs WHERE transporteurs_id = ".$id);

            //affichage des résultats, pour savoir si la suppression a marchée:
            if($requete)
            {
                $this->mess['value'] = 'La suppression à été correctement effectuée.';  
            }
            else
            {
                 $this->mess['value'] = 'La suppression à échouée.';
            } 
            return $this->mess;
        }
    }
?>