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
        <div id="title" class="jumbotron text-center mb-0">
            <h1>Onboard TA</h1>
        </div>
        <?php include("Question.php"); ?>
        <?php include("ta_nav.html"); ?>

        <div class="container pt-3">
            <form id="questionform" class="" action="ta_onboard.php" method="get">
                <div class="form-group">
                    <label for="name">TA Name:</label><br>
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <label for="monday">Preferred Monday Hours:</label><br>
                    <input type="text" class="form-control" name="monday" value="">
                </div>
                <div class="form-group">
                    <label for="tuesday">Preferred Tuesday Hours:</label><br>
                    <input type="text" class="form-control" name="tuesday" value="">
                </div>
                <div class="form-group">
                    <label for="wednesday">Preferred Wednesday Hours:</label><br>
                    <input type="text" class="form-control" name="wednesday" value="">
                </div>
                <div class="form-group">
                    <label for="thursday">Preferred Thursday Hours:</label><br>
                    <input type="text" class="form-control" name="thursday" value="">
                </div>
                <div class="form-group">
                    <label for="friday">Preferred Friday Hours:</label><br>
                    <input type="text" class="form-control" name="friday" value="">
                </div>
                <div class="form-group">
                    <label for="saturday">Preferred Saturday Hours:</label><br>
                    <input type="text" class="form-control" name="saturday" value="">
                </div>
                <div class="form-group">
                    <label for="sunday">Preferred Sunday Hours:</label><br>
                    <input type="text" class="form-control" name="sunday" value="">
                </div>
                <div class="form-group">
                    <label for="courses">Preferred Courses:</label><br>
                    <input type="text" class="form-control" name="courses" value="">
                </div>
                <div class="form-group">
                    <label for="hours">Preferred Hours/Week:</label>
                    <input type="text" class="form-control" name="hours" value="">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="onboard" value="Submit">
                </div>
            </form>
        </div>
        <?php
            if (isset($_GET['onboard'])) {
                insertTA($_GET['name'], $_GET['monday'], $_GET['tuesday'], 
                        $_GET['wednesday'], $_GET['thursday'], $_GET['friday'],
                        $_GET['saturday'], $_GET['sunday'], $_GET['courses'],
                        $_GET['hours']);
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=ta_onboard.php\">";
            }
        ?>
    </body>
</html>
