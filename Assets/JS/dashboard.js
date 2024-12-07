// ON Ready - JQuery Validation ----------------------------------------------------------------------------------------------------------------------------------------------

$(document).ready(function() {

    $("#MainEditPersonalForm").validate({
        rules: {
            firstName:{
                required: true
            },
            lastName:{
                required: true
            },
            age:{
                required: true
            },
            countryFreelancer:{
                required: true
            }
        },
        messages: {
            firstName:{
                required: "Please enter name"
            },
            lastName:{
                required: "Please enter your last name"
            },
            age:{
                required: "Please enter your age"
            },
            countryFreelancer:{
                required: "Please enter your country name"
            }
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
                error.insertAfter(element);
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler:function(form){
            form.submit();
        }
    });


    $("#MainEditEDUForm").validate({
        rules: {
            field:{
                required: true
            },
            fieldLang1:{
                required: true
            },
            fieldLang2:{
                required: true
            },
            fieldLang3:{
                required: false
            },
            technology:{
                required: true
            },
            degree:{
                required: false    
            }
        },
        messages: {
            field:{
                required: "Please enter your field"
            },
            fieldLang1:{
                required: "Please enter programming language that you prefer"
            },
            fieldLang2:{
                required: "Please enter programming language that you prefer"
            },
            technology:{
                required: "Please enter the technology"
            },
        
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
                error.insertAfter(element);
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler:function(form){
            form.submit();
        }
    });


    $("#MainEditExpIntForm").validate({
        rules: {
            experience:{
                required: true
            }
        },
        messages: {
            experience:{
                required: "Please Enter this field"
            }
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
                error.insertAfter(element);
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler:function(form){
            form.submit();
        }
    });

    $("#MainEditContactForm").validate({
        rules: {
            contactEmail: {
                required: true,
                email: true,
                customEmail: true
            },
            contactPhone:{
                required: true,
                minlength: 14,
                maxlength: 14

            }
        },
        messages: {
            contactEmail: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                customEmail: "Please enter a valid email address"
            },
            contactPhone:{
                required: "Please enter your phone no"
            }
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
                error.insertAfter(element);
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler:function(form){
            form.submit();
        }
    });

    $("#MainEditUserPasForm").validate({
        rules: {
            username:{
                required: true
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 18
            },
            confirmPassword:{
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            username:{
                required: "Please create a username"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                maxlength: "Password must be no more longer than 18 characters.",
            },
            confirmPassword:{
                required: "Please confirm your password",
                equalTo: "Please enter the same password as above"
            }
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
            if (element.attr("name") === "password"){
                error.insertAfter(".form-group[name='pass-group']")
            }
            else if (element.attr("name") === "confirmPassword"){
                error.insertAfter(".form-group[name='pass-group-conf']")
            }
            else{
                error.insertAfter(element);
            }
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler:function(form){
            form.submit();
        }
    });




        // Custom email validation method -----------------------------------------------------------------------
        $.validator.addMethod("customEmail", function(value, element) {
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return this.optional(element) || emailPattern.test(value);
        }, "Please enter a valid email address.");


        // Prevent default form submission and handle it with jQuery validation -----------------------------------------------------------------------
        $('form').on('submit', function(event) {
            // Check if the form is valid
            if ($(this).is(':visible') && $(this).valid()) {
                console.log('Form is valid and ready to be submitted!');
            } else {
                // If the form is not valid, prevent submission
                event.preventDefault();
            }
        });
        

});

// Phone No - Validation ----------------------------------------------------------------------------------------------------------------------------------------------

function checkPhone(contactPhone) {
    // Get the input element by name
    var input = document.querySelector(`input[name="${contactPhone}"]`);
    
    // If the input is empty, reset it to the default value
    if (input.value === '') {
        input.value = '+91 ';
    }
}



// Hidden Form + Sections show

function toggleSection(sectionId, button) {
    const sections = document.querySelectorAll('.dash-detrow');
    const forms = document.querySelectorAll('.hidden-form');
    const buttons = document.querySelectorAll('.btn-nav-items');

    // Hide all sections and forms
    sections.forEach(section => section.style.display = 'none');
    forms.forEach(form => {
        form.style.display = 'none';
        clearForm(form);
    });

    // Remove active class from all buttons
    buttons.forEach(btn => btn.classList.remove('active'));

    // Show the selected section
    const selectedSection = document.getElementById(sectionId);
    selectedSection.style.display = 'flex';

    // Add active class to the clicked button
    button.classList.add('active');
}

// Event delegation for button clicks

document.querySelector('.offcanvas-body').addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-nav-items')) {
        toggleSection(event.target.dataset.sectionId, event.target);
    }
});

    function toggleForm(formId) {
        const form = document.getElementById(formId);
        // Check the current display style and toggle it
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'flex'; // Show the form
            form.classList.add('form');
        } else {
            form.style.display = 'none'; // Hide the form
            clearForm(form);
            form.classList.remove('form');
        }
    }

// Function to clear form fields
function clearForm(form) {
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        if (input.type === 'checkbox' || input.type === 'radio') {
            input.checked = false;
        } else {
            input.value = '';
        }
    });
}

// Offcanvas change icon and show menu
const toggler = document.querySelector('.navbar-toggler');
const offcan_ul = document.querySelector('.cust-dashoffcan');
let isMenuOpen = false;

toggler.addEventListener("click", () => {
    isMenuOpen = !isMenuOpen;
    offcan_ul.classList.toggle('show', isMenuOpen);
    toggler.classList.toggle('toggled');
});

document.addEventListener('click', function(event) {
    const offcanvas = document.getElementById('offcanvasScrolling');
    const button = document.querySelector('[data-bs-toggle="offcanvas"]');

    // Check if the click was outside the offcanvas and the button
    if (!offcanvas.contains(event.target) && !button.contains(event.target)) {
        const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvas);
        if (offcanvasInstance) {
            offcanvasInstance.hide();
            toggler.classList.remove('toggled');
        }
    }
});

// Password Show/Hide functionality
function togglePasswordVisibility(passwordInputId, eyeOpenIconId, eyeCloseIconId) {
    const passwordInput = document.getElementById(passwordInputId);
    const eyeOpenIcon = document.getElementById(eyeOpenIconId);
    const eyeCloseIcon = document.getElementById(eyeCloseIconId);

    if (passwordInput.getAttribute('type') === 'password') {
        passwordInput.setAttribute('type', 'text');
        eyeOpenIcon.style.display = 'block';
        eyeCloseIcon.style.display = 'none';
    } else {
        passwordInput.setAttribute('type', 'password');
        eyeOpenIcon.style.display = 'none';
        eyeCloseIcon.style.display = 'block';
    }
}

// Event listeners for password visibility toggles
document.getElementById('toggle-password-icon').addEventListener('click', () => {
    togglePasswordVisibility('password', 'eye-open-icon', 'eye-close-icon');
});

document.getElementById('toggle-password-icon-reenter').addEventListener('click', () => {
    togglePasswordVisibility('confirmPassword', 'eye-open-icon-reenter', 'eye-close-icon-reenter');
});
