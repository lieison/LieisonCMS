
var init_tray = function(){
    var msj = new messages_();
    msj.load_from(true , true);
    msj.count_read(0 , true);
};

var load_tray = function(){
    var msj = new messages_();
    msj.load_from(true , false);
};

var load_read = function(){
    var msj = new messages_();
    msj.load_from_read(true , false);
};

var load_compose = function(){
    var redact_ = new redact();
    redact_.show();
};



