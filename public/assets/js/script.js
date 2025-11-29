$( document ).ready(function() {
    var w = window.innerWidth;

    if(w > 767){
        $('#menu-jk').scrollToFixed();
    }else{
        $('#menu-jk').scrollToFixed();
    }



})


$( document ).ready(function() {

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay: true,
        dots: true,
        autoplayTimeout: 5000,
        navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })

 const galleryImages = document.querySelectorAll('.gallery img');
const previewImage = document.getElementById('preview-image');
const nextButton = document.getElementById('next-button');

let currentImageIndex = 0; // Track current image index

 //Function to display preview image
 function displayPreview(image) {
  previewImage.src = image.dataset.preview; // Get preview image path from data-preview attribute
}

 //Add click event listener to each gallery image
galleryImages.forEach((image, index) => {
  image.addEventListener('click', () => {
    displayPreview(image);
    currentImageIndex = index; // Update current image index
  });
});

 //Next button click event listener
nextButton.addEventListener('click', () => {
 currentImageIndex++; // Increment current image index
  if (currentImageIndex >= galleryImages.length) {
    currentImageIndex = 0; // Reset index if it reaches the end
  }
  displayPreview(galleryImages[currentImageIndex]); // Display next image preview
   });

 //Display preview image on page load (optional)
   window.addEventListener('load', () => {
 displayPreview(galleryImages[currentImageIndex]);
});

});

  const imageHeight = galleryImages[0].offsetHeight; // Get height of the first image
   galleryImages.forEach(image => {
  image.style.height = `${imageHeight}px`;
    });


    const keyDivImages = document.querySelectorAll('.key-div img');

    function setEqualHeights() {
  const maxHeight = Math.max(...keyDivImages.map(img => img.offsetHeight));
  keyDivImages.forEach(img => img.style.height = `${maxHeight}px`);
}

    window.addEventListener('load', setEqualHeights);

    $(document).ready(function() {
        $('[data-fancybox="gallery"]').fancybox({
          // Enable slideshow functionality (optional)
          slideShow: {
            autoStart: false, // Set to true for automatic slideshow
            speed: 300, // Animation speed in milliseconds
          },
      
          // Enable additional features
          arrows: true, // Display navigation arrows
          infobar: true, // Display information bar (counter and title)
          toolbar: true, // Display toolbar with zoom, full screen, etc. (requires `buttons` helper)
          buttons: [
            "zoom", // Enable zoom button
            "slideShow", // Enable slideshow toggle button (optional)
            "fullScreen", // Enable full screen button
            "download", // Enable download button (optional)
            "thumbs", // Enable thumbnail navigation (optional)
            "close" // Enable close button
          ],
      
          // Additional customization options (optional)
          transitionIn: 'fade', // Use Animate.css classes for animations (ensure Animate.css is included)
          transitionOut: 'fade',
        });
     
      
  const galleryImages = document.querySelectorAll('.frame img');

function setEqualHeights() {
  const maxHeight = Math.max(...galleryImages.map(img => img.offsetHeight));
  galleryImages.forEach(img => img.style.height = `${maxHeight}px`);
}

window.addEventListener('load', setEqualHeights);



// Countdown

// Set the date we're counting down to
const countDownDate = new Date("August 10, 2024 00:00:00").getTime();

// Update the countdown every 1 second
const countdownFunction = setInterval(function() {
  // Get the current date and time
  const now = new Date().getTime();
    
  // Calculate the remaining time
  const distance = countDownDate - now;
    
  // Calculate days, hours, minutes, and seconds
  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Display the countdown timer
  document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
  document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
  document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
  document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
    
  // If the countdown is over, display a message
  if (distance < 0) {
    clearInterval(countdownFunction);
    document.getElementById("days").innerHTML = "00";
    document.getElementById("hours").innerHTML = "00";
    document.getElementById("minutes").innerHTML = "00";
    document.getElementById("seconds").innerHTML = "00";
  }
}, 1000);


}); 




