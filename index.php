<?php ?>

<!DOCTYPE html>

<html lang="es">

    <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


        <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
        <script src='fullcalendar/lib/jquery.min.js'></script>
        <script src='fullcalendar/lib/moment.min.js'></script>
        <script src='fullcalendar/fullcalendar.js'></script>




        <script>
            $(document).ready(function () {

                var calendar = $('#calendar').fullCalendar({

                    editable: true,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'

                    },

                    events: 'load.php',
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay)
                    {
                        var title = prompt("Enter Event Title");
                        if (title) {

                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                            $.ajax({

                                url: "insert.php",
                                type: "POST",
                                data: {title: title, start: start, end: end},
                                success: function ()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Add Successfully");
                                }

                            })
                        }
                    },

                    editable: true,
                    eventResize: function (event)
                    {

                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                        var title = event.title;
                        var id = event.id;

                        $.ajax({

                            url: "update.php",
                            type: "POST",
                            data: {title: title, start: start, end: end, id: id},

                            success: function () {

                                calendar.fullCalendar('refetchEvents');
                                alert("Event Update");

                            }



                        })

                    },

                    eventDrop: function(event) {

                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                        var title = event.title;
                        var id = event.id;

                        $.ajax({
                            url: "update.php",
                            type: "POST",
                            data: {title: title, start: start, end: end, id: id},

                            success: function () {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Update");

                            }



                        })

                    },
                    
                    eventClick:function(event)
                    {
                        if (confirm("Are you sure you want to remove it?")) {
                            var id= event.id;
                            $.ajax({
                                url:"delete.php",
                                type:"POST",
                                data:{id:id},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Remove event");
                                }
                            })
                        }
                    }

                });
            });

        </script>    

    </head>
    <body>

        <h2 align="center"> <a href="#"> jquery Full Calandar Integration with PHP and Mysql</a> </h2>
        <br />
        <div class="container">
            <div id="calendar"></div>
        </div>  

    </body>
</html>