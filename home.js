
function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    section.scrollIntoView({ behavior: 'smooth' });
}

function scrollToReservation() {
    var reservationSection = document.getElementById('reservation');
    reservationSection.scrollIntoView({ behavior: 'smooth' });
}
document.addEventListener("DOMContentLoaded", function() {
    const circleImages = document.querySelectorAll(".circle-image");

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        circleImages.forEach((image) => {
            if (isInViewport(image)) {
                image.style.opacity = 1;
                image.style.transform = "translateY(0)";
            }
        });
    }

    // Initial check on page load
    handleScroll();

    // Listen for scroll events
    window.addEventListener("scroll", handleScroll);
});




