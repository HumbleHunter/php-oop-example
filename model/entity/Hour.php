<?php
require_once 'model/Model.php';

/**
 * Description of Hour
 *
 * @author ubuntu
 */
class Hour extends Model
{

    public $hour_id;
    public $hour_value;

    public function __construct($id = null)
    {
        parent::__construct();

        if (is_numeric($id) && $id != 0) {
            $result = $this->conn->query("select hour_id, hour_value from hours where hour_id = $id");
            if (is_object($result)) {
                list($hour_id, $hour_value) = $result->fetch();

                $this->hour_id = $hour_id;
                $this->hour_value = $hour_value;
            }
        }
    }

    public function getHours()
    {
        $result = $this->conn->query("select hour_id from hours order by hour_value");
        if (is_object($result)) {
            foreach ($result->fetchAll() as $hour) {
                $hours[] = new Hour($hour['hour_id']);
            }
        }
        return $hours;
    }
    
    /**
     * 
     * @param type $hour_value
     * @return Hour/boolean
     */
    public function findHour($hour_value){
        $result = $this->conn->query("select hour_id from hours where hour_value = $hour_value");
        list($hour_id) = $result->fetch();
        return is_numeric($hour_id) && $hour_id != 0?  new Hour($hour_id):false;
    }
}
