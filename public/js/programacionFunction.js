$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        themeSystem: 'jquery-ui',
        editable: true,
        events: {
            url: '/programacion',
            method: 'get',
        },
        displayEventTime: true,
        defaultView: 'agendaWeek',
        scrollTime: "7:00:00",
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = "";
            var strMascota = "";
            var strPlan = "";
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            $('#programacionModal').modal('show');

            $('#saveProg').click(function (e) {

                var v1 = document.getElementById('masco');
                var v2 = document.getElementById('plan');
                if (v1.options[v1.selectedIndex].value == 0) {
                    alert('Seleccione la mascota');
                } else if (v2.options[v2.selectedIndex].value == 0) {
                    alert('Seleccione un plan');
                } else {
                    var strR = v1.options[v1.selectedIndex].value;
                    strMascota = strR.split(" ", 1).toString().split(" ", 1).toString();
                    var strP = v2.options[v2.selectedIndex].value;
                    strPlan = strP.split(" ", 1).toString().split(" ", 1).toString();
                    title = strR.substr(strR.indexOf(' ') + 1) + '  -  ' + strP.substr(strP.indexOf(' ') + 1);
                }

                if (strMascota != "" || strMascota != 0 &&
                    strPlan != "" || strPlan != 0) {
                    $('#programacionModal').modal('hide');
                    var formData = new FormData();
                    formData.append('title', title);
                    formData.append('start', start);
                    formData.append('end', end);
                    formData.append('mascota_id', strMascota);
                    formData.append('plan_id', strPlan);
                    $.ajax({
                        url: '/programacion/store',
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        data: formData,
                        type: "POST",
                        success: function (data) {                            
                        }
                    });
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true
                    );
                }
            });
            calendar.fullCalendar('unselect');
        },

        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var formData = new FormData();
            formData.append('id', event.id);            
            formData.append('start', start);
            formData.append('end', end);
            $.ajax({
                url: '/programacion/update',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                type: "POST",
                success: function (response) {
                    displayMessage("Programacion Actualizada.!");
                }
            });
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Deseas eliminar el registro seleccionado?");
            if (deleteMsg) {
                var formData = new FormData();
                formData.append('id', event.id);
                $.ajax({
                    url: '/programacion/delete',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    type: "POST",
                    success: function (response) {
                        if (parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            alert("Registro Eliminado.");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
    $(".response").html("<div class='success'>" + message + "</div>");
    setInterval(function () { $(".success").fadeOut(); }, 1000);
}