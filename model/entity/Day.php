<?php
require_once 'model/Model.php';

/**
 * Description of Day
 *
 * @author ubuntu
 */
class Day extends Model
{

    public $day_id;
    public $day_value;

    public function __construct($id = null)
    {
        parent::__construct();

        if (is_numeric($id) && $id != 0) {
            $result = $this->conn->query("select day_id, day_value from days where day_id = $id");
            if (is_object($result)) {
                list($day_id, $day_value) = $result->fetch();

                $this->day_id = $day_id;
                $this->day_value = $day_value;
            }
        }
    }

    public function getDays()
    {
        $result = $this->conn->query("select day_id from days");
        if (is_object($result)) {
            foreach ($result->fetchAll() as $day) {
                $days[] = new Day($day['day_id']);
            }
        }
        return $days;
    }
    
    /**
     * 
     * @param int $day_value
     * @return Day/boolean
     */
    public function findDay($day_value){
        $result = $this->conn->query("select day_id from days where day_value = $day_value");
        list($day_id) = $result->fetch();
        return is_numeric($day_id) && $day_id != 0?  new Day($day_id):false;
    }
}
