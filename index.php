<?php include './rc.php' ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Config Reader Demo</title>
        <link href='styles/main.css' type='text/css' rel='stylesheet'>
        <script src='https://code.jquery.com/jquery-3.0.0.min.js'></script>
        <script src='scripts/rc.js'></script>
        
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class='container'>
            
            <div class='page-header'><h1>Influx Brands Code Challenge</h1>
                <small>crafted by Bill Carson</small>
            </div>
            <div class='panel panel-default'></div>
                <div class='panel-heading'>
                    <div class='panel-title'><h2>Available Settings</h2></div>
                </div>
                <div class='panel-body'>
                    <form id='paramForm' action='./rc.php?a=getParam' method=POST>
                        <select name=p>
                            <option>---</option>
                            <?php getParamNames();?>
                        </select>
                        <button type="button" onclick='clearOutput();'>Clear output</button>
                    </form>
                    
                    <div id='output'></div>
                </div>
            </div>
        </div>
    </body>
</html>