<?php
include '../Scripts/loggout.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Full Calendar Example</title>
    <link rel="shortcut icon" type="image/c-icon" href="https://image.flaticon.com/icons/svg/4/4430.svg"/>

    <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
    <script src="src/firebaseInit.js"></script>

    <!-- update the version number as needed -->
    <script defer src="/__/firebase/5.8.2/firebase-app.js"></script>
    <!-- include only the Firebase features as you need -->
    <script defer src="/__/firebase/5.8.2/firebase-auth.js"></script>
    <script defer src="/__/firebase/5.8.2/firebase-database.js"></script>
    <script defer src="/__/firebase/5.8.2/firebase-messaging.js"></script>
    <script defer src="/__/firebase/5.8.2/firebase-storage.js"></script>
    <!-- initialize the SDK after all desired features are loaded -->
    <script defer src="/__/firebase/init.js"></script>

    <!-- BootStrap CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://fullcalendar.io/releases/fullcalendar/3.10.0/lib/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Momentjs -->
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.0/lib/moment.min.js'></script>

    <!-- Full Calendar CDN -->
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.0/fullcalendar.min.js'></script>
    <link rel="stylesheet" href="https://fullcalendar.io/releases/fullcalendar/3.10.0/fullcalendar.min.css">

    <!-- Timepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/timepicker@1.11.14/jquery.timepicker.css">
    <script src='https://cdn.jsdelivr.net/npm/timepicker@1.11.14/jquery.timepicker.min.js'></script>

    <!-- Datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!--datepair -->
    <script src="https://cdn.bootcss.com/datepair.js/0.4.16/datepair.js"></script>
    <script src="https://cdn.bootcss.com/datepair.js/0.4.16/jquery.datepair.js"></script>

    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">

    <!--Code-->
    <script src="src/calendar.js"></script>


</head>
<body background="https://images.wallpaperscraft.com/image/glare_circles_bokeh_124684_1920x1080.jpg">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Full Calendar Example</a>
    </nav>
    <div class="">
        <div class="mr-3 ml-3 mt-3 p-3 border bg-light">
            <div class="p-3">
                <div class="row ">
                    <div class="w-50">
                        <div id="cal"></div>
                    </div>
                    <div class="w-50">
                        <div class="ml-3 border h-100">
                            <div class="p-3">
                                <div class="container">
                                    <div class="alert alert-warning invisible" role="alert">
                                        Please Enter All Fields to submit appointment
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input id="name" class="form-control" type="text" placeholder="Enter Name" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input class="form-control" id="date" type="text" placeholder="Enter date" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Time</label>
                                            <div id="timePair" class="input-group">
                                                <input class="form-control time start" type="text" placeholder="Enter time" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">to</span>
                                                </div>
                                                <input class=" form-control time end" type="text" value="" readonly/>
                                            </div>
                                            <small id="emailHelp" class="form-text text-muted">The duration of an appointment can only be to an hour.</small>
                                        </div>
                                        <div class="form-group">
                                            <button id="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
