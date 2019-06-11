var autoRemoveLoader;
function showResponse(status, msg, msgTime){
    msgTime = msgTime ? msgTime : 150000;
    var milliseconds = new Date().getTime();
    $('.inner, #processOverlay').prepend('<div class="responseMsg-'+milliseconds+' row">'+
                           '<center class="col-xs-12"><div class="alert alert-'+status+' alert-dismissable">'+
                               '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                               msg+
                           '</div></center>'+
                        '</div>');
    setTimeout(function(){
        $('.responseMsg-'+milliseconds).fadeOut(500, function() { $(this).remove(); });
    }, msgTime);
}
function ajaxLoading(isHide = false){
    if(isHide){
        $('#processOverlay').remove();
        clearTimeout(autoRemoveLoader);
        return;
    }

    $('body').append('<div id="processOverlay" style="background:#000;width:100%;height:1000px;position:fixed;top:0;left:0;opacity:0.8;display:block; z-index:10000;"><a href="#" style="float:right;" id="close-overlay-button">X<a><img style="margin:20% auto;display: block;transform: scale(2)" src="/assets/images/loader2.svg" alt="Processing ..."></div>');
    autoRemoveLoader = setTimeout(function(){
        $('#processOverlay').remove();
        showResponse("warning", "Something is not good, Check your console (Control+Shift+J)");
    }, 10000);
}
function performAjax(varsArray, optionalErrMsg, optionalFunctiontoPerform, noLoader){
    var response, status;
    if(typeof varsArray === "string"){
        varsArray += "&ajax=true";
    }else{
        varsArray.ajax = "true";
    }
    if(typeof optionalErrMsg === "function"){
        optionalFunctiontoPerform = optionalErrMsg;
        optionalErrMsg = "";
    }else if(typeof optionalErrMsg === "undefined"){
        optionalFunctiontoPerform = showResponse;
        optionalErrMsg = " ";
    }
    $.ajax({
        type: 'POST',
        data: varsArray,
        beforeSend : ajaxLoading(noLoader)
    })
    .done(function(data) {
        console.log(data);
        if(! noLoader) $("html, body").animate({scrollTop: 0},"slow");
        if(optionalErrMsg === ""){
            optionalFunctiontoPerform(data);
            return true;
        }
        try {
            response = JSON.parse(data);
            status = true;
        } catch(e) {
            response = data.search('{"status":');
            if( response != -1){
                response = data.substring(response, data.indexOf(' }')+2);
                //console.log(response);
                try{
                  response = JSON.parse(response);
                  status = true;
                }catch(e){
                  response = {"status": "warning", "message": "Unknown Status (catch2) : <b>Please refresh page and check manually</b>"+optionalErrMsg};
                  status = false;
                  //console.log(data);
                }
            }else{
               response = {"status": "warning", "message": "Unknown Status (else) : <b>Please refresh page and check manually</b>"+optionalErrMsg};
               status = false;
               //console.log(data);
            }
        } finally {
            optionalFunctiontoPerform(response.status, response.message);
            return status;
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        response = {"status": "danger", "message": "Error Unable to Complete Ajax request, Please try Later after refreshing Page"+optionalErrMsg};
        showResponse(response.status, response.message);
        // console.log(textStatus+' : '+errorThrown);
        return false;
    })
    .always(function() {
        ajaxLoading(true);
    });
}
$(function(){
    $('body').on('click', '#close-overlay-button', function(event) {
        ajaxLoading(true);

    });

    // Ajax Form Submit
    $("#content").on("submit", ".ajax-form", function(e) {
        e.preventDefault();
        var form = $(this),
            vars = form.serialize(),
            formId = form.attr('id'),
            status;
        performAjax(vars , " ", function(status, msg){
            if(status === "success"){
                if(formId == "checkTicket"){
                    var ticket = msg.ticket,
                        jobs = msg.job,
                        company = ticket.company ? ' ('+ticket.company+')' : '',
                        alternate_mobile = ticket.alternate_mobile ? ', '+ticket.alternate_mobile : '',
                        email = ticket.email ? ', '+ticket.email : '';
                    $(".panel-heading").html('<i class="icon-list"></i> History for '+ticket.code+'<span class="pull-right">Date of Closing (est.) : '+ticket.close_time+'</span>');
                    $(".timeline").html($("#detailTemp").html());
                    $(".open_time").html(ticket.open_time);
                    $(".ticketIssue").html(ticket.details);
                    $(".ticketCustomer").html(ticket.customer+company);
                    $(".ticketContact").html(ticket.mobile+alternate_mobile+email);
                    $(".ticketProduct").html(ticket.brand+' '+ticket.category+', '+ticket.product+' '+ticket.model+' ('+ticket.spec1+', '+ticket.spec2+') ');
                    if(ticket.technician){
                        $(".timeline").append($("#technicianTemp").html());
                        $(".ticketTechnicianName").html(ticket.technician);
                        $(".ticketTechnicianContact").html(ticket.technicianMobile);
                    }
                    if(jobs){
                        var position, attender;
                        $.each(jobs, function(index, job) {
                            position = (index % 2 == 0) ? 'class="timeline-inverted"' : '';
                            attender = job.attender ? '<p><b>Attender : </b>'+job.attender+'</p>' : '';
                            $(".timeline").append('<li '+position+'>'+
                                                    '<div class="timeline-badge success"><i class="icon-wrench"></i></div>'+
                                                    '<div class="timeline-panel">'+
                                                        '<div class="timeline-heading">'+
                                                            '<h4 class="timeline-title">Action</h4>'+
                                                            '<p><small class="text-muted">'+job.job_time+'</small></p>'+
                                                        '</div>'+
                                                        '<div class="timeline-body">'+attender+'<p><b>Status : </b>'+job.detail+'</p></div>'+
                                                    '</div>'+
                                                '</li>');
                        });
                    }
                    if(ticket.status == 1){
                        $("#ticketStatus").html('<div class="alert alert-success">'+
                                    'Your Complaint Successfully resolved'+
                                    '</div>');
                    }else{
                        $("#ticketStatus").html('<div class="alert alert-danger">'+
                                    'Your Complaint will resolved Soon'+
                                    '</div>');
                    }
                    return;
                }
                form[0].reset();
                $(".chzn-select").val('').trigger("chosen:updated");
            }
            showResponse(status, msg);
        });
        return false;
    });
});