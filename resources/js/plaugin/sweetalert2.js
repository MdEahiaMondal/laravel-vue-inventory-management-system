import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

class sweetalert2{
    Toast(message, type = 'success'){
        Toast.fire({
            icon: type,
            title: message
        })
    }
}

export default sweetalert2 = new sweetalert2()
