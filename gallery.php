<?php include 'includes/header.php'; ?>

<h2>Gallery</h2>
<div class="gallery">
    <img src="assets/images/image1.jpg" alt="Gallery Image 1" />
    <img src="assets/images/image2.jpg" alt="Gallery Image 2" />
    <img src="assets/images/image3.jpg" alt="Gallery Image 3" />
</div>

<style>
.gallery {
    display: flex;
    gap: 15px;
}
.gallery img {
    width: 30%;
    border-radius: 5px;
}
</style>

<?php include 'includes/footer.php'; ?>
