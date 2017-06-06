<?php
require_once 'controller/Controller.php';
require_once 'model/entity/Day.php';
require_once 'model/entity/Hour.php';
require_once 'model/entity/Reservation.php';

/**
 * Description of Home
 *
 * @author ubuntu
 */
class Home extends Controller
{

    public $days_lib = [
        '1' => 'Poniedziałek',
        '2' => 'Wtorek',
        '3' => 'Środa',
        '4' => 'Czwartek',
        '5' => 'Piątek',
        '6' => 'Sobota',
        '7' => 'Niedziela'
    ];

    public function __construct()
    {
        parent::__construct('Home');
    }

    public function index()
    {
        $days = (new Day())->getDays();
        $hours = (new Hour())->getHours();

        $possible_reservations = false;

        foreach ($days as $day) {
            foreach ($hours as $hour) {
                $reservations[] = $this->checkPossibility($day, $hour);
            }
            $possible_reservations [$day->day_value] = $reservations;
            $reservations = null;
        }

        $this->sendToView($hours, 'hours');
        $this->sendToView($this->days_lib, 'days_lib');
        $this->sendToView($possible_reservations, 'possible_reservations');
        $this->render('index');
    }
    
    public function add($day, $hour){
        $this->sendToView($hour, 'hour');
        $this->sendToView($day, 'day');
        $this->sendToView($this->days_lib, 'days_lib');        
        $this->render('add');
        exit();
    }
    
    public function delete($day, $hour){        
        $this->sendToView($hour, 'hour');
        $this->sendToView($day, 'day');
        $this->sendToView($this->days_lib, 'days_lib'); 
        $this->render('delete');
        exit();
    }
    
    public function trash($day, $hour){
        $day = (new Day())->findDay($day);
        $hour = (new Hour())->findHour($hour);
        
        $ob = (new Reservation())->findReservation($day, $hour);
        $ob->setPassword($this->getPost('password'));
        if($ob->delete()){
            $this->render('index');
        }
    }
    
    public function save($day, $hour){
        $ob = new Reservation();
        $day = (new Day())->findDay($day);
        $hour = (new Hour())->findHour($hour);
        
        $ob->reservation_day_id = $day->day_id;
        $ob->reservation_hour_id = $hour->hour_id;
        $ob->reservation_name = $this->getPost('name');
        $ob->reservation_surname = $this->getPost('surname');
        $ob->reservation_phone = $this->getPost('phone');
        $ob->reservation_subject = $this->getPost('subject');
        $ob->setPassword($this->getPost('password'));
        
        if($ob->add()) {
            $this->render('index');
        } 
    }
    
    /**
     * 
     * @param Day $day
     * @param Hour $hour
     * @return boolean
     */
    function checkPossibility($day, $hour){
        return (new Reservation())->checkReservation($day, $hour);
    }
}
