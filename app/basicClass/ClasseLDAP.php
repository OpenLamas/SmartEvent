<?php
  class monLDAP {
  /***********************
  Donn�es membres de la classe
  ***********************/
    private $debug = false;   // variable activant les messages d'informations de debug
    private $serveur = "";    // nom du serveur h�bergeant le LDAP - NE PAS INITIALISER ICI SA VALEUR PAR DEFAUT
    private $ldapconn;        // ressource caract�ristique du LDAP
    private $dn = "";         // dn de la personne identifi�e
    private $password = "";   // password de cette m�me personne
    private $nbre_resultat;   // nombre de r�sultat de la derni�re recherche effectu�e
    private $info = array();  // structure (tableau) de m�morisation de la recherche



  /***********************
  Constructeur de la classe

  il est unique, on doit donc tester le nombre de param�tres qui lui sont pass�s.

  Les param�tres de connexion sont initialis�s, la connexion ne sera effective que
  lors de l'appel � la m�thode ouverture()
  ***********************/
    public function __construct() {
		// Constructeur. Initialisation des param�tres de connexion au ldap. (pas de connexion "r�elle").

		// traitement suivant nb d'argument pass�s au constructeur
		$nb_args = func_num_args();
		if ($nb_args == 0) {
			$this->serveur = "localhost"; // adresse par d�faut
		}
		else  {
			$this->serveur = func_get_arg(0);
		}

		if ($this->debug) {
			echo "Initialisation de connexion avec le serveur ".$this->serveur."<br />";
		}
		// attention avec ldap >= 2.xxx, retourne une ressource avec les param�tres intialis�s.
		// IL N'Y A PAS ENCORE DE CONNEXION. Elle se fera notamment au prochain appel de ldap_bind.
		$this->ldapconn=ldap_connect($this->serveur);
		ldap_set_option($this->ldapconn,LDAP_OPT_PROTOCOL_VERSION,3);   //pour les LDAP version 3 et PHP 5
    }

  /***********************
  Destructeur de la classe

  Fermeture de la connexion au LDAP
  ***********************/
    public function __destruct() {
		if ($this->debug) {
			echo "Fermeture de la connexion par le destructeur<br />";
		}
		@ldap_close($this->ldapconn);
    }


  /***********************
  M�thode ouverture

  Teste l'identification au LDAP
  Retourne le r�sultat bool�en de cette tentative.
  ***********************/
    public function ouverture($dn="",$password="") { //Methode ouverture()
		$this->dn=$dn;
		$this->password=$password;

		if ($this->debug) {
			if (($this->dn=="") && ($this->password=="")) {
				echo "Connexion anonyme <br />";
			}
			else {
				echo "Connexion sous l'identit� ".$this->dn." <br />";
			}
		}

		return @ldap_bind($this->ldapconn,$this->dn,$this->password);   // connexion anonyme, il n'y a pas de nom ni de mot de passe
    }

  /***********************
  M�thode recherche

  Ex�cute une recherche dans l'annuaire en fonction des param�tres fournis
  Retourne le nombre de r�sultats de cette recherche
  M�morise le nombre de r�sultats et le r�sultat de la recherche dans les donn�es membres.
  ************************/
    public function recherche($dossierDeBase,$filtre) {
		// m�thode d�terminant le r�sulat et le m�morise dans la donn�e membre $this->info le r�sultat de la recherche
		// elle retourne le nombre de r�sultat

		$this->nbre_resultat=0;
		$this->resu_recherche = ldap_search($this->ldapconn,$dossierDeBase, $filtre);
		// dossier de base : celui � partir duquel la recherche doit s'effectuer. Exemple : (dn=univ-savoie, dn=iut)
		// on pr�cisera le filtre de la recherche. (Note : il y a filtrage sur les informations accessibles - donc suivant l'acl).
		//

		if ($this->resu_recherche) { // si on  a un resultat
			$this->nbre_resultat = ldap_count_entries($this->ldapconn,$this->resu_recherche);
			if ($this->debug) {
				echo "Il y a ".$this->nbre_resultat." resultat(s)";
			}
			// m�morisation du r�sultat de la recherche dans la donn�e membre $this->info
			$this->info = ldap_get_entries($this->ldapconn, $this->resu_recherche);
		}
		return $this->nbre_resultat;
	}

  /***********************
  M�thode getLigneAttribut

  Methode qui retourne la valeur de l'attribut $cle (par exemple cn)
  pour le ($num)i�me ligne du r�sultat de la recherche pr�c�dente.
  ***********************/
    public function getLigneAttribut($num,$cle) {
		if (isset($this->info[$num][$cle])) {
			return $this->info[$num][$cle][0];
		} else {
			return "";
		}
    }

  /***********************
  M�thode setPassword

  Methode n�cessaire pour le modification du mot de passe
  on suppose que la personne est d�j� identifi�e.
  ************************/
    public function setPassword($nouveaupassword) {
                $tmdp["userPassword"]=$nouveaupassword;
                return ldap_mod_replace ($this->ldapconn, $this->dn, $tmdp);
    }


  /***********************
  M�thode setAttribut

  Methode n�cessaire pour l'ajout d'un attribut quelconque � une personne (en mode admin).
  Retourne le r�sultat de la tentive de modification.
  ************************/
    public function setAttribut($dnCible,$attribut,$valeur) {
                return false;
    }

  /***********************
  M�thode ajoutPersonne

  Methode n�cessaire pour l'ajout d'une personne (en mode admin).
  Retourne le r�sultat de la tentive d'ajout.
  ************************/
    public function ajoutPersonne($nom,$prenom,$login,$tel) {
                return false;
    }

  /***********************
  M�thode suppressionPersonne

  Methode n�cessaire pour la suppression d'une personne (en mode admin).
  Retourne le r�sultat de la tentive de suppression.
  ************************/
    public function suppressionPersonne($login) {
                return false;
    }
  /*******************
  ********************/

  public function readEntry($dn, $filter, $obj) {
    $sr = ldap_read($this->ldapconn, $dn, $filter, $obj);
    return ldap_get_entries($this->ldapconn, $sr);
  }

  } // fin classe
?>