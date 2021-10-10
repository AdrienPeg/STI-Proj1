
<?php
date_default_timezone_set('UTC');
session_start();
class database
{
    private $bdd;

    private function connect()
    {
        try {
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
                $_SESSION['loggedin']=false;
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
        $this->bdd->exec("INSERT INTO `Message` (`id`, `date`, `id_expediteur`, `subject`, `body`, `id_recepteur`) VALUES (NULL, '$date', '$idSender', '$subject', '$body', '$idReceiver')");
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

    public function getUsernameFromId($id)
    {
        $this->connect();
        $stmt=$this->bdd->query("SELECT username FROM Utilisateurs WHERE id='".$id."'");
        $username=$stmt->fetch();
        $this->disconnect();
        return $username;
    }

    public function changePassword($oldPassword, $newPassword, $newPasswordAgain)
    {
        try {
            $this->connect();
            $stmt=$this->bdd->query("SELECT *FROM Utilisateurs WHERE id='".$_SESSION['id']."'");
            $user=$stmt->fetch();
            if($user['password']==$oldPassword && $newPassword == $newPasswordAgain && $oldPassword != $newPassword){
                $this->bdd->exec("UPDATE Utilisateurs SET password='".$newPassword."' WHERE id='".$_SESSION['id']."'");
                $this->disconnect();
                return true;
            }
            else{
                $this->disconnect();
                return false;
            }


        } catch (Exception $e) {
            $this->disconnect();
            return false;
        }
    }

    public function createUser($username, $password, $passwordAgain, $valid, $type)
    {
        try {
            if($password != $passwordAgain)
            {
                return false;
            }
            $this->connect();
            $res=$this->bdd->exec("INSERT INTO `Utilisateurs` (`id`, `username`, `password`, `valid`, `type`) VALUES (NULL, '$username', '$password', '$valid', '$type')");
            $this->disconnect();
            return $res;
        } catch(Exception $e){
            $this->disconnect();
            return null;
        }
    }

    public function getUserInfo($id)
    {
        try{
            $this->connect();
            $stmt=$this->bdd->query("SELECT * FROM Utilisateurs WHERE id='".$id."'");
            $user=$stmt->fetch();
            $this->disconnect();
            return $user;

        }catch (Exception $e)
        {
            $this->disconnect();
            return null;
        }
    }

    public function editUser($id, $password, $valid, $type)
    {
        try {
            $this->connect();
            $res=$this->bdd->exec("UPDATE Utilisateurs SET password='".$password."', valid='".$valid."', type='".$type."' WHERE id='".$id."'");
            $this->disconnect();
            return $res;
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

}