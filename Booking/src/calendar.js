$(document).ready(function() {


    var ref = firebase.database().ref("Appointments/");
    $('#cal').fullCalendar({
        themeSystem: 'bootstrap4',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        timezone: 'local',
        eventLimit: true, // allow "more" link when too many events
    });
    ref.once('value').then(function(snapshot){
        var dates = Object.keys(snapshot.val());
        for (var i = 0; i < dates.length; i++) {
            var appointments = Object.keys(snapshot.child(dates[i]).val());
            for (var j = 0; j < appointments.length; j++) {
                $('#cal').fullCalendar('addEventSource', [snapshot.child(dates[i] + "/" + appointments[j]).val()]);
            }
        }

        $("#timePair .time").timepicker({
            'showDuration': true,
            'timeFormat': 'g:ia'
        });
        // initialize datepair
        var basicExampleEl = document.getElementById("timePair");
        var datepair = new Datepair(basicExampleEl);
        console.log($('#timePair .time').datepair());
        $("#date").datepicker({
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        }).on('changeDate', function(){
            var date = new moment($(this).datepicker('getDate'));
            var timeRef = firebase.database().ref("Appointments/" + date);
            var disableTimes = new Array();
            timeRef.once("value").then(function(snapshot3){
                var apps = Object.keys(snapshot3.val());
                for (var i = 0; i < apps.length; i++) {
                    var start = new moment(snapshot3.child(apps[i]).val().start);
                    var end = new moment(snapshot3.child(apps[i]).val().end);
                    disableTimes.push([start.format('h') + start.format('a'), end.format('h') + end.format('a')]);
                    console.log(disableTimes);
                }
                $("#timePair .time").timepicker({'disableTimeRanges': disableTimes})
            });
        });
    });

    $("#submit").click(function(){
        var date = new moment($("#date").datepicker('getDate'));
        console.log(date.startOf('day').format("x"));
        console.log(time);
        var time = $('#timePair .start').timepicker('getSecondsFromMidnight') * 1000;
        var name = $("#name").val();
        if(name!="" && time !=null){
            firebase.database().ref("Appointments/" + date).push({
                title: name,
                start: date + time,
                end: date + time + 3600000
            });
            location.reload();
        }else {
            $(".alert").removeClass("invisible");
        }

    });
});
