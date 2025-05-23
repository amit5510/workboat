// Example JS for gallery image click popup or other simple interactions
document.addEventListener('DOMContentLoaded', () => {
    const galleryImages = document.querySelectorAll('.gallery-grid img');
    galleryImages.forEach(img => {
        img.addEventListener('click', () => {
            alert('Image clicked: ' + img.alt);
        });
    });
});
