const downloadBtn = document.getElementById("downloadBtn");
const img = document.querySelector("img"); // Selects the image element

downloadBtn.addEventListener("click", function() {
  // Option 1: Use image from webpage (if applicable)
  if (img.complete && img.naturalHeight !== 0) { // Check if image is loaded successfully
    const imageDataURL = img.src; // Use the image source from the webpage
    const doc = new jsPDF();
    doc.addImage(imageDataURL, 'JPEG', 10, 10);
    doc.save("form.pdf");
  } else {
    // Option 2: Use external image URL (if image on webpage is not loaded or unavailable)
    const imageDataURL = 'https://your-image-url.com/image.jpg'; 
    const doc = new jsPDF();
    doc.addImage(imageDataURL, 'JPEG', 10, 10);
    doc.save("form.pdf");
  }
});

