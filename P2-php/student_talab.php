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
            <h1>The TA Lab</h1>
        </div>

        <?php include("student_nav.html"); ?>
        
        <?php include ("Question.php") ?>
        
        <?php $schedule = getSchedule(); ?>

        <div class="table-responsive">
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
                        <td><?php echo $schedule[0][shifttime] ?></td>
                        <td><?php echo $schedule[0][sundayhours] ?></td>
                        <td><?php echo $schedule[0][mondayhours] ?></td>
                        <td><?php echo $schedule[0][tuesdayhours] ?></td>
                        <td><?php echo $schedule[0][wednesdayhours] ?></td>
                        <td><?php echo $schedule[0][thursdayhours] ?></td>
                        <td><?php echo $schedule[0][fridayhours] ?></td>
                        <td><?php echo $schedule[0][saturdayhours] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $schedule[1][shifttime] ?></td>
                        <td><?php echo $schedule[1][sundayhours] ?></td>
                        <td><?php echo $schedule[1][mondayhours] ?></td>
                        <td><?php echo $schedule[1][tuesdayhours] ?></td>
                        <td><?php echo $schedule[1][wednesdayhours] ?></td>
                        <td><?php echo $schedule[1][thursdayhours] ?></td>
                        <td><?php echo $schedule[1][fridayhours] ?></td>
                        <td><?php echo $schedule[1][saturdayhours] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $schedule[2][shifttime] ?></td>
                        <td><?php echo $schedule[2][sundayhours] ?></td>
                        <td><?php echo $schedule[2][mondayhours] ?></td>
                        <td><?php echo $schedule[2][tuesdayhours] ?></td>
                        <td><?php echo $schedule[2][wednesdayhours] ?></td>
                        <td><?php echo $schedule[2][thursdayhours] ?></td>
                        <td><?php echo $schedule[2][fridayhours] ?></td>
                        <td><?php echo $schedule[2][saturdayhours] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $schedule[3][shifttime] ?></td>
                        <td><?php echo $schedule[3][sundayhours] ?></td>
                        <td><?php echo $schedule[3][mondayhours] ?></td>
                        <td><?php echo $schedule[3][tuesdayhours] ?></td>
                        <td><?php echo $schedule[3][wednesdayhours] ?></td>
                        <td><?php echo $schedule[3][thursdayhours] ?></td>
                        <td><?php echo $schedule[3][fridayhours] ?></td>
                        <td><?php echo $schedule[3][saturdayhours] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container" style="background-color: RebeccaPurple; color: white">
            <div class="row">
                <div class="col border border-dark">
                    <h5>What is the TA Lab used for?</h5>
                    <p>The TA Lab is an educational setting where students can ask
                        questions if they are having trouble on an assignment. The
                        point of the TA Lab isn't always just to solve everyone's
                        problems, because then students may not learn how to mitigate
                        the solution from occuring again. Because of this, TA's often
                        will try to lead the student to the designated answer to the
                        problem instead of simply just explaining to the student what
                        to do differently. This mentality enforces an educational
                        setting where students are learning why they are stuck, and
                        how to approach the problem differently to get to the
                        designated answer. Also the hope is that students will
                        always be learning from their mistakes, and will not make
                        the same mistakes on upcoming assignments and tests.</p>
                </div>
                <div class="col border border-dark">
                    <img src="img/TAHours.jpg" alt="TA Hours" class="mx-auto d-block img-fluid">
                </div>
            </div>
            <div class="row">
                <div class="col  border border-dark">
                    <h5>How do I get to this educational location?</h5>
                    <ol>
                        <li>Walk in the front doors of ISAT</li>
                        <li>Walk up the stairwell to the left after walking in</li>
                        <li>At the second level, turn left, and walk down the main corridor</li>
                        <li>Take the first hallway to your right when walking down this main corridor</li>
                        <li>That hallway is the same hallway in the picture below</li>
                        <li>The room will be the second door on the right, LAB 250</li>
                    </ol>
                </div>
                <div class="col border border-dark">
                    <img src="img/TALocation.jpg" alt="TA Location" class="mx-auto d-block img-fluid">
                </div>
            </div>
        </div>
    </body>
</html>
