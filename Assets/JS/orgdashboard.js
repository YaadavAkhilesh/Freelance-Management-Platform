// ON Ready - JQuery Validation ----------------------------------------------------------------------------------------------------------------------------------------------

$(document).ready(function() {


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


    $("#MainCreateProjForm").validate({
        rules: {
            projectTitle: {
                required: true,
                minlength: 5,
                maxlength: 40
            },
            projectDisc: {
                required: true,
                maxlength: 300
            },
            fieldReq1: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            fieldReq2: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            fieldReq3: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            pdfFile: {
                required: true,
                extension: "pdf"
            },
            linkInput: {
                required: true,
                url: true
            },
            mintime: {
                required: true,
                minlength: 11,
                maxlength: 17,
                dateFormat: true // Custom validation for date format
            },
            maxtime: {
                required: true,
                minlength: 11,
                maxlength: 17,
                dateFormat: true // Custom validation for date format
            },
            bidVal: {
                required: true,
                minlength: 3,
                maxlength: 7
            }
        },
        messages: {
            projectTitle: {
                required: "Please enter a project title",
                minlength: "Title must be at least 5 characters long",
                maxlength: "Title must be no longer than 40 characters"
            },
            projectDisc: {
                required: "Please enter a project description",
                maxlength: "Description must be no longer than 300 characters"
            },
            fieldReq1: {
                required: "Please enter a requirement",
                minlength: "Requirement must be at least 2 characters long",
                maxlength: "Requirement must be no longer than 25 characters"
            },
            fieldReq2: {
                required: "Please enter a requirement",
                minlength: "Requirement must be at least 2 characters long",
                maxlength: "Requirement must be no longer than 25 characters"
            },
            fieldReq3: {
                required: "Please enter a requirement",
                minlength: "Requirement must be at least 2 characters long",
                maxlength: "Requirement must be no longer than 25 characters"
            },
            pdfFile: {
                required: "Please upload a PDF file",
                extension: "Only PDF files are allowed"
            },
            linkInput: {
                required: "Please enter a valid URL",
                url: "Please enter a valid URL format"
            },
            mintime: {
                required: "Please enter a minimum timeline",
                minlength: "Minimum timeline must be 11 characters long",
                maxlength: "Minimum timeline must be no longer than 17 characters"
            },
            maxtime: {
                required: "Please enter a maximum timeline",
                minlength: "Maximum timeline must be 11 characters long",
                maxlength: "Maximum timeline must be no longer than 17 characters"
            },
            bidVal: {
                required: "Please enter a bid value",
                minlength: "Bid value must be at least 3 characters long",
                maxlength: "Bid value must be no longer than 7 characters"
            }
        },

        // Error Placement -----------------------------------------------------------------------

        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },

        // Final Submission -----------------------------------------------------------------------

        submitHandler: function(form) {
            form.submit();
        }
    });




        // Custom email validation method -----------------------------------------------------------------------
        $.validator.addMethod("customEmail", function(value, element) {
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return this.optional(element) || emailPattern.test(value);
        }, "Please enter a valid email address.");

        $.validator.addMethod("dateFormat", function(value, element) {
            return this.optional(element) || /^(0[1-9]|[12][0-9]|3[01])-(January|February|March|April|May|June|July|August|September|October|November|December)-\d{4}$/.test(value);
        }, "Please enter a date in the format DD-Month-YYYY.");

        


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
