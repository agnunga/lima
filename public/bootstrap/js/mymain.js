//Loading web content of the target of the url to the destined div
function loadTarget(targetdiv, thepage) {
    var page = thepage;
    $(targetdiv).load(page);
    return false;
}


//allerts that disappear after seconds
function faddingAllert(targetdiv, add_class, message) {
    $(targetdiv).addClass(add_class);
    $(targetdiv).removeClass("hidden");
    $(targetdiv).empty().append('<span class="close" data-dismiss="alert">&times;</span>' + message);
    window.setTimeout(function () {
        $(targetdiv).fadeTo(1500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3500);
}


//datepicker
$(function () {
    $("#off_start_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +1,
        showAnim: "slide",
        minDate: "+1d",
        maxDate: "+1y"
    });

    $("#apl_edate").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +7,
        showAnim: "slide",
        minDate: "+2d",
        maxDate: "+1m"
    });

    $("#off_end_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +2,
        showAnim: "slide",
        minDate: "+2d",
        maxDate: "+1y"
                /*          appendText: "(yy-mm-dd)",
                 changeMonth: true,
                 changeYear: true,
                 numberOfMonths: [3, 4],
                 altField: "",
                 altFormat: "DD, d MM, yy",
                 showWeek: true,
                 yearSuffix: "-CE",
                 showOn: "button",
                 buttonImage: "",
                 buttonImageOnly: true*/
    });

    $("#user_yob").datepicker({
        dateFormat: "yy-mm-dd",
        showAnim: "slide",
        minDate: "-35y",
        maxDate: "-18y",
        changeYear: true
    });

    $("#qual_aqcuired_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: -1,
        showAnim: "slide",
        minDate: "-10y",
        maxDate: "-1d",
        changeYear: true
    });


//in the request_workers_form
    $("#work_start_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +2,
        showAnim: "slide",
        minDate: "+2d",
        maxDate: "+1m"
    });

//in the request_workers_form
    $("#work_end_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +3,
        showAnim: "slide",
        minDate: "+3d",
        maxDate: "+1y"
    });
    $("#alo_s_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +2,
        showAnim: "slide",
        minDate: "+1d",
        maxDate: "+1m"
    });
    $("#alo_e_date").datepicker({
        dateFormat: "yy-mm-dd",
        defaultDate: +3,
        showAnim: "slide",
        minDate: "+7d",
        maxDate: "+1y"
    });
//
});


//Modals
//function showtheModal(clickedid, targetdiv){
$(document).ready(function () {
    $('#open_edit_man_modal').click(function () {
        $('#modal_edit_man').modal();
    });

    $("#new_user_reg_modal").click(function () {
        $("#new_user_registration").modal();
    });

});


//Metismenu calls
$(function () {
    $('#menu').metisMenu({toggle: false});
});


//Ajax add a form to the employee.php , profile, eddit profile
function getAddQForm() {
    var xhr = false;
    var targetdiv = document.getElementById("display_tab_items");

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();

    } else {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {

            }
        }
    }
    if (xhr) {
        var requesterd_page = "../forms/add_qualifications_form.php";
        xhr.onreadystatechange = getRequestResults;
        xhr.open("POST", requesterd_page, true);
        xhr.send();
    }
    function getRequestResults() {

        if (xhr.readyState == 4 && xhr.status == 200) {

            //                targetdiv.innerHTML = "went thru  = " + xhr.readyState  +" Status  = " + xhr.status  +"And Text <br/>"  + xhr.responseText;

            targetdiv.innerHTML = xhr.responseText;
        } else {

            targetdiv.innerHTML = "Problem readyState  = " + xhr.readyState + " Status  = " + xhr.status + " Response Text  = " + xhr.responseText;
        }
    }
}




//Reload a file containing some dynamic data Load a page after some time
function autoRefresh(targedDiv, file, time_interval) {
    setInterval(function () {
        $(targedDiv).load(file);
    }, time_interval);
}

//For home action to send the position applying for and the id of the advert to the database
function sendId(pos, id) {
    $('#m_pos').empty().append(pos);
    document.getElementById('m_id').value = id;
}
$(document).on('click', '#btn_to_view_applicants_modal', function () {
    var adv_id = $('#m_id').val();
//    alert(adv_id);

    // example of passing variable 'name' to server-script for session-data-storage
    $.post("../includes/light_session.php", {padv_id: adv_id}, function () {
//        alert("resultsresults"+results); // alerts 'Updated'

    });

//    $.ajax({
//        url: "view_applicants_modal.php",
//        method: "POST",
//        data: {adv_id: adv_id},
//        dataType: "text",
//        success: function (data) {
//            alert(data);
//        },
//        fail: function () {
//            alert('Failed');
//        }
//    });
});

function validate_phone(inputtxt) {
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    if (inputtxt.value.match(phoneno))
    {
        return true;
    } else
    {
        alert("Not a valid Phone Number");
        return false;
    }
}

//function valdate_phone2(inputtxt) {
//    var phoneno = /^0\d{9}$/;
//    if (inputtxt.value.match(phoneno))
//    {
//        return true;
//    } else
//    {
//        alert("Not a valid Phone Number");
//        return false;
//    }
//}

function validate_email(inputtxt) {
 var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(inputtxt);
}

function validate_name(inputtxt) {

}

function validate_name2(inputtxt) {

}