
<?php
date_default_timezone_set('UTC');
session_start();
class database
{
    private $bdd;

    private function connect()
    {
        try {
            echo 'Connected';
            $this->bdd = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    private function disconnect()
    {
        $this->bdd = null;
    }

    public function login($username, $password)
    {
        try {
            $this->connect();
            $stmt = $this->bdd->query("SELECT * FROM Utilisateurs WHERE username ='" . $username . "' AND valid ='1'");
            $result = $stmt->fetch();
            $this->disconnect();
            if (isset($result) && $password == $result['password']) {
                $_SESSION['type'] = $result['type'];
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $result['id'];
                $_SESSION['loggedin']=true;
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->disconnect();
            return false;
        }
    }

    public function unlogin()
    {
        session_destroy();
    }

    public function deleteMessage($idMessage)
    {
        try {
            $this->connect();
            $this->bdd->exec("DELETE FROM Message WHERE Message.id='" . $idMessage . "'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }

    }

    public function deleteUser($idUser)
    {
        try {
            $this->connect();
            $this->bdd->exec("DELETE FROM Utilisateurs WHERE id ='" . $idUser . "'");
            $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function getMessages($idUser)
    {
        $this->connect();
        $stmt=$this->bdd->query("SELECT * FROM Message WHERE id_recepteur='".$idUser."'");
        $messages=$stmt->fetchAll();
        $this->disconnect();
        return $messages;
    }

    public function getMessage($idMessage)
    {
        $this->connect();
        $stmt=$this->bdd->query("SELECT * FROM Message WHERE id='".$idMessage."'");
        $message=$stmt->fetch();
        $this->disconnect();
        return $message;
    }

    public function sendMessage($idSender, $idReceiver, $subject, $date, $body)
    {
        try {
        $this->connect();
        $this->bdd->exec("INSERT INTO `produit` (`id`, `date`, `id_expediteur`, `subject`, `body`, `id_recepteur`) VALUES (NULL, '$date', '$idSender', '$subject', '$body', '$idReceiver')");
        $this->disconnect();
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function getAllUsers()
    {
        $this->connect();
        $stmt=$this->bdd->query("SELECT * FROM Utilisateurs");
        $users=$stmt->fetchAll();
        $this->disconnect();
        return $users;
    }

    public function getIdFromUsername($username)
    {
        $this->connect();
        $stmt=$this->bdd->query("SELECT id FROM Utilisateurs WHERE username='".$username."'");
        $id=$stmt->fetch();
        $this->disconnect();
        return $id;
    }

}