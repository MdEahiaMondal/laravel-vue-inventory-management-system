import sweetalert2 from "../plaugin/sweetalert2";

import Noty from 'noty';


class Message{

    Toaster(message, type){
        sweetalert2.Toast(message, type)
    }

    Success()
    {
        new Noty({
            type: 'success', // string
            layout: 'topRight', // string
            text: 'Some notification text', // string
            theme: 'bootstrap-v3',
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }
    Alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Some notification text',
            theme: 'bootstrap-v3',
            timeout: 'bootstrap-v3',
        }).show();
    }

    Warning(){
        new Noty({
            type: 'warning', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: 'Some notification text', // string
            theme: 'bootstrap-v3',
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }

    Error(){
        new Noty({
            type: 'error', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: 'Some notification text', // string
            theme: 'bootstrap-v3',
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }

    Info(){
        new Noty({
            type: 'info', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: 'Some notification text', // string
            theme: 'bootstrap-v3',
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }


}
export default Message = new Message()
