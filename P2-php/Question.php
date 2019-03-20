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
?>
