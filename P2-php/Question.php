<?php
include 'Database.php';
/*******************************************************************************
 * Code for unanswered questions
 *******************************************************************************/
/**
 * Single row of the question table
 */
class Question {
    var $qid;
    var $name;
    var $class;
    var $question;
    function __construct($qid, $name, $class, $question) {
        $this->qid = $qid;
        $this->name = $name;
        $this->class = $class;
        $this->question = $question;
    }
    public function getQid() {
        return $this->qid;
    }
    public function getName() {
        return $this->name;
    }
    public function getClass() {
        return $this->class;
    }
    public function getQuestion() {
        return $this->question;
    }
}
/**
 * Function to select all unanswered questions from the database
 */
function selectUnanswered() {
    $db = new Database();
    $open = $db->open();
    $sql = "SELECT * FROM q_unanswered;";
    $queryRecords = pg_query($open, $sql) or die("error to fetch question data");
    $data = pg_fetch_all($queryRecords);
    $questions = array();
    if (!empty($data)) {
        for ($i=0; $i < count($data); $i++) {
            array_push($questions, new Question($data[$i]['qid'], $data[$i]['name'],
                $data[$i]['class'], $data[$i]['question']));
        }
    }
    pg_close($open);
    return $questions;
}
/**
 * Function to insert a single unanswered question in to the database
 */
function insertUnanswered($name, $class, $question) {
    do {
        $unique = True;
        $qid = random_int (1, 999999);
        $questions = selectUnanswered();
        $answers = selectAnswered();
        $all = array_merge($questions, $answers);
        for ($i=0; $i < count($all); $i++) {
            if ($all[$i]->getQid() == $qid) {
                $unique = False;
            }
        }
    } while ($unique == False);
    $db = new Database();
    $open = $db->open();
    $sqlInsert = "INSERT INTO q_unanswered VALUES " . "(" . $qid . ", '" .
        $name . "', '" . $class . "', '" . $question . "');";
    $result = pg_query($open, $sqlInsert);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
/**
 * Function to delete a single unanswered question in the database
 */
function deleteUnanswered($qid) {
    $db = new Database();
    $open = $db->open();
    $sqlDelete = "DELETE FROM q_unanswered WHERE q_unanswered.qid = " . $qid . ";";
    $result = pg_query($open, $sqlDelete);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
/*******************************************************************************
 * Code for answered questions
 *******************************************************************************/
/**
 * Single row of the answered question table
 */
class Answered extends Question {
    var $answer;
    function __construct($qid, $name, $class, $question, $answer) {
        $this->qid = $qid;
        $this->name = $name;
        $this->class = $class;
        $this->question = $question;
        $this->answer = $answer;
    }
    public function getAnswer() {
        return $this->answer;
    }
}
/**
 * Function to select all answered questions from the database
 */
function selectAnswered() {
    $db = new Database();
    $open = $db->open();
    $sql = "SELECT * FROM q_answered";
    $queryRecords = pg_query($open, $sql) or die("error to fetch answer data");
    $data = pg_fetch_all($queryRecords);
    $answers = array();
    if (!empty($data)) {
        for ($i=0; $i < count($data); $i++) {
            array_push($answers, new Answered($data[$i]['qid'], $data[$i]['name'],
                $data[$i]['class'], $data[$i]['question'], $data[$i]['answer']));
        }
    }
    pg_close($open);
    return $answers;
}
/**
 * Function to insert a single answered question in to the database
 */
function insertAnswered($qid, $name, $class, $question, $answer) {
    $db = new Database();
    $open = $db->open();
    $sqlInsert = "INSERT INTO q_answered VALUES " . "(" . $qid . ", '" .
        $name . "', '" . $class . "', '" . $question . "', '" . $answer . "');";
    $result = pg_query($open, $sqlInsert);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
/**
 * Function to delete a single answered question in the database
 */
function deleteAnswered($qid) {
    $db = new Database();
    $open = $db->open();
    $sqlDelete = "DELETE FROM q_answered WHERE q_answered.qid = " . $qid . ";";
    $result = pg_query($open, $sqlDelete);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
/**
 * Code for Swap
 */
class ta_swap {
    var $sid;
    var $name;
    var $absent;
    var $day;
    var $hours;
    var $course;
    
    function __construct($sid, $name, $absent, $day, $hours, $course) {
        $this->sid = $sid;
        $this->name = $name;
        $this->absent = $absent;
        $this->day = $day;
        $this->hours = $hours;
        $this->course = $course;
    }
    
    public function getSid() {
        return $this->sid;
    }
    
    public function getTAName() {
        return $this->name;
    }
    
    public function getAbsentName() {
        return $this->absent;
    }
    
    public function getDay() {
        return $this->day;
    }
    
    public function getHours() {
        return $this->hours;
    }
    
    public function getCourse() {
        return $this->course;
    }
}
function selectSwaps() {
    $db = new Database();
    $open = $db->open();
    $sql = "SELECT * FROM swap;";
    $queryRecords = pg_query($open, $sql) or die("error to fetch swap data");
    $data = pg_fetch_all($queryRecords);
    $swaps = array();
    if (!empty($data)) {
        for ($i=0; $i < count($data); $i++) {
            array_push($swaps, new ta_swap($data[$i]['sid'], $data[$i]['ta_name'],
                $data[$i]['absent_name'], $data[$i]['date'], $data[$i]['hours'],
                $data[$i]['course_name']));
        }
    }
    pg_close($open);
    return $swaps;
}
function insertSwap($name, $absent, $day, $hours, $course) {
    
    do {
        $unique = True;
        $sid = random_int (1, 999999);
        $swaps = selectSwaps();
        for ($i=0; $i < count($swaps); $i++) {
            if ($swaps[$i]->getSid() == $sid) {
                $unique = False;
            }
        }
    } while ($unique == False);
    
    $db = new Database();
    $open = $db->open();
    $sqlInsert = "INSERT INTO swap VALUES " . "(" . $sid . ", '" .
        $name . "', '" . $absent . "', '" . $day . "', '" . $hours . "', '" . $course . "');";
    $result = pg_query($open, $sqlInsert);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
function deleteSwap($sid) {
    $db = new Database();
    $open = $db->open();
    $sqlDelete = "DELETE FROM swap WHERE swap.sid = " . $sid . ";";
    $result = pg_query($open, $sqlDelete);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
class ta_onboard {
    var $tid;
    var $name;
    var $hoursMon;
    var $hoursTues;
    var $hoursWed;
    var $hoursThur;
    var $hoursFri;
    var $hoursSat;
    var $hoursSun;
    var $courses;
    var $hoursPerWeek;
    
    function __construct ($tid, $name, $hoursMon, $hoursTues, $hoursWed,
            $hoursThur, $hoursFri, $hoursSat, $hoursSun, $courses, $hoursPerWeek) {
        $this->tid = $tid;
        $this->name = $name;
        $this->hoursMon = $hoursMon;
        $this->hoursTues = $hoursTues;
        $this->hoursWed = $hoursWed;
        $this->hoursThur = $hoursThur;
        $this->hoursFri = $hoursFri;
        $this->hoursSat = $hoursSat;
        $this->hoursSun = $hoursSun;
        $this->courses = $courses;
        $this->hoursPerWeek = $hoursPerWeek;
    }
    
    public function getTID() {
        return $this->tid;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getMondayHours() {
        return $this->hoursMon;
    }
    
    public function getTuesdayHours() {
        return $this->hoursTues;
    }
    
    public function getWednesdayHours() {
        return $this->hoursWed;
    }
    
    public function getThursdayHours() {
        return $this->hoursThur;
    }
    
    public function getFridayHours() {
        return $this->hoursFri;
    }
    
    public function getSaturdayHours() {
        return $this->hoursSat;
    }
    
    public function getSundayHours() {
        return $this->hoursSun;
    }
    
    public function getCourses() {
        return $this->courses;
    }
    
    public function getHoursPerWeek() {
        return $this->hoursPerWeek;
    }
}
function selectTAs() {
    $db = new Database();
    $open = $db->open();
    $sql = "SELECT * FROM ta_onboard;";
    $queryRecords = pg_query($open, $sql) or die("error to fetch swap data");
    $data = pg_fetch_all($queryRecords);
    $tas = array();
    if (!empty($data)) {
        for ($i=0; $i < count($data); $i++) {
            array_push($tas, new ta_onboard($data[$i]['tid'], $data[$i]['name'],
                $data[$i]['monday'], $data[$i]['tuesday'], $data[$i]['wednesday'],
                $data[$i]['thursday'], $data[$i]['friday'], $data[$i]['saturday'],
                $data[$i]['sunday'], $data[$i]['class'], $data[$i]['hoursperweek']));
        }
    }
    pg_close($open);
    
    return $tas;
}
function insertTA($name, $hoursMon, $hoursTues, $hoursWed, $hoursThur, $hoursFri, 
        $hoursSat, $hoursSun, $courses, $hoursPerWeek) {
    do {
        $unique = True;
        $tid = random_int (1, 999999);
        $tas = selectTAs();
        for ($i=0; $i < count($tas); $i++) {
            if ($tas[$i]->getTID() == $tid) {
                $unique = False;
            }
        }
    } while ($unique == False);
    
    $db = new Database();
    $open = $db->open();
    $sqlInsert = "INSERT INTO ta_onboard VALUES " . "(" . $tid . ", '" .
        $name . "', '" . $hoursMon . "', '" . $hoursTues . "', '" . $hoursWed . "', '" . $hoursThur . "', '" . 
            $hoursFri . "', '" . $hoursSat . "', '" . $hoursSun . "', '" . $courses . "', " . 
            $hoursPerWeek . ");";
    $result = pg_query($open, $sqlInsert);
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    pg_close($open);
}
function deleteTA($tid) {
    $db = new Database();
    $open = $db->open();
    $sqlTADelete = "DELETE FROM ta_onboard WHERE ta_onboard.tid = " . $tid . ";";
    
    $result = pg_query($open, $sqlTADelete);
    
    if (!$result) {
        $error = pg_last_error();
        echo "Error with query: " . $error;
        exit();
    }
    
    pg_close($open);
}
function getSchedule() {
    $db = new Database();
    $open = $db->open();
    
    $sqlSchedule = "SELECT * FROM schedule";
    $querySchedule = pg_query($open, $sqlSchedule);
    $schedule = pg_fetch_all($querySchedule);
    
    pg_close($open);
    
    return $schedule;
}
function insert35Schedule($sun, $mon, $tues, $wed, $thur, $fri, $sat) {
    $db = new Database();
    $open = $db->open();
    
    $sqlDelete = "DELETE FROM schedule WHERE shifttime = '3:00-5:00pm';";
    pg_query($open, $sqlDelete);
    
    $sqlInsert = "INSERT INTO schedule VALUES ('3:00-5:00pm', '" . $sun . "', "
            . "'" . $mon . "', '" . $tues . "', '" . $wed . "', '" . $thur . "', "
            . "'" . $fri . "', '" . $sat . "');";
    
    pg_query($open, $sqlInsert) or die("Error with inserting 3-5 " . pg_last_error());
    
    pg_close();
}
function insert57Schedule($sun, $mon, $tues, $wed, $thur, $fri, $sat) {
    $db = new Database();
    $open = $db->open();
    
    $sqlDelete = "DELETE FROM schedule WHERE shifttime = '5:00-7:00pm';";
    pg_query($open, $sqlDelete);
    
    $sqlInsert = "INSERT INTO schedule VALUES ('5:00-7:00pm', '" . $sun . "', "
            . "'" . $mon . "', '" . $tues . "', '" . $wed . "', '" . $thur . "', "
            . "'" . $fri . "', '" . $sat . "');";
    
    pg_query($open, $sqlInsert) or die("Error with inserting 5-7 " . pg_last_error());
    
    pg_close();
}
function insert79Schedule($sun, $mon, $tues, $wed, $thur, $fri, $sat) {
    $db = new Database();
    $open = $db->open();
    
    $sqlDelete = "DELETE FROM schedule WHERE shifttime = '7:00-9:00pm';";
    pg_query($open, $sqlDelete);
    
    $sqlInsert = "INSERT INTO schedule VALUES ('7:00-9:00pm', '" . $sun . "', "
            . "'" . $mon . "', '" . $tues . "', '" . $wed . "', '" . $thur . "', "
            . "'" . $fri . "', '" . $sat . "');";
    
    pg_query($open, $sqlInsert) or die("Error with inserting 7-9 " . pg_last_error());
    
    pg_close();
}
function insert911Schedule($sun, $mon, $tues, $wed, $thur, $fri, $sat) {
    $db = new Database();
    $open = $db->open();
    
    $sqlDelete = "DELETE FROM schedule WHERE shifttime = '9:00-11:00pm';";
    pg_query($open, $sqlDelete);
    
    $sqlInsert = "INSERT INTO schedule VALUES ('9:00-11:00pm', '" . $sun . "', "
            . "'" . $mon . "', '" . $tues . "', '" . $wed . "', '" . $thur . "', "
            . "'" . $fri . "', '" . $sat . "');";
    
    pg_query($open, $sqlInsert) or die("Error with inserting 9-11 " . pg_last_error());
    
    pg_close();
}
?>
