let data = '';

window.onload = function () {
     window.document.body.addEventListener('keydown', function(event){
        if( event.keyCode == 13 || event.keyCode == 16 ||  event.keyCode == 17 ) {
                event.preventDefault();
                    return;
                }

                if(event.ctrlKey) {
                    event.preventDefault();
                    return;
                }

        data += event.key
        console.log(data)
    });
}