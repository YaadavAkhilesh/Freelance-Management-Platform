// ON Ready - JQuery Validation ----------------------------------------------------------------------------------------------------------------------------------------------

$(document).ready(function() {
    
    $("#registrationForm").validate({
        rules: {
            firstName:{
                required: true
            },
            lastName:{
                required: true
            },
            userType:{
                required: true
            },
            age:{
                required: true
            },
            field:{
                required: true
            },
            fieldLang1:{
                required: true
            },
            fieldLang2:{
                required: true
            },
            technology:{
                required: true
            },
            // degree:{
                
            // },
            experience:{
                required: true
            },
            countryFreelancer:{
                required: true
            },
            serviceType:{
                required: true
            },
            countryClient:{
                required: true
            },
            contactEmail: {
                required: true,
                email: true,
                customEmail: true
            },
            contactPhone:{
                required: true,
                minlength: 14,
                maxlength: 14

            },
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
            firstName:{
                required: "Please enter name"
            },
            lastName:{
                required: "Please enter your last name"
            },
            userType:{
                required: "Please select your user type"
            },
            age:{
                required: "Please enter your age"
            },
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
            countryFreelancer:{
                required: "Please enter your country name"
            },
            serviceType:{
                required: "This field is required"
            },
            countryClient:{
                required: "Please enter your country name"
            },
            contactEmail: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                customEmail: "Please enter a valid email address"
            },
            contactPhone:{
                required: "Please enter your phone no"
            },
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
            if (element.attr("name") === "userType") {
                error.insertAfter(".form-group[name='user']");
            } else if (element.attr("name") === "serviceType") {
                error.insertAfter(".form-group[name='serviceTypeer']");
            }
            else if (element.attr("name") === "password"){
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
        // $('#registrationForm').on('submit', function(event) {
        //     event.preventDefault();
        //     if ($("#registrationForm").valid()) {
        //         console.log('Form is valid and ready to be submitted!');
        //         this.submit();
        //     }
        // });

});


// On DOM Load Freelancer vs Client Load section ----------------------------------------------------------------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    const freelancerFields = document.querySelectorAll('.freelancerFields');
    const clientFields = document.querySelectorAll('.clientFields');

    document.getElementsByName('userType').forEach((elem) => {
        elem.addEventListener('change', function(event) {
            if (event.target.value === 'Freelancer') {
                freelancerFields.forEach(field => field.classList.remove('hidden'));
                clientFields.forEach(field => field.classList.add('hidden'));
            } else if (event.target.value === 'Client') {
                clientFields.forEach(field => field.classList.remove('hidden'));
                freelancerFields.forEach(field => field.classList.add('hidden'));
            }
        });
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


// Show Submitbtn if Agree terms & Con ----------------------------------------------------------------------------------------------------------------------------------------------

function toggleSubmitButton() {
    const checkbox = document.getElementById('termscon');
    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = !checkbox.checked;
}


// Password Show , Hide ----------------------------------------------------------------------------------------------------------------------------------------------


document.getElementById('toggle-password-icon').addEventListener('click', function() {
    let passwordInput = document.getElementById('password');
    let eyeOpenIcon = document.getElementById('eye-open-icon');
    let eyeCloseIcon = document.getElementById('eye-close-icon');
    
    if (passwordInput.getAttribute('type') === 'password') {
        passwordInput.setAttribute('type', 'text');
        eyeOpenIcon.style.display = 'block';
        eyeCloseIcon.style.display = 'none';
    } else {
        passwordInput.setAttribute('type', 'password');
        eyeOpenIcon.style.display = 'none';
        eyeCloseIcon.style.display = 'block';
    }
});

document.getElementById('toggle-password-icon-reenter').addEventListener('click', function() {
    let confirmpassword = document.getElementById('confirmPassword');
    let eyeOpenIcon = document.getElementById('eye-open-icon-reenter');
    let eyeCloseIcon = document.getElementById('eye-close-icon-reenter');
    
    if (confirmpassword.getAttribute('type') === 'password') {
        confirmpassword.setAttribute('type', 'text');
        eyeOpenIcon.style.display = 'block';
        eyeCloseIcon.style.display = 'none';
    } else {
        confirmpassword.setAttribute('type', 'password');
        eyeOpenIcon.style.display = 'none';
        eyeCloseIcon.style.display = 'block';
    }
});