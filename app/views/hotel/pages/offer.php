<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";
?>


<!-- LOCATION MESSAGE -->
<div class="location-message">
    <h1><span>Juno Hotel</span> > <?php echo $data['offer']->offerName; ?></h1>
</div>
<!-- END OF LOCATION MESSAGE -->

<!--OFFER PAGE -->
<section class="offer-page-container" id="home">
    <div class="offer-page">
        <div>
            <h1 class="title"><?php echo $data['offer']->offerName; ?></h1>
            <hr>
            <div>
                <div class="offer-content-container">
                    <img src="<?php echo URLROOT . "/images/" . $data['offer']->offerImage ?>" alt="Offer Image" class="offer-img">
                    <div class="offer-dates">
                        <p><i class="fas fa-play"></i> &nbsp;
                            <?php
                            $offerStart = date_create($data['offer']->offerStart);
                            echo date_format($offerStart, " d F, Y");
                            ?>
                        </p>
                        <p><i class="fas fa-pause"></i> &nbsp;
                            <?php
                            $offerEnd = date_create($data['offer']->offerEnd);
                            echo date_format($offerEnd, "d F, Y");
                            ?>
                        </p>
                    </div>
                    <p class="offer-desc-p"><?php echo $data['offer']->offerDescription; ?></p>
                    <hr>
                    <p class="conditions"><span class="condition-title">Eligibility</span><span class="condition-bold">For security purposes offers are selected at check in or with a phone confirmation (when the offer requires prior selection)</span>.<br> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis aperiam dicta pariatur tenetur ipsa. Ipsam suscipit quibusdam numquam facere animi iste iure! Enim fuga, voluptas doloremque earum, quae quos totam vero quibusdam molestiae nisi facilis? Labore repudiandae et tempora itaque necessitatibus? Quas voluptatem delectus ipsam ratione ex atque nihil laboriosam consectetur inventore eligendi temporibus aliquid impedit reiciendis placeat perferendis animi accusamus minus, id unde dicta. Deleniti suscipit quae laborum tempora.</p>
                    <p class="conditions">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta doloremque distinctio, sint illo non minima enim numquam doloribus tenetur quam alias ea beatae at eius repudiandae excepturi expedita fugit quidem laboriosam optio rem ut molestiae! Incidunt impedit commodi dignissimos. Quidem unde quasi distinctio soluta quis. Omnis quia quis tempore facilis itaque molestiae nesciunt? Veritatis similique nihil nulla, tempora accusamus aperiam quasi omnis iure tenetur, nemo, quia officiis? Placeat repellendus, atque quasi necessitatibus eveniet id! Dolore sint nesciunt accusamus fugiat libero ad, iure fuga. Obcaecati consectetur officiis numquam dolorum dignissimos qui!</p>

                    <p class="offer-price">Offer Price: $ <?php echo $data['offer']->offerPrice; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!---------------------------------------------------------------- OTHER OFFERS ---------------------------------------------------------------->
    <section class="rooms-container">
        <div class="rooms">
            <h1 class="title title-afterline-30">Other Offers</h1>
            <div class="each-room">
                <div id="wrapper">
                    <div id="carousel">
                        <div id="content">
                            <?php foreach ($data['notIn'] as $offer) : ?>
                                <div class="card">
                                    <img src="<?php echo URLROOT . "/images/" . $offer->offerImage; ?>" alt="Room Image" class="item">
                                    <div class="card-text">
                                        <h1><?php echo $offer->offerName; ?> Room</h1>
                                        <p><?php echo $offer->offerDescription; ?></p>
                                    </div>
                                    <div class="card-btn">
                                        <a href="<?php echo URLROOT . "/home/offer/" . $offer->id; ?>" class="red-btn">See More...</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a class="testimonial-prev" id="prev">&#10094;</a>
                    <a class="testimonial-next" id="next">&#10095;</a>
                </div>

            </div>
        </div>
    </section>

    <!--ADD OFFER LIST HERE -->


</section>

<script>
    // OFFERS CAROUSEL
    const gap = 16;

    const carousel = document.getElementById("carousel"),
        content = document.getElementById("content"),
        next = document.getElementById("next"),
        prev = document.getElementById("prev");

    let maxScrollLeft = carousel.scrollWidth - carousel.clientWidth;

    next.addEventListener("click", e => {
        if (carousel.scrollLeft == maxScrollLeft) {
            carousel.scroll(0, 0);
        } else {
            carousel.scrollBy(width + gap, 0);
        }

    });
    prev.addEventListener("click", e => {
        if (carousel.scrollLeft == 0) {
            carousel.scroll(maxScrollLeft, 0)
        } else {
            carousel.scrollBy(-(width + gap), 0);
        }
    });

    let width = carousel.offsetWidth;
    window.addEventListener("resize", e => (width = carousel.offsetWidth));
</script>

<?php
require_once APPROOT . "/views/hotel/includes/contact.php";
require_once APPROOT . "/views/hotel/includes/footer.php";
?>