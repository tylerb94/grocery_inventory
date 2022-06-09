function disableEnterKey(e){
    var key;
        if(window.event){
            key = window.event.keyCode;
        } else {
            key = e.which;
        }

        if(key == 13){
            return false;
        } else {
        return true;
    }
}