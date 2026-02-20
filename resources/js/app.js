import './bootstrap';

import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

window.Swal = Swal;

window.Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: false,
});



document.getElementById('checkout-form').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent immediate form submission

    Swal.fire({
        title: 'Confirm Transaction',
        text: "Are you sure you want to complete this transaction?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, complete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); // submit form if confirmed
        }
    });
});



