<?php
	class Panier {
		/* --- Attributs --- */
		private static $_instance;
		protected $total;
		protected $taxes = 17.5;
		protected $ttc;
		protected $ht;
		public $mess = array();
		public $sesspanier;
		public $value=array();
		/* --- Methodes --- */
		function __construct()
        {
			$this->sesspanier = &$_SESSION['panier'];
		}
        
        /* --- Permet de créer un panier --- */
		public function AddPanier()
        {
			$this->sesspanier=array();
		}
        
        /* --- Permet de compter le panier --- */
		public function CountPanier()
        {
			if (isset($_SESSION['panier'])) 
            {
				return count($_SESSION['panier']);
			}
			else 
            {
				return 0;
			}
		}
        
        /* --- Permet d'afficher les produits du panier en fonction de l'id --- */
		public function GetProduit($id) 
        {
			$search = array_search($id,  $this->sesspanier);
			 if ($search !== false) 
             {
                 $this->value['id'] = $this->sesspanier[$search];
				 $this->value['name'] = $this->sesspanier[$search];
				 $this->value['produit_qte'] = $this->sesspanier[$search];
				 $this->value['price'] = $this->sesspanier[$search];
			 }
			 return $this->value;
		}
        
        /* --- Permet d'ajouter un produit et ses paramètres dans le panier --- */
		public function AddProduit($id,$nom,$qte,$prix) 
        {
			if (!empty($qte)) 
            {
                $produit = new produits();
				$stock1 = $produit->getStock($id);
				$pnr = new Panier();
				$stock2 = $pnr->GetProduit($id);
				if ($stock1 >= $qte+ !empty($stock2['produit_qte'])) 
                {
					//Si le produit existe déjà on ajoute seulement la quantité
                    foreach ($this->sesspanier as $key => $value)
                    {
                        $search = array_search($id,  $value);
                        if ($search !== false) 
                        {
                            $this->sesspanier[$key]['qte'] += $qte;
                            $this->mess['type'] = "success";
                            $this->mess['value'] = "Quantité modifié";
                            $result = TRUE;
                        }
                    }
                    if(empty($result)) 
                    {
                        $product = array();
                        $product['id'] = $id;
                        $product['name'] = $nom;
                        $product['qte'] = $qte;
                        $product['price'] = $prix;
                        array_push($this->sesspanier, $product);
                        $this->mess['type'] = "success";
                        $this->mess['value'] = "Produit ajouté";
                    }
				} 
                else 
                {
					$this->mess['type'] = "warning";
					$this->mess['value'] = "Il n'y a pas assez de stock";
				}
			} 
            else
            {
				$this->mess['type'] = "danger";
				$this->mess['value'] = "Veuillez renseigner une quantité";
			}
			return $this->mess;
		}
        
        /* --- Permet de modifier la quantité d'un produit spécifique --- */
		public function SetProduit($id,$qte) 
        {
			//Si la quantité est positive on modifie sinon on supprime l'article
			if ($qte > 0) 
            {
                foreach ($this->sesspanier as $key => $value)
                {
                    $search = array_search($id,  $value);
                    if ($search !== false) 
                    {
                        $this->sesspanier[$key]['qte'] = $qte;
                        $this->mess['type'] = "success";
					    $this->mess['value'] = "Quantité modifié";
                    }
                }
			} else
            {
				$_instance = new panier();
				$_instance->delPanier($id);
				$this->mess['type'] = "success";
				$this->mess['value'] = "Produit supprimé";
			}
			return $this->mess;
		}
        
        /* --- Permet de supprimer un produit spécifique du panier --- */
		public function DelProduit($id) 
        {
			//Nous allons passer par un panier temporaire
			$tmp=array();
            foreach ($this->sesspanier as $key => $value)
            {
                if ($value['id'] !== $id) 
                {
                    $product = array();
                    $product['id'] = $value['id'];
                    $product['name'] = $value['name'];
                    $product['qte'] = $value['qte'];
                    $product['price'] = $value['price'];
                    array_push($tmp, $product);
                }
            } 
			//On remplace le panier en session par notre panier temporaire à jour
			$_SESSION['panier'] =  $tmp;
			//On efface notre panier temporaire
			unset($tmp);
			$this->mess['type'] = "success";
			$this->mess['value'] = "Produit supprimé.";
			return $this->mess;
		}
        
        /* --- Permet de retourner le panier total --- */
		public function GetPanier() 
        {
			return $_SESSION['panier'];
		}
        
        /* --- Permet de valider la commande avec son détail --- */
		public function CmdPanier($nom,$siret,$adresse,$ville,$postal,$mail,$tel,$pays,$reglement,$id) 
        {
            $sql = new BDD();
            $sql->getInstance();
            // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
            if (!empty($nom) && !empty($siret) && !empty($adresse) && !empty($ville) && !empty($postal) && !empty($mail) && !empty($tel) && !empty($pays) && !empty($reglement)) 
            {
                $commandes_ajout = date("Y-m-d H:i:s");
                $statuts = "1";
                $commandes_modif = "";
                $req2=$sql->query('INSERT INTO entreprises VALUES(NULL,'.$sql->quote($nom).','.$sql->quote($siret).','.$sql->quote($adresse).','.$sql->quote($ville).','.$sql->quote($postal).','.$sql->quote($mail).','.$sql->quote($tel).','.$sql->quote($pays).', '.$sql->quote($id).')');
                $lastInsertId = $sql->lastInsertId();
                $req3 = $sql->query('INSERT INTO commandes VALUE(NULL, '.$sql->quote($commandes_ajout).', '.$sql->quote($commandes_modif).', '.$sql->quote($reglement).', '.$sql->quote($statuts).', '.$sql->quote($id).')');
                foreach ($this->sesspanier as $key => $value)
                {
                    $produits_id = $value['id'];
                    $lignes_nom = $value['name'];
                    $lignes_quantite = $value['qte'];
                    $lignes_prix = $value['price'];
                    $req = $sql->query('INSERT INTO lignes VALUES("",'.$sql->quote($lignes_nom).','.$sql->quote($lignes_prix).','.$sql->quote($lignes_quantite).','.$sql->quote($produits_id).','.$sql->quote($lastInsertId).')');
                }
                $this->mess['type'] = "success";
                $this->mess['value'] = "Votre commande a bien été prise en compte.";
                return $this->mess;
            }
            else 
            {
                $this->mess['type'] = "error";
                $this->mess['value'] = "Un ou plusieurs champs n'ont pas été renseignés";
                return $this->mess;
            }
		}
        
        /* --- Permet de vider la panier --- */
		public function DelPanier() 
        {
			unset($_SESSION['panier']);
		}
        
        /* --- Permet de calculer le montant total du panier --- */
		public function MontantTotal() 
        {
			$this->total=0;
            foreach($_SESSION['panier'] as $panier)
            {
                $prix = str_replace('.',',',$panier['price']);
                $this->total += $prix*$panier['qte'];
            }
			return $this->total;
        }
        
        /* --- Permet de calculer la taxe --- */ 
		public function MontantTaxes() 
        {
			$this->ttc = self::MontantTotal()*$this->taxes/100;
			return $this->ttc;
		}
        
        /* ---  Permet de calculer le montant ht --- */
		public function MontantHorsTaxes() 
        {
			$this->ht = self::MontantTotal();
			return $this->ht;
		}
	}
?>