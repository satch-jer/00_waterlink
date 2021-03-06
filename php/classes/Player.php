<?php

include_once "Db.php";

class Player{

    private $mail;
    private $event;
    private $lastname;
    private $firstname;
    private $street;
    private $housenumber;
    private $postal;
    private $city;
    private $phone;
    private $birthday;
    private $question_1;
    private $question_2;
    private $expiration;
    private $conditions;
    private $marketing;

    //set
    public function __set($prop, $val){
        switch($prop){
            case 'mail':
                $this->mail = $val;
                break;
            case 'event':
                $this->event = $val;
                break;
            case 'lastname':
                $this->lastname = $val;
                break;
            case 'firstname':
                $this->firstname = $val;
                break;
            case 'street':
                $this->street = $val;
                break;
            case 'housenumber':
                $this->housenumber = $val;
                break;
            case 'postal':
                $this->postal = $val;
                break;
            case 'city':
                $this->city = $val;
                break;
            case 'phone':
                $this->phone = $val;
                break;
            case 'birthday':
                $this->birthday = $val;
                break;
            case 'question_1':
                $this->question_1 = $val;
                break;
            case 'question_2':
                $this->question_2 = $val;
                break;
            case 'expiration':
                $this->expiration = $val;
                break;
            case 'conditions':
                $this->conditions = $val;
                break;
            case 'marketing':
                $this->marketing = $val;
                break;
            default:
                echo "Error: " . $prop . " bestaat niet.";
        }
    }

    //get
    public function __get($prop){
        switch($prop) {
            case 'mail':
                return $this->mail;
            case 'event':
                return $this->event;
            case 'lastname':
                return $this->lastname;
            case 'firstname':
                return $this->firstname;
            case 'street':
                return $this->street;
            case 'housenumber':
                return $this->housenumber;
            case 'postal':
                return $this->postal;
            case 'city':
                return $this->city;
            case 'phone':
                return $this->phone;
            case 'birthday':
                return $this->birthday;
            case 'question_1':
                return $this->question_1;
            case 'question_2':
                return $this->question_2;
            case 'expiration':
                return $this->expiration;
            case 'conditions':
                return $this->conditions;
            case 'marketing':
                return $this->marketing;
            default:
                echo "Error: " . $prop . " bestaat niet.";
        }
    }

    //check if mail exists
    public function exist($mail){
        $db = Db::getInstance();

        $stmt = $db->prepare("SELECT mail FROM players WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //get participation status
    public function participated($mail){
        $db = Db::getInstance();

        $stmt = $db->prepare("SELECT lastname FROM players WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);

        $stmt->execute();
        $result = $stmt->fetch();

        return $result["lastname"];
    }

    //get expiration date
    public function expirationDate($mail){
        $db = Db::getInstance();

        $stmt = $db->prepare("SELECT expiration FROM players WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);

        $stmt->execute();
        $result = $stmt->fetch();

        return $result["expiration"];
    }

    //update after participation
    public function updatePlayer($mail){
        $db = Db::getInstance();

        $stmt = $db->prepare("UPDATE players SET 
                lastname = :lastname, 
                firstname = :firstname, 
                street = :street, 
                housenumber = :housenumber, 
                postal = :postal, 
                city = :city, 
                phone = :phone, 
                birthday = :birthday, 
                question_1 = :question_1, 
                question_2 = :question_2,
                conditions = :conditions,
                marketing = :marketing WHERE mail = :mail");

        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':housenumber', $this->housenumber);
        $stmt->bindParam(':postal', $this->postal);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':birthday', $this->birthday);
        $stmt->bindParam(':question_1', $this->question_1);
        $stmt->bindParam(':question_2', $this->question_2);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':conditions', $this->conditions);
        $stmt->bindParam(':marketing', $this->marketing);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}