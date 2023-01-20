<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";
require_once APPROOT . "/views/hotel/includes/banner.php";
?>



<!---------------------------------------------------------------- BOOKINGS ---------------------------------------------------------------->
<section class="booking-container" id="booking">
    <div class="booking">
        <!--Btns-->
        <div class="bookings-btns">
            <button class="booking-btn active-booking-btn" data-opens="hotel"><i class="fas fa-bed"></i> Hotel</button>
            <button class="booking-btn" data-opens="restaurant"><i class="fas fa-utensils"></i> Restaurant</button>
        </div>

        <!-- Hotel Booking redirect -->
        <div class="booking-form-container active-form">
            <form action="<?php echo URLROOT; ?>/home/index" method="POST" class="form" name="redirectForm" onsubmit="return validateRedirect()">
                <div class="form-group">
                    <label>Arrival Date: </label>
                    <input type="date" name="arrival">
                </div>
                <div class="form-group">
                    <label>Departure Date: </label>
                    <input type="date" name="departure">
                </div>
                <input type="text" name="nameHotel" placeholder="Name">
                <input type="submit" name="bookHotel" value="Book Now">
            </form>
        </div>

        <!-- Rest Booking -->
        <div class="booking-form-container display">
            <form action="<?php echo URLROOT; ?>/home/index" method="POST" class="form" name="restBook" onsubmit="return restBookValidate()">
                <div class="form-group">
                    <label>Select Date</label>
                    <input type="date" name="restDate">
                </div>
                <select name="restAdults">
                    <option value="null">-- Adults --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="9">8</option>
                </select>
                <select name="restHour">
                    <option value="null">-- Hour --</option>
                    <option value="17">17:00</option>
                    <option value="18">18:00</option>
                    <option value="19">19:00</option>
                    <option value="20">20:00</option>
                    <option value="21">21:00</option>
                    <option value="22">22:00</option>
                </select>
                <input type="text" name="restName" placeholder="Name">
                <input type="submit" name="restaurantBook" value="Book Now">
            </form>
        </div>

        <!-- Error or Success Messages -->
        <p class="fuckingError"><?php echo $data['errorMessage']; ?></p>
        <p class="fuckingSuccess"><?php echo $data['successMessage']; ?></p>
    </div>
</section>


<!---------------------------------------------------------------- ABOUT ---------------------------------------------------------------->
<section class="about-container">
    <div class="about">
        <h1 class="title title-afterline-50">Why Hotel Juno</h1>
        <p>Juno Hotel is a simple, cosy and friendly four star Hotel at a short stroll from the Pantheon and Piazza Venezia. We are the hotel for the people who want to experience italian culture in all it's aspects.</p>
        <p>Because I am lazy, I won't think of a small description so I will use Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga eaque aperiam incidunt possimus quisquam nisi nulla ad assumenda reiciendis repellendus, doloribus ea unde maxime veritatis. Veritatis laudantium, nulla sint quidem reprehenderit doloribus sequi facilis magni, ad neque et deserunt tempore accusantium cumque optio aliquam. Similique quae aperiam aliquid, enim tenetur veniam dolores facilis quibusdam.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel perspiciatis, culpa rem voluptate incidunt molestias fugit sit illo iusto sequi temporibus fugiat libero quis sint, impedit alias dolore possimus?</p>
    </div>
</section>


<!---------------------------------------------------------------- ROOMS ---------------------------------------------------------------->
<section class="rooms-container">
    <div class="rooms">
        <h1 class="title title-afterline-30">Our Rooms</h1>
        <div class="each-room">
            <div id="wrapper">
                <div id="carousel">
                    <div id="content">
                        <?php foreach ($data['roomsResaults'] as $room) : ?>
                            <div class="card">
                                <img src="<?php echo URLROOT . "/images/" . $room->roomImage; ?>" alt="Room Image" class="item">
                                <div class="card-text">
                                    <h1><?php echo $room->roomType; ?> Room</h1>
                                    <p><?php echo $room->roomDescription; ?></p>
                                </div>
                                <div class="card-btn">
                                    <a href="<?php echo URLROOT . "/home/rooms/#" . $room->id; ?>" class="red-btn">See More...</a>
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


<!---------------------------------------------------------------- OFFERS ---------------------------------------------------------------->
<section class="offers-container">
    <div class="offers">
        <?php foreach ($data['offerResaults'] as $offer) : ?>
            <div class="offerSlide offerFade">
                <img src="<?php echo URLROOT . "/images/" . $offer->offerImage ?>" alt="Offer Image" class="offerImage">
                <div class="offerSlide-text">
                    <h4><?php echo $offer->offerName; ?></h4>
                    <p><?php echo $offer->offerDescription; ?></p>
                    <div class="offerBtn-container">
                        <a href="<?php echo URLROOT . "/home/offer/" . $offer->id; ?>">See more...</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <a class="prev offer-prev" onclick="moveOffer(-1)">&#10094;</a>
        <a class="next offer-next" onclick="moveOffer(1)">&#10095;</a>
    </div>
</section>



<!---------------------------------------------------------------- ATRACTIONS ---------------------------------------------------------------->
<section class="atraction-container">
    <h1 class="title title-afterline-30">Nearby atractions</h1>
    <div class="atraction">
        <div class="atractions-card">
            <div class="title-distance">
                <h2>The Colosseum</h2>
                <p>0.3km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, consequatur. Consequatur voluptate quaerat deleniti omnis reprehenderit nemo voluptatibus dolorem sint.</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Colosseum" class="red-btn">Discover more...</a>
            </div>

        </div>

        <div class="atractions-card">
            <div class="title-distance">
                <h2>Piazza Venezia</h2>
                <p>0.7km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate provident blanditiis quidem atque magni impedit, reprehenderit tempore velit?</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Piazza_Venezia" class="red-btn">Discover more...</a>
            </div>
        </div>

        <div class="atractions-card">
            <div class="title-distance">
                <h2>The Pantheon</h2>
                <p>2km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel ipsam hic sint officiis magni illo optio recusandae molestiae quo, iure ea reprehenderit non officia. Repellat?</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Pantheon,_Rome" class="red-btn">Discover more...</a>
            </div>
        </div>

        <div class="atractions-card">
            <div class="title-distance">
                <h2>Museo di Roma</h2>
                <p>2.5km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dicta voluptates consequuntur debitis doloremque modi veritatis eveniet, expedita, optio magnam ex unde fugiat possimus illo qui cumque! Tempore deleniti nobis odit!</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Museo_di_Roma" class="red-btn">Discover more...</a>
            </div>
        </div>

        <div class="atractions-card">
            <div class="title-distance">
                <h2>Piazza Navona</h2>
                <p>3.1km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur nisi perspiciatis sit mollitia dolorum! Nesciunt.</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Piazza_Navona" class="red-btn">Discover more...</a>
            </div>
        </div>

        <div class="atractions-card">
            <div class="title-distance">
                <h2>Vatican City</h2>
                <p>5km from the hotel</p>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae officiis quis iste dolor eveniet voluptas cum fuga, tenetur esse voluptates!.</p>
            <div class="attraction-a">
                <a href="https://en.wikipedia.org/wiki/Vatican_City" class="red-btn">Discover more...</a>
            </div>
        </div>

    </div>
</section>


<!---------------------------------------------------------------- TESTIMONIAL ---------------------------------------------------------------->
<section class="testimonials-container">
    <h1 class="title title-afterline-50">Testimonials</h1>
    <div class="testimonials">
        <div class="testimonial-wrapper">
            <?php foreach ($data['reviewsResaults'] as $review) : ?>
                <div class="testimonial-card">
                    <h1>" <?php echo $review->description ?> "</h1>
                    <p>From: <?php echo $review->fromClient; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="testimonial-prev" onclick="moveReview(-1)">&#10094;</a>
        <a class="testimonial-next" onclick="moveReview(1)">&#10095;</a>
    </div>
</section>



<!---------------------------------------------------------------- LEAVE A REVIEW ---------------------------------------------------------------->
<div class="review">
    <div class="review-form">
        <h1 class="title title-afterline-30">Stayed With Us ? <br> Please leave us a review.</h1>
        <form action="<?php echo URLROOT; ?>/home/index" method="POST" class="review-form" name="reviewForm" onsubmit="return validateReview()">
            <input type="text" name="reviewerName" placeholder="Name">
            <input type="email" name="reviewerEmail" placeholder="Email">
            <textarea name="reviewDescription" id="" cols="30" rows="10" placeholder="Message"></textarea>
            <input type="submit" name="review" value="Send">
        </form>
        <p class="message"><?php echo $data['reviewMessage']; ?></p>
    </div>
</div>





<!---------------------------------------------------------------- LOCAL JS ---------------------------------------------------------------->
<script>
    // Offers slider
    let offerIndex = 1;
    showOffer(offerIndex);

    function moveOffer(n) {
        showOffer(offerIndex += n);
    }

    function showOffer(n) {
        let offerSlides = document.querySelectorAll(".offerSlide");
        if (n > offerSlides.length) {
            offerIndex = 1;
        }
        if (n < 1) {
            offerIndex = offerSlides.length;
        }
        for (let i = 0; i < offerSlides.length; i++) {
            offerSlides[i].style.display = "none";
            offerSlides[offerIndex - 1].style.background = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5))";
        }
        offerSlides[offerIndex - 1].style.display = "block";
    }




    // Reviews slider
    let reviewIndex = 1;
    showReview(reviewIndex);

    function moveReview(n) {
        showReview(reviewIndex += n);
    }

    function showReview(n) {
        let reviewSlides = document.querySelectorAll(".testimonial-card");
        if (n > reviewSlides.length) {
            reviewIndex = 1;
        }
        if (n < 1) {
            reviewIndex = reviewSlides.length;
        }
        for (let i = 0; i < reviewSlides.length; i++) {
            reviewSlides[i].style.display = "none";
        }
        reviewSlides[reviewIndex - 1].style.display = "block";
    }




    // Booking section on the index page
    const bookingBtns = document.querySelectorAll(".booking-btn");
    const bookingForms = document.querySelectorAll(".booking-form-container");

    function remove() {
        bookingForms.forEach(form => {
            form.classList.remove("active-form");
        })
        bookingBtns.forEach(btn => {
            btn.classList.remove("active-booking-btn");
        })
    }

    bookingBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            remove();
            switch (btn.dataset.opens) {
                case "hotel":
                    bookingForms[0].classList.add("active-form");
                    bookingBtns[0].classList.add("active-booking-btn");
                    break;
                case "restaurant":
                    bookingForms[1].classList.add("active-form");
                    bookingBtns[1].classList.add("active-booking-btn");
                    break;
            }
        })
    })




    // Redirect Form Validation
    function validateRedirect() {
        // The form variables
        let arrivalDate = document.forms["redirectForm"]["arrival"].value;
        let departureDate = document.forms["redirectForm"]["departure"].value;
        let clientName = document.forms["redirectForm"]["nameHotel"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (arrivalDate == "") {
            alert("The arrival date is empty!");
            errorMessage.innerText = "The arrival date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (arrivalDate < chechAgainstDate) {
            alert("The arrival date is not valid!");
            errorMessage.innerText = "The arrival date is not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (departureDate == "") {
            alert("The departure date is empty!");
            errorMessage.innerText = "The departure date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (departureDate == arrivalDate) {
            alert("The departure date cannot be the same as the arrival date!");
            errorMessage.innerText = "The departure date cannot be the same as the arrival date!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (departureDate < arrivalDate) {
            alert("The departure date is not valid!");
            errorMessage.innerText = "The departure date is not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (clientName == "") {
            alert("Please specify a name for the reservation!");
            errorMessage.innerText = "Please specify a name for the reservation!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        }
    }




    // Restaurant Booking Form Validation
    function restBookValidate() {
        // The form variables
        let formDate = document.forms['restBook']['restDate'].value;
        let formAdults = document.forms['restBook']['restAdults'].value;
        let formTime = document.forms['restBook']['restHour'].value;
        let formClientName = document.forms['restBook']['restName'].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (formDate == "" || formDate < chechAgainstDate) {
            alert("Select date is empty!");
            errorMessage.innerText = "Select date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formDate < chechAgainstDate) {
            alert("Please choose a valid date!");
            errorMessage.innerText = "Please choose a valid date!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formAdults == "" || formAdults == "null") {
            alert("Please select the number of people!");
            errorMessage.innerText = "Please select the number of people!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formTime = "" || formTime == "null") {
            alert("Please select the hour!");
            errorMessage.innerText = "Please select the hour!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formClientName == "") {
            alert("Please specify a name for the reservation!");
            errorMessage.innerText = "Please specify a name for the reservation!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        }
    }




    // Review Form Validation
    function validateReview() {
        // The form variables
        let by = document.forms["reviewForm"]["reviewerName"].value;
        let email = document.forms["reviewForm"]["reviewerEmail"].value;
        let theReview = document.forms["reviewForm"]["reviewDescription"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".message");

        // Validation
        if (by == "") {
            alert("Please specify your name!");
            errorMessage.innerText = "Please specify your name!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (email == "") {
            alert("Please specify your email address!");
            errorMessage.innerText = "Please specify email address!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
            // maybe add a check for a valid email
        } else if (theReview == "") {
            alert("Please add text!");
            errorMessage.innerText = "Please add text!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        }
    }




    // Hide success message
    const successMessage = document.querySelector(".fuckingSuccess");
    if (successMessage !== "") {
        setTimeout(() => {
            successMessage.innerHTML = "";
            successMessage.style.animation = "fade 2s";
        }, 8000)
    }




    // Stop the form re-submit on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }




    // ROOMS CAROUSEL
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
            carousel.scrollBy(200, 0);
        }

    });
    prev.addEventListener("click", e => {
        if (carousel.scrollLeft == 0) {
            carousel.scroll(maxScrollLeft, 0)
        } else {
            carousel.scrollBy(-200, 0);
        }
    });

    let width = carousel.offsetWidth;
    console.log(width);
    window.addEventListener("resize", e => (width = carousel.offsetWidth));
</script>


<!---------------------------------------------------------------- FOOTER ---------------------------------------------------------------->
<?php
require_once APPROOT . "/views/hotel/includes/contact.php";
require_once APPROOT . "/views/hotel/includes/footer.php";
?>