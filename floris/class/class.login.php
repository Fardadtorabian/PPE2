<?php
	class Login {
		/* --- Attributs --- */
		
        public $mess = array();
        
		/* --- Methodes --- */
        /* --- Pour se connecter au site de FLORIS --- */
		public function Connexion($clients_mail,$clients_password) 
        {
			$sql = new BDD();
            $sql->getInstance();
			$clients_mail = htmlspecialchars($clients_mail);
			$clients_mail= $sql->quote($clients_mail);
			$clients_password = htmlspecialchars($clients_password);
			$clients_password = hash('sha512', $clients_password);
			$req = $sql->query("SELECT * FROM clients AS t1 LEFT JOIN etats AS t2 ON (t1.etats_id = t2.etats_id) WHERE clients_mail=$clients_mail");
			$res = $req->fetch(PDO::FETCH_ASSOC);
            if ($res['etats_id'] == 3) 
            {
                $this->mess['type'] = "error";
                $this->mess['value'] = "Votre compte à été refusé, veuillez contacter la direction.";
                return $this->mess; 
            }
            if ($res['etats_id'] == 1) 
            {
                $this->mess['type'] = "error";
                $this->mess['value'] = "Votre compte est en cours de validation.";
                return $this->mess;
            }
			if (isset($res['clients_mail'])) {    
				if ($res['clients_password'] == $clients_password) {
					if ($res['etats_id'] == 2) {
						session_cache_expire(240);
						$_SESSION['clients_mail'] = $res['clients_mail'];
						$_SESSION['clients_id'] = $res['clients_id'];
						$_SESSION['clients_nom'] = $res['clients_nom'];
						$_SESSION['clients_prenom'] = $res['clients_prenom'];
                        $_SESSION['clients_tel'] = $res['clients_tel'];
						$_SESSION['SSID'] = session_id();
						$panier = new Panier();
						$create = $panier->AddPanier();
						die('<META HTTP-equiv="refresh" content=0;URL=./>');
                        exit();    
                    } else
                    { 
                        $this->mess['type'] = "error";
                        $this->mess['value'] = "Votre compte n'est pas activé";
                        return $this->mess;
                    }
                } else 
                { 
                    $this->mess['type'] = "error";
                    $this->mess['value'] = "Password incorrect !";
                    return $this->mess; 
                }
            } else 
            { 
                $this->mess['type'] = "error";
                $this->mess['value'] = "Login incorrect !";
                return $this->mess; 
            }
		}
        
        /* --- Pour s'inscrire au site de FLORIS --- */
        public function addMembres($clients_mail,$clients_password,$clients_passconf,$clients_nom,$clients_prenom,$clients_tel) 
        {
            $sql = new BDD();
            $sql->getInstance();
            // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
            if (!empty($clients_mail) && !empty($clients_password) && !empty($clients_passconf) && !empty($clients_nom) && !empty($clients_prenom) && !empty($clients_tel)) 
            {
                $email = $clients_mail; // test avec une chaine qui est une adresse email
                // Vérifie si la chaine ressemble à un email (En Regex, expression régulière)
                if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
                    
                $etats_id = "1";
                $clients_date_inscription = date("Y-m-d H:i:s");
                    // on teste les deux mots de passe
                    if ($clients_password != $clients_passconf) 
                    {
                        return "Les 2 mots de passe sont différents.";
                    } else 
                    {
                        // on recherche si ce login est déjà utilisé par un autre membre
                        $clients_mail = $sql->quote($clients_mail);
                        $req2 = $sql->query("SELECT * FROM clients WHERE clients_mail=$clients_mail");
                        $res = $req2->fetch(PDO::FETCH_ASSOC);
                        $count = count($res['clients_mail']);
                        if ($count < 1) 
                        {
                            $req2=$sql->query('INSERT INTO clients VALUES(NULL, '.$clients_mail.','.$sql->quote(hash('sha512',$clients_password)).','.$sql->quote($clients_nom).','.$sql->quote($clients_prenom).','.$sql->quote($clients_tel).','.$sql->quote($etats_id).','.$sql->quote($clients_date_inscription).')');
                            $this->mess['type'] = "success";
                            $this->mess['value'] = "Votre compte a bien été créé. Il sera actif dans les 48H.";
                            return $this->mess;
                        } else 
                        {
                            $this->mess['type'] = "error";
                            $this->mess['value'] = "Un client possède déjà ce login.";
                            return $this->mess;
                        }
                    }
                } else 
                {
                    $this->mess['type'] = "error";
                    $this->mess['value'] = "Cet email a un format non adapté.";
                    return $this->mess;
                }
            } else 
            {
                $this->mess['type'] = "error";
                $this->mess['value'] = "Au moins un des champs est vide.";
                return $this->mess;
            }   
        }
        
        /* --- Pour se déconnecter du site de FLORIS --- */
		public function Deconnexion() 
        {
			session_unset();  
			session_destroy();
			die('<META HTTP-equiv="refresh" content=0;URL=./>');
            exit();
		}
	}
?>