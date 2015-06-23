var event_ = function(id){
    primary(id);
};

var primary = function(id){
    var name    = "tray_" + id;
    switch(name){
        case "tray_1":
            $("#" + name).removeClass().addClass("inbox active");
            $("#tray_2").removeClass().addClass("sent");
            $("#tray_3").removeClass().addClass("trash");
            break;
        case "tray_2":
            $("#" + name).removeClass().addClass("sent active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_3").removeClass().addClass("trash");
            break;
        case "tray_3":
            $("#" + name).removeClass().addClass("trash active");
            $("#tray_1").removeClass().addClass("inbox");
            $("#tray_2").removeClass().addClass("sent");
            break;
    }
};


