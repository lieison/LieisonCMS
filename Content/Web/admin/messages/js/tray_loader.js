
var init_tray = function(){
    var msj = new messages_();
    msj.load_from(true );
    msj.count_read(0 , true);
    msj.count_send(0 , true);
    msj.count_trash(0 , true);
};


var load_tray = function(){
    $("#messages_table_read_wrapper").attr("style" , " display: none;" );
    $("#messages_table_send_wrapper").attr("style" , " display: none;" );
    $("#messages_table_trash_wrapper").attr("style" , " display: none;" );
    $("#messages_table_wrapper").attr("style" , " display: block;" );
    var msj = new messages_();
    msj.load_from(true );
};

var load_read = function(){
    $("#messages_table_read").addClass("table table-striped table-bordered table-hover");
    $("#messages_table_wrapper").attr("style" , " display: none;" );
    $("#messages_table_send_wrapper").attr("style" , " display: none;" );
    $("#messages_table_trash_wrapper").attr("style" , " display: none;" );
    $("#messages_table_read_wrapper").attr("style" , " display: block;" );
    var msj = new messages_();
    msj.load_from_read(true);
};


var load_send = function(){
    $("#messages_table_send").addClass("table table-striped table-bordered table-hover");
    $("#messages_table_wrapper").attr("style" , " display: none;" );
    $("#messages_table_read_wrapper").attr("style" , " display: none;" );
    $("#messages_table_trash_wrapper").attr("style" , " display: none;" );
    $("#messages_table_send_wrapper").attr("style" , " display: block;" );
    var msj = new messages_();
    msj.load_from_send(true);
};


var load_trash = function(){
    $("#messages_table_trash").addClass("table table-striped table-bordered table-hover");
    $("#messages_table_wrapper").attr("style" , " display: none;" );
    $("#messages_table_read_wrapper").attr("style" , " display: none;" );
    $("#messages_table_send_wrapper").attr("style" , " display: none;" );
    $("#messages_table_trash_wrapper").attr("style" , " display: block;" );
    var msj = new messages_();
    msj.load_from_send(true);
};


var load_compose = function(){
    var redact_ = new redact();
    redact_.show();
};



