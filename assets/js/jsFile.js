$(document).ready(function () {

    $('#attendanceTable').DataTable();
    $('#employeesTable').DataTable();

    setTimeout(function () {
        $('#success').hide();
    }, 5000);

    setInterval(function () {
        displayCurrDateTime();
    }, 1000);

    function checkPositiveInteger(evt) {
        if (!((evt.keyCode > 95 && evt.keyCode < 106) || (evt.keyCode > 47 && evt.keyCode < 58) || evt.keyCode == 8)) {
            return false;
        }
    }

    $('#empDesignation').on('change', function () {
        if (this.value == "ceo") {
            $('#empBoss').attr("disabled", true);
        } else {
            $('#empBoss').attr("disabled", false);
        }

    });

    function displayCurrDateTime() {
        var today = new Date();
        var date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
        var time = today.getHours() + " : " + today.getMinutes() + " : " + today.getSeconds();
        document.getElementById('currDateTime').innerHTML = "Date: " + date + '<br>' + 'Time: ' + time;
    }
});

function deleteConfirmation(id) {
    var answer = confirm("Are you sure you want to delete this employee?");
    if (answer == true) {
        window.location.href = "index.php?action=deleteEmployee&id=" + id;
    } else {
        window.location.href = "allEmployees.php";
    }
}

function markTime(id) {
    var today = new Date();
    if (today.getHours() < 10) {
        var hours = "0" + today.getHours();
    } else {
        var hours = today.getHours();
    }
    if (today.getMinutes() < 10) {
        var minutes = "0" + today.getMinutes();
    } else {
        var minutes = today.getMinutes();
    }
    if (today.getSeconds() < 10) {
        var secs = "0" + today.getSeconds();
    } else {
        var secs = today.getSeconds();
    }
    time = hours + ":" + minutes + ":" + secs;
    $(id).val(time);
    $(id + "Btn").prop("disabled", true);
}
