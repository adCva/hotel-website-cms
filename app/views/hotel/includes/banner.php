<div class="banner-container" id="home">
    <!-- Image -->
    <div class="banner-image">
        <img src="<?php echo URLROOT . "/images/banner-0.jpg"; ?>" alt="Banner Image" class="theActual-image">
        <img src="<?php echo URLROOT . "/images/banner-1.jpg"; ?>" alt="Banner Image" class="theActual-image">
        <img src="<?php echo URLROOT . "/images/banner-2.jpg"; ?>" alt="Banner Image" class="theActual-image">
        <img src="<?php echo URLROOT . "/images/banner-3.jpg"; ?>" alt="Banner Image" class="theActual-image">
    </div>
    <!-- End of Image -->

    <!-- Text -->
    <div class="banner">
        <h4>Welcome to</h4>
        <h2 class="banner-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h2>
        <h1><span class="banner-icon"><i class="fas fa-h-square"></i></span>otel Juno</h1>
        <p>The best place to spend your time in Rome</p>
    </div>
    <!-- End of Text -->

</div>


<script>
    // Change the bg once every 20sec 
    let images = document.querySelectorAll(".theActual-image");
    let index = 0;
    window.setInterval(() => {
        for (let i = 0; i < images.length; i++) {
            images[i].style.display = "none";
        }
        if (index > 2) {
            index = 0
        } else {
            index++;
        }
        images[index].style.display = "block";
    }, 30000);
</script>