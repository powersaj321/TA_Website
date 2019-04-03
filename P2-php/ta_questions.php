<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>TA Lab</title>
    </head>
    <body>
        <?php include 'Question.php'; ?>

        <div id="title" class="jumbotron text-center mb-0">
            <h1>Unanswered Questions</h1>
        </div>

        <?php include("ta_nav.html"); ?>
        <?php $questions = selectUnanswered(); ?>

        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-secondary">
                    <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($i=0; $i < count($questions); $i++) {
                                echo "<tr><form action='ta_questions.php' method='get'>";
                                echo "<td><input class='form-control' type='text' name='qid' value='" . $questions[$i]->getQid() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='name' value='" . $questions[$i]->getName() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='class' value='" . $questions[$i]->getClass() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='textarea' name='question' value='" . $questions[$i]->getQuestion() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='textarea' name='answer' value='' ></td>";
                                echo "<td><div class='btn-group'><input class='btn btn-primary btn-xs' name='insertAnswer' type='submit' value='Answer'></div></td>";
                                echo "<td><div class='btn-group'><input class='btn btn-danger btn-xs' name='deleteQuestion' type='submit' value='Delete'></div></td>";
                                echo "</form></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            if (isset($_GET['insertAnswer'])) {
                insertAnswered($_GET['qid'], $_GET['name'], $_GET['class'], $_GET['question'], $_GET['answer']);
                deleteUnanswered($_GET['qid']);
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=ta_questions.php\">";
            }

            if (isset($_GET['deleteQuestion'])) {
                deleteUnanswered($_GET['qid']);
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=ta_questions.php\">";
            }
        ?>
    </body>
</html>
