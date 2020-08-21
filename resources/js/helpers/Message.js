import sweetalert2 from "../plaugin/sweetalert2";

class Message{

    Toaster(message, type){
        sweetalert2.Toast(message, type)
    }
}
export default Message = new Message()
