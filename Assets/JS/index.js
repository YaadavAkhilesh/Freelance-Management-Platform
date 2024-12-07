// Onview Set Animation to animate-btn ----------------------------------------------------------------------------------------------------------------------------------------------

    // Select all animate-btn elements
    const animateBtns = document.querySelectorAll('.animate-btn-1, .animate-btn-2, .animate-btn-3');

    // Create an Intersection Observer
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // Add the active class to the button that is in view
            entry.target.classList.add('active');
          } else {
            // Remove the active class from the button that is out of view
            entry.target.classList.remove('active');
          }
        });
      },
      {
        rootMargin: '0px',
        threshold: 0.5, // Trigger the animation when the element is 50% in view
      }
    );

    // Observe each animate-btn element
    animateBtns.forEach(btn => observer.observe(btn));
