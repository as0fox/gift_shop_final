// testimonialll
let currentIndex = 0;
const slides = document.querySelectorAll('.testimonial-slide');
let slideInterval;

// Function to show slide at the specified index
function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
            slide.classList.add('active');
        }
    });
}

// Initial slide display
showSlide(currentIndex);

// Auto-slide function
function startAutoSlide() {
    slideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }, 4000); // Adjust the interval time as needed
}

// Manual navigation functions
function prevSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

function nextSlide() {
    clearInterval(slideInterval); // Stop auto-slide on manual change
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
    startAutoSlide(); // Restart auto-slide after manual change
}

// cart
function submitOrder() {
    Swal.fire({
        title: 'Order Submitted!',
        text: 'Your order has been submitted successfully.',
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'custom-swal-button'
        },
        html: '<p style="font-size: 14px; margin-top: 10px;"><a href="/home" style="color: #b19361; text-decoration: none;">Continue Shopping</a></p>'
    });
}





document.addEventListener("DOMContentLoaded", function() {
    // Start the auto-slide function for the other page
    startAutoSlide();

});


