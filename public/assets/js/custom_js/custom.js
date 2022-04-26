
    $('#work_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#work_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

    $('#new_work_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#new_work_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

    //  $(document).ready(function(){
    //     $(document).on('click','#addOfficerbtn',function(){
    //         jQuery.noConflict(); 
    //         $('#addOfficer').modal('show');
    //     });
    // });

    let firstName = document.querySelector("#officer_first_name");
    let lastName = document.querySelector("#officer_last_name");
    
    let register = document.querySelector("#register");

    let fnameTest;
    let lnameTest;

    firstName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(firstName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            fnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            fnameTest = false;
        }
    });

      lastName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(lastName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            lnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            lnameTest = false;
        }
    });

    setInterval(function() {
        if (fnameTest && lnameTest ) {
            register.removeAttribute("disabled", "disabled");
        } else {
            register.setAttribute("disabled", "disabled");
        }
    }, 500);
    
