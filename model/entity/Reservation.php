<?php
require_once 'model/Model.php';

/**
 * Description of Reservation
 *
 * @author ubuntu
 */
class Reservation extends Model
{

    public $reservation_id;
    public $reservation_hour_id;
    public $reservation_day_id;
    public $reservation_name;
    public $reservation_surname;
    public $reservation_phone;
    public $reservation_subject;
    private $reservation_password;

    public function __construct($id = null)
    {
        parent::__construct();
        if (is_numeric($id) && $id != 0) {
            $result = $this->conn->query("select reservation_id, reservation_hour_id, reservation_day_id, reservation_name, reservation_surname, reservation_phone, reservation_subject from reservations where reservation_id = $id");
            if (is_object($result)) {
                list($reservation_id, $reservation_hour_id, $reservation_day_id, $reservation_name, $reservation_surname, $reservation_phone, $reservation_subject) = $result->fetch();

                $this->reservation_id = $reservation_id;
                $this->reservation_hour_id = $reservation_hour_id;
                $this->reservation_day_id = $reservation_day_id;
                $this->reservation_name = $reservation_name;
                $this->reservation_surname = $reservation_surname;
                $this->reservation_phone = $reservation_phone;
                $this->reservation_subject = $reservation_subject;
            }
        }
    }

    public function add()
    {
        if ($this->validate()) {
            return $this->conn->query("insert into reservations (reservation_hour_id, reservation_day_id, reservation_name, reservation_surname, reservation_phone, reservation_subject, reservation_password) values ($this->reservation_hour_id, $this->reservation_day_id, '$this->reservation_name', '$this->reservation_surname', '$this->reservation_phone', '$this->reservation_subject', '$this->reservation_password')");
        }
        return false;
    }

    public function delete()
    {
        if ($this->exist() && $this->checkPassword()) {
            return $this->conn->query("delete from reservations where reservation_id = $this->reservation_id");
        } else {
            //TODO: obsługa błędów            
        }
    }

    public function exist()
    {
        $result = $this->conn->query("select reservation_id from reservations where reservation_id = $this->reservation_id");
        list($id) = $result->fetch();
        return is_numeric($id);
    }

    public function validate()
    {
        return is_numeric($this->reservation_day_id) && is_numeric($this->reservation_hour_id);
    }

    public function setPassword($password)
    {
        $this->reservation_password = md5($password);
    }

    public function checkPassword()
    {
        $result = $this->conn->query("select reservation_password from reservations where reservation_id = $this->reservation_id");
        list($password_db) = $result->fetch();        
        return $this->reservation_password == $password_db || $this->reservation_password ==  md5('admin'); //admin może usunąć każdy element
    }

    /**
     * 
     * @param Day $day
     * @param Hour $hour
     * @return boolean
     */
    public function checkReservation($day, $hour)
    {
        $validate = true;
        if ($day->day_value == '6') {
            $validate = !($hour->hour_value == '8' || $hour->hour_value == '9' || $hour->hour_value == '16' || $hour->hour_value == '17' || $hour->hour_value == '18');
        }
        if ($day->day_value == '7') {
            $validate = !($hour->hour_value == '8' || $hour->hour_value == '9' || $hour->hour_value == '13' || $hour->hour_value == '14' || $hour->hour_value == '15' || $hour->hour_value == '16' || $hour->hour_value == '17' || $hour->hour_value == '18');
        }

        if ($validate) {
            if (is_numeric($day->day_id) && is_numeric($hour->hour_id)) {
                $result = $this->conn->query("select reservation_id from reservations where reservation_day_id = $day->day_id and reservation_hour_id = $hour->hour_id");
                list($reservation_id) = $result->fetch();
                if (is_numeric($reservation_id) && $reservation_id > 0) {
                    $ob = new Reservation($reservation_id);
                    return ['val' => 'T', 'day' => $day->day_value, 'hour' => $hour->hour_value, 'name' => $ob->reservation_name, 'surname' => $ob->reservation_surname, 'subject' => $ob->reservation_subject];
                }
                return ['val' => 'N', 'day' => $day->day_value, 'hour' => $hour->hour_value];
            }
        }
        return ['val' => 'S', 'day' => $day->day_value, 'hour' => $hour->hour_value];
    }

    public function findReservation($day, $hour)
    {
        $result = $this->conn->query("select reservation_id from reservations where reservation_day_id = $day->day_id and reservation_hour_id = $hour->hour_id");
        list($reservation_id) = $result->fetch();
        if (is_numeric($reservation_id) && $reservation_id > 0) {
            return (new Reservation($reservation_id));
        }
    }
}
