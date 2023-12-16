<style>
    
    .carousel-item {
        height: 70vh
    }

    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
</style>
<!--<script>
    function zoomOut() {
    const carouselItems = document.querySelectorAll('.carousel-item');
    carouselItems.forEach(item => {
        item.classList.add('zoom-out');
    });
    }
</script>-->
<div id="c1"  class="carousel slide container">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.pexels.com/photos/2144200/pexels-photo-2144200.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/552535/pexels-photo-552535.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="https://images.pexels.com/photos/140831/pexels-photo-140831.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img" class="d-block w-100">
        </div>
    </div>
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#c1" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#c1" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#c1" data-bs-slide-to="2"></button>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#c1" data-bs-target="#c1" data-bs-slide='prev'>
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#c1" data-bs-target="#c1" data-bs-slide='next'>
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
