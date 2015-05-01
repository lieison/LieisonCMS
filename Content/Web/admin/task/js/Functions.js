var TaskInit = function () {

    return {
        init: function () {

            if (!jQuery().sortable) {
                return;
            }
            
            var data = '<div class="col-md-4 column sortable"><div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div>';
                
                data += '<div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div>';
                
                data += '<div class="portlet portlet-sortable light bordered"><div class="portlet-title"><div class="caption font-green-sharp"><i class="fa fa-tasks"></i><span class="caption-subject bold uppercase">Aplicaciones</span>	<span class="caption-helper"></span>';
                data += '</div><div class="actions"><a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"></a></div></div><div class="portlet-body"><div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">';
                data += '</div></div></div></div>';
            
            $("#sortable_portlets").html(data);
            

            $("#sortable_portlets").sortable({
                connectWith: ".portlet",
                items: ".portlet", 
                opacity: 0.8,
                coneHelperSize: true,
                placeholder: 'portlet-sortable-placeholder',
                forcePlaceholderSize: true,
                tolerance: "pointer",
                helper: "clone",
                tolerance: "pointer",
                forcePlaceholderSize: !0,
                helper: "clone",
                cancel: ".portlet-sortable-empty, .portlet-fullscreen", 
                revert: 250, 
                update: function(b, c) {
                    if (c.item.prev().hasClass("portlet-sortable-empty")) {
                        c.item.prev().before(c.item);
                    }                    
                }
            });
        }
    };
}();



var FindUsers = function () {

 
    return {
        init: function () {     
            
            var data = '<option value="AL">USUARIO2</option><option value="WY">USUARIO1</option>';
            $("#cmd_asignar").html(data);
        }
    };
}();



var FormWizard = function () {


    return {
        init: function () {
            
           
            
            if (!jQuery().bootstrapWizard) {
                return;
            }


            function format(state) {
                if (!state.id) return state.text; 
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            
            
            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    txt_title: {
                        minlength: 3,
                        required: true
                    },
                    txt_date: {
                        required: true
                    },
                    txt_hour: {
                        required: true
                    },
                    txt_description: {
                        required: true
                    },
                    cmd_client: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    //payment
                    card_name: {
                        required: true
                    },
                    card_number: {
                        minlength: 16,
                        maxlength: 16,
                        required: true
                    },
                    card_cvc: {
                        digits: true,
                        required: true,
                        minlength: 3,
                        maxlength: 4
                    },
                    card_expiry_date: {
                        required: true
                    },
                    'payment[]': {
                        required: true,
                        minlength: 1
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            
            
            
            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                 onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    /* if (form.valid() == false) {
                        return false;
                    }*/

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            
            $('#form_wizard_1 .button-submit').click(function () {
               // ACA SE ENVIAN LOS PROCESOS
            }).hide();

            $('#country_list', form).change(function () {
                form.validate().element($(this)); 
            });
        }

    };

}();



/***
 *
 *
 *  FUNCIONES GENERALES PARA TASK Y MULTITASK
 *  DESARROLLADO POR: LIESON  (rmarroquin@lieison.com)
 *  VERSION: 1.0
 *  AÑO: 2015
 *     
 */


/**
 * @author Rolando Arriaza
 * @version 1.0
 * @return {HTML} devuelve el html del task client <option value='id' >Name</option>
 * */
function FindClients(){
    
         $.ajax({
                      type: "POST",
                      url: "includes/findclients.php",
                      success: function(value){
                           $("#cmd_client").html(value);
                      }
            });
     
}

/**
 * @author Rolando Arriaza
 * @version 1.0
 * @return {HTML} devuelve el html del task asign <option value='id' >Name</option>
 * */
function AsignTo(){
     $.ajax({
                      type: "POST",
                      url: "includes/findusers.php",
                      success: function(value){
                           $("#cmd_asignto").html(value);
                      }
            });
}


/**
 * @author Rolando Arriaza
 * @version 1.0
 * @return {HTML} devuelve el html del task informacion del usuario <option value='id' >Name</option>
 * */
function ShowAsignInfo(){
     
    var params = {
         "id_user": $("#cmd_asignto").val()
    };
     
     $.ajax({
                      type: "POST",
                      url: "includes/infousers.php",
                      data : params ,
                      success: function(value){
                           var data = $.trim(value);
                           $("#info_user").html(data);
                      }
     });
}


/**
 * @author Rolando Arriaza
 * @version 1.0
 * @return {HTML} devuelve el html del task informacion de box <option value='id' >Name</option>
 * */
function ShowBoxDocument(){
    
      var params = {
         "init": 1
       };
        
       $.ajax({
                      type: "POST",
                      url: "includes/box.php",
                      data : params ,
                      success: function(value){
                           $("#box_document").html(value); 
              }
     });
}

//SI EL id es = 0 entonces verifica un select por defecto
function GetBoxChild(id , tree_name){
    
    
    if(id==0){
        id = $('#box_parent').val();
        tree_name = $( "#box_parent option:selected" ).text();
    }
    
    var params = {
         "folder": id,
         "file_tree" : tree_name
       };
        
       $.ajax({
                      type: "POST",
                      beforeSend: function(){
                            var loading ='<div class="panel panel-default"><div class="panel-body">';
                                loading += '<img width="50" height="50" src="../img/assert/loadingd.gif" />';
                                loading += '&nbsp;&nbsp;<b>BUSCANDO DENTRO DE ' + tree_name.toUpperCase() + '</b>';
                                loading += '</div></div>';
                                
                            $("#box_child").html(loading);
                      },
                      url: "includes/box.php",
                      data : params ,
                      success: function(value){
                           $("#box_child").html(value); 
                          
                      }
     });
}


function AddFile(name , url){
    
    var stack = $("#box_stack").val();
    var view_ = "";
    
    if(stack === "undefined"){
        stack = null;
    }
    //alert(stack);
    var data = {
            "name": name,
            "url": url,
            "stack": stack
    };
        
     $.ajax({
                      type: "POST",
                      url: "includes/box_stack.php",
                      data : data ,
                      success: function(value){
                           var json = $.trim(value);
                           $("#box_stack").val(json); 
                           
                           var parse = JSON.parse(json);
                           //alert(json);
                           $.each(parse, function(k,v){
                                view_ = ' <a href="#" class="list-group-item">' + v.name + '</a>';
                                $("#box_documents").append(view_);
                           });  
                           
                           
                           
                      }
     });
}


/**
 * @author Rolando Arriaza
 * @version 1.0
 * @syntax Inicia los procedimientos de task simple 
 * */
var TaskInit = function () {

    return {
        init: function () {     
            FindClients();
            AsignTo();
           
        }
    };
}();
