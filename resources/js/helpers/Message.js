import sweetalert2 from "../plaugin/sweetalert2";

import Noty from 'noty';


class Message{

    Toaster(message, type){
        sweetalert2.Toast(message, type)
    }

    Success(message)
    {
        new Noty({
            type: 'success', // string
            layout: 'topRight', // string
            text: message, // string
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }
    Alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Some notification text',
            timeout: 'bootstrap-v3',
        }).show();
    }

    Warning(message){
        new Noty({
            type: 'warning', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: message, // string
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }

    Error(message){
        new Noty({
            type: 'error', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: message, // string
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }

    Info(message){
        new Noty({
            type: 'info', // string  	alert, success, error, warning, info
            layout: 'topRight', // string
            text: message, // string
            timeout: 2000, // boolean,int
            progressBar: true // boolean,int
        }).show();
    }

    DeleteAction(){
       return  Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
    }



}
export default Message = new Message()
