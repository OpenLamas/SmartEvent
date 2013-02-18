<?php
  require_once('dao/class_db_request.php');
  require_once('basicClass/twigStart.php');
  require_once('basicClass/ClasseLDAP.php');

  class Login extends Controller{
    private $state = '';
    private $email = '';

    public function action(){
      if(isset($_SESSION['login']) && $_SESSION['login'] != ''){
        $tmp = $this->twig->getGlobals();
        header('Location: '.$tmp["site_root"]);
      }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(CONNECT_METHOD == "LDAP"){
            $_SESSION = $this->loginLDAP($_POST);
          }

          else{
            $_SESSION = $this->loginDefault();
          }

        }

        if($this->state == 'success'){
          if(!isset($_SESSION['login'])){
            throw new Exception("Error Processing Request", 1);
          }
          else{
            $tmp = $this->twig->getGlobals();
            header('Location: '.$_SERVER['HTTP_REFERER']);
          }
        }
        else
        {
          $template = $this->twig->loadTemplate('login.twig');
          if(!isset($_SESSION['login'])){
            echo $template->render(array('cur_user' => array('login'=> ''), 'email' => $this->email, 'state' => $this->state, 'auth' => CONNECT_METHOD));
          }
          else{
            echo $template->render(array('cur_user' => $_SESSION, 'state' => $this->state, 'auth' => CONNECT_METHOD));
          }
        }
      }
    }

    /**
    * Login avec un LDAP
    * @return array SESSION si login OK
    */
    public function loginLDAP($post){
      $tmpSession = '';
      $dbUsers = new db_users();
      if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
        $ldap = new monLDAP(LDAP_URL);
        $dn="uid=".$_POST['email'].",".LDAP_STRING;
        $passwd=$_POST['password'];

        if (!($ldap->ouverture($dn,$passwd))) { // Si le ldap refuse la connection
          if(CONNECT_METHOD_FALLBACK == "DB"){
            $tmpSession = $this->loginDefault();
            return $tmpSession;
          }

          else{
            $this->state = "wrong";
            $this->email = $_POST['email'];
          }
        }
        else {
          $tmpSession = $dbUsers->getUserByLogin($_POST['email']);
          if(count($tmpSession) == 1){ //Si l'utilisateur n'existe pas dans la base
            $tmpSession = $this->autoInscription($ldap, $post);
          }
          $this->state = 'success';
          return $tmpSession;         
        }
      }
    }

    /**
    * Inscription automatique avec les info du LDAP
    * @param $ldap objet ldap connecté
    * @return array SESSION si login OK
    */
    public function autoInscription($ldap, $post){
      echo 'New USER !!!';
      $dbUsers = new db_users();
      $info = $ldap->readEntry("uid=".$_POST['email'].",".LDAP_STRING, "(objectclass=*)", array("mail", "seeAlso", "givenName", "sn"));
      /*echo '<pre>';
      print_r($info);
      echo "nom: ".$info[0]['lastname'][0];
      echo'</pre>';*/
      $infoNewUser = array('refDroit' => '1', 'nomUtilisateur' => $info[0]['sn'][0], 'prenomUtilisateur' => $info[0]['givenname'][0], 'mailUtilisateur' => $info[0]['mail'][0], 'mdpUtilisateur' => 'x', 'login' => $_POST['email']);
      $dbUsers->addUser($infoNewUser);
      return $dbUsers->getUserByLogin($_POST['email']);
      //echo 'Groupe: '+$info['seealso'][3];
    }

    /**
    * Login avec la base de donnée
    * @return array SESSION si login OK
    */
    public function loginDefault(){
      $dbUsers = new db_users();
      $session = '';
      if(isset($_POST['email']) && isset($_POST['password']) && $_POST['password'] != 'x'){
        $tmpUser = $dbUsers->getPassword(addslashes($_POST['email']));
        if($tmpUser['mdputilisateur'] == md5(addslashes($_POST['password']))){
          $this->state = 'success';
          $session = $dbUsers->getUser($tmpUser['idutilisateur']);     
        } else {
          $this->state = 'wrong';
          $this->email = $_POST['email'];
        }
      } else {
        $this->state = 'noData';
      }
      return $session;
    }
  }
?>
