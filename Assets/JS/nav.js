// Current Page Highlight Code ----------------------------------------------------------------------------------------------------------------------------------------------


        // Get the current page URL
        var currentPage = window.location.href;

        // Get all the navigation links
        var navLinks = document.querySelectorAll('.nav-item a');

        // Loop through the navigation links and add a class to the one that matches the current page
        navLinks.forEach(function(link) {
        if (link.href === currentPage) {
            link.classList.add('active-page');
        }
        });

        // Add a dot under the active navbar link
        var activeLink = document.querySelector('.active-page');

        if (activeLink) {
            activeLink.insertAdjacentHTML('afterend', '<div class="aria-current-circle"></div>');
        }





// Offcanvas change icon and show menu ----------------------------------------------------------------------------------------------------------------------------------------------


        // Get the button toggler and it's icon
        var toggler = document.querySelector('.navbar-toggler');
        var toggle_icon = document.querySelector('.navbar-toggler-icon');

        // Get Hidden Div Menu + navbar
        var offcan_ul = document.querySelector('.offcan');

        // Local DOM Var
        let isMenuOpen = false;

        // Add event on click on Toggler
        toggler.addEventListener("click",()=>{
            
            isMenuOpen = !isMenuOpen;
            offcan_ul.classList.toggle('show',isMenuOpen);
            toggler.classList.toggle('toggled');

});
