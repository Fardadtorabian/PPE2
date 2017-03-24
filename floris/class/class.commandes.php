<?php   
    class Commandes {
        /* Attributs */
        public $mess = array();
        /* --- Methodes --- */
        /* --- Permet au client de créer une demande afin d'y créer un ticket --- */
        public function addReclamation($reclamations_commande,$reclamations_mail, $reclamations_sujet, $reclamations_message)
        {
            $sql = new BDD();
            $sql->getInstance();
            if (!empty($reclamations_commande) && !empty($reclamations_mail) && !empty($reclamations_sujet) && !empty($reclamations_message))
            {
                $email = $reclamations_mail; // test avec une chaine qui est une adresse email
                // Vérifie si la chaine ressemble à un email (En Regex, expression régulière)
                if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email))
                {
                    $reclamations_date_ajout = date("Y-m-d H:i:s");
                    $req2=$sql->query('INSERT INTO reclamations VALUES(NULL,'.$sql->quote($reclamations_commande).','.$sql->quote($reclamations_mail).','.$sql->quote($reclamations_sujet).','.$sql->quote($reclamations_message).')');
                    $this->mess['type'] = "success";
                    $this->mess['value'] = "Votre réclamation a bien été envoyé. Elle sera prise en compte dans les 48H, un mail vous sera envoyé.";
                    return $this->mess;
                }
                else 
                {
                    $this->mess['type'] = "error";
                    $this->mess['value'] = "Votre adresse email n'est pas correct.";
                    return $this->mess;
                }
            } 
            else
            {
                $this->mess['type'] = "error";
                $this->mess['value'] = "Un ou plusieurs champs n'ont pas été renseignés.";
                return $this->mess;
            }
        }
    }
?>