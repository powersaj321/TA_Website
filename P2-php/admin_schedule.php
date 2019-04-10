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
            <h1>Schedule Semester</h1>
        </div>

        <?php include("admin_nav.html"); ?>
        <?php include("Question.php"); ?>
        
        <?php
            if (isset($_GET['deleteQuestion'])) {
                deleteTA($_GET['tid']);
            }
            
            if (isset($_POST['submit_schedule'])) {
                insert35Schedule($_POST['sunday35'], $_POST['monday35'], $_POST['tuesday35'], 
                        $_POST['wednesday35'], $_POST['thursday35'], $_POST['friday35'], $_POST['saturday35']);
                insert57Schedule($_POST['sunday57'], $_POST['monday57'], $_POST['tuesday57'], 
                        $_POST['wednesday57'], $_POST['thursday57'], $_POST['friday57'], $_POST['saturday57']);
                insert79Schedule($_POST['sunday79'], $_POST['monday79'], $_POST['tuesday79'], 
                        $_POST['wednesday79'], $_POST['thursday79'], $_POST['friday79'], $_POST['saturday79']);
                insert911Schedule($_POST['sunday911'], $_POST['monday911'], $_POST['tuesday911'], 
                        $_POST['wednesday911'], $_POST['thursday911'], $_POST['friday911'], $_POST['saturday911']);
            }
        ?>

        <div class="table-responsive">
            <form id="scheduleForm" class="" action="admin_schedule.php" method="post">
                <table class="table table-bordered table-hover table-secondary">
                    <thead>
                        <tr>
                            <th>TA Hours</th>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3:00pm - 5:00pm</td>
                            <td><textarea class="form-control" name="sunday35"></textarea></td>
                            <td><textarea class="form-control" name="monday35"></textarea></td>
                            <td><textarea class="form-control" name="tuesday35"></textarea></td>
                            <td><textarea class="form-control" name="wednesday35"></textarea></td>
                            <td><textarea class="form-control" name="thursday35"></textarea></td>
                            <td><textarea class="form-control" name="friday35"></textarea></td>
                            <td><textarea class="form-control" name="saturday35"></textarea></td>
                        </tr>
                        <tr>
                            <td>5:00pm - 7:00pm</td>
                            <td><textarea class="form-control" name="sunday57"></textarea></td>
                            <td><textarea class="form-control" name="monday57"></textarea></td>
                            <td><textarea class="form-control" name="tuesday57"></textarea></td>
                            <td><textarea class="form-control" name="wednesday57"></textarea></td>
                            <td><textarea class="form-control" name="thursday57"></textarea></td>
                            <td><textarea class="form-control" name="friday57"></textarea></td>
                            <td><textarea class="form-control" name="saturday57"></textarea></td>
                        </tr>
                        <tr>
                            <td>7:00pm - 9:00pm</td>
                            <td><textarea class="form-control" name="sunday79"></textarea></td>
                            <td><textarea class="form-control" name="monday79"></textarea></td>
                            <td><textarea class="form-control" name="tuesday79"></textarea></td>
                            <td><textarea class="form-control" name="wednesday79"></textarea></td>
                            <td><textarea class="form-control" name="thursday79"></textarea></td>
                            <td><textarea class="form-control" name="friday79"></textarea></td>
                            <td><textarea class="form-control" name="saturday79"></textarea></td>
                        </tr>
                        <tr>
                            <td>9:00pm - 11:00pm</td>
                            <td><textarea class="form-control" name="sunday911"></textarea></td>
                            <td><textarea class="form-control" name="monday911"></textarea></td>
                            <td><textarea class="form-control" name="tuesday911"></textarea></td>
                            <td><textarea class="form-control" name="wednesday911"></textarea></td>
                            <td><textarea class="form-control" name="thursday911"></textarea></td>
                            <td><textarea class="form-control" name="friday911"></textarea></td>
                            <td><textarea class="form-control" name="saturday911"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <input class="btn btn-primary" type="submit" name="submit_schedule" value="Submit">
                </div>
            </form>
        </div>
        <br>
        <?php $tas = selectTAs(); ?>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-secondary">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>TA Name</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                        <th>Courses</th>
                        <th>Weekly Hours</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        for ($i=0; $i < count($tas); $i++) {
                                echo "<tr><form action='admin_schedule.php' method='get'>";
                                echo "<td><input class='form-control' type='text' name='tid' value='" . $tas[$i]->getTID() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='name' value='" . $tas[$i]->getName() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getMondayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getTuesdayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getWednesdayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getThursdayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getFridayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getSaturdayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getSundayHours() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getCourses() . "' readonly='readonly'></td>";
                                echo "<td><input class='form-control' type='text' name='monday' value='" . $tas[$i]->getHoursPerWeek() . "' readonly='readonly'></td>";
                                echo "<td><div class='btn-group'><input class='btn btn-danger btn-xs' name='deleteQuestion' type='submit' value='Delete'></div></td>";
                                echo "</form></tr>";
                            }
                    ?>
                </tbody>
            </table>
        </div>
        
    </body>
</html>
