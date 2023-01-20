<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";
?>


<!-- LOCATION MESSAGE -->
<div class="location-message">
    <h1><span>Juno Hotel</span> > Rooms</h1>
</div>
<!-- END OF LOCATION MESSAGE -->


<!--ROOMS PAGE -->
<div class="big-lebowski">
    <!-- Booking redirect and check -->
    <section class="booking-container" style="margin-bottom: 0;">
        <div class="booking">
            <!--Btns-->
            <div class="bookings-btns">
                <button class="booking-btn active-booking-btn" data-opens="hotel"><i class="fas fa-bed"></i> Hotel</button>
                <button class="booking-btn" data-opens="check"><i class="far fa-clock"></i> Check Availability</button>
            </div>

            <!-- Booking redirect -->
            <div class="booking-form-container active-form">
                <form action="<?php echo URLROOT; ?>/home/rooms" method="POST" class="form" name="redirectForm" onsubmit="return validateRedirect()">
                    <div class="form-group">
                        <label>Arrival Date: </label>
                        <input type="date" name="arrival">
                    </div>
                    <div class="form-group">
                        <label>Departure Date: </label>
                        <input type="date" name="departure">
                    </div>
                    <input type="text" name="name" placeholder="Name">
                    <input type="submit" name="bookHotel" value="Book Now">
                </form>
            </div>

            <!-- Booking check -->
            <div class="booking-form-container display">
                <form action="<?php echo URLROOT; ?>/home/rooms" method="POST" class="form" name="chechHotel" onsubmit="return checkHotelAva()">
                    <div class="form-group">
                        <label>Date: </label>
                        <input type="date" name="checkDate">
                    </div>
                    <select name="checkRoom" class="type">
                        <option value="null">-- Room --</option>
                        <?php foreach ($data['rooms'] as $room) : ?>
                            <option value="<?php echo $room->roomType; ?>" data-price="<?php echo $room->roomPrice; ?>" class="prices"><?php echo ucfirst($room->roomType); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="checkHotel" value="Book Now">
                </form>
            </div>

            <!-- Error or Success Messages -->
            <p class="fuckingError"><?php echo $data['hotelMessage']; ?></p>
            <p class="fuckingSuccess"><?php echo $data['hotelMessageSuccess']; ?></p>
        </div>
    </section>
    <!-- End of Booking redirect and check -->


    <!--SMALL DESC -->
    <div class="small-desc" id="home">
        <h2 class="title">Come and experience the sights and sounds of Rome.</h2>
        <div class="small-desc-text">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus optio assumenda in, soluta omnis veritatis eius, enim illum dignissimos voluptates mollitia minima voluptatem eveniet doloribus deleniti. Labore culpa laboriosam a quisquam deleniti accusamus quos provident possimus consequatur dolor debitis aliquid laborum suscipit adipisci beatae nihil, vel obcaecati fugiat assumenda minus nulla pariatur quo? Id, labore. Repellendus neque soluta maiores iure saepe earum est quo eligendi aliquam facere quam asperiores fugit optio ex, velit illum quod nam nobis eos ab? Error molestias nisi cumque ad aperiam impedit itaque. Unde saepe, cupiditate odit sit enim error iusto adipisci veniam, quam soluta ut?</p>
            <div class="small-desc-checkin">
                <p><i class="far fa-clock"></i> &nbsp; Check in at 14:00 PM</p>
                <p><i class="far fa-clock"></i> &nbsp; Check out at 11:00 PM</p>
            </div>
        </div>
    </div>
    <!--END OF SMALL DESC -->

    <!-- Rooms and amenities -->
    <div class="rooms-list">
        <!--Btns-->
        <div class="restaurant-btns">
            <button data-opens="rooms" class="restBtn">Rooms</button>
            <button data-opens="amenities" class="restBtn">Amenities</button>
        </div>

        <div class="restaurant-container">
            <!-- Rooms -->
            <div class="rooms rommPageBtn">
                <h3 class="title title-afterline-30">Rooms</h3>
                <?php foreach ($data['rooms'] as $room) : ?>
                    <div class="room-list-card">
                        <div class="room-item" id="<?php echo $room->id; ?>">
                            <img src="<?php echo URLROOT . "/images/" . $room->roomImage; ?>" alt="Room Image">
                            <div class="room-item-text">
                                <h1><?php echo $room->roomType; ?> Room</h1>
                                <div class="room-details-split">
                                    <h2><?php echo $room->roomBed; ?></h2>
                                    <h2><?php echo $room->roomSize; ?> m²</h2>
                                </div>
                                <h2 class="room-item-price">$ <?php echo $room->roomPrice; ?></h2>
                                <h2><?php echo $room->roomDescription; ?></h2>
                                <div class="ameneties">
                                    <i class="fas fa-wifi"></i>
                                    <i class="fas fa-shower"></i>
                                    <i class="fas fa-tv"></i>
                                    <i class="fas fa-restroom"></i>
                                    <i class="fab fa-playstation"></i>
                                    <i class="fas fa-thermometer-quarter"></i>
                                    <i class="fas fa-blender-phone"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Amenities -->
            <div class="amenities rommPageBtn">
                <h3 class="title title-afterline-30">Amenities</h3>

                <div class="room-list-card">
                    <div class="room-item">
                        <img src="<?php echo URLROOT; ?>/images/amenity-1.jpg" alt="Room Image">
                        <div class="room-item-text">
                            <h1 class="amenities-title">Pet Friendly</h1>
                            <h2 class="amenities-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, aliquid obcaecati laborum reprehenderit, totam porro quia dignissimos itaque voluptate sunt excepturi debitis ipsa quaerat. Quae error tenetur quibusdam impedit inventore amet cum laborum vitae, necessitatibus veniam ad earum aspernatur aliquid ipsum vero? Reprehenderit optio hic labore mollitia consequatur voluptatem facilis.</h2>
                            <div class="ameneties">
                                <i class="fas fa-cat"></i>
                                <i class="fas fa-dog"></i>
                                <i class="fas fa-fish"></i>
                                <i class="fas fa-dove"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="room-list-card">
                    <div class="room-item">
                        <img src="<?php echo URLROOT; ?>/images/amenity-2.jpg" alt="Room Image">
                        <div class="room-item-text">
                            <h1 class="amenities-title">Hotel Library</h1>
                            <h2 class="amenities-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cum illum numquam voluptate vero? Nulla quos adipisci veniam molestiae culpa architecto reiciendis eligendi, placeat voluptatibus consectetur consequatur repudiandae! Maxime, ut! Debitis quibusdam sequi odit, ea ipsum doloribus quos similique?</h2>
                            <div class="ameneties">
                                <i class="fas fa-book"></i>
                                <i class="fas fa-book-open"></i>
                                <i class="fas fa-chess"></i>
                                <i class="fas fa-pen"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="room-list-card">
                    <div class="room-item">
                        <img src="<?php echo URLROOT; ?>/images/amenity-3.jpg" alt="Room Image">
                        <div class="room-item-text">
                            <h1 class="amenities-title">Children Play Area</h1>
                            <h2 class="amenities-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora sunt voluptatum id inventore repellendus veniam distinctio omnis eveniet odit et. Doloremque minus tempora id sint repudiandae modi quibusdam debitis, illum quos ratione, eius blanditiis est magnam beatae nam quis fugiat quo aut! Cumque vero possimus ab ipsam.</h2>
                            <div class="ameneties">
                                <i class="fas fa-shapes"></i>
                                <i class="fas fa-child"></i>
                                <i class="fas fa-baby"></i>
                                <i class="fas fa-birthday-cake"></i>
                                <i class="fas fa-apple-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="room-list-card">
                    <div class="room-item">
                        <img src="<?php echo URLROOT; ?>/images/amenity-4.jpg" alt="Room Image">
                        <div class="room-item-text">
                            <h1 class="amenities-title">Outdoor Garden</h1>
                            <h2 class="amenities-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, ex! Sunt ea tempore animi possimus magnam nemo repellat a est placeat, officiis labore ipsum deleniti iusto pariatur reiciendis! Eos voluptatibus sapiente exercitationem officiis ipsum distinctio error veritatis dicta, libero harum a?</h2>
                            <div class="ameneties">
                                <i class="fas fa-leaf"></i>
                                <i class="fab fa-pagelines"></i>
                                <i class="fas fa-tree"></i>
                                <i class="fas fa-couch"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="room-list-card">
                    <div class="room-item">
                        <img src="<?php echo URLROOT; ?>/images/amenity-5.jpg" alt="Room Image">
                        <div class="room-item-text">
                            <h1 class="amenities-title">Covered & Protected Parking</h1>
                            <h2 class="amenities-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur, ex! Sunt ea tempore animi possimus magnam nemo repellat a est placeat, officiis labore ipsum deleniti iusto pariatur reiciendis! Eos voluptatibus sapiente exercitationem officiis ipsum distinctio error veritatis dicta, libero harum a?</h2>
                            <div class="ameneties">
                                <i class="fas fa-parking"></i>
                                <i class="fas fa-charging-station"></i>
                                <i class="fas fa-car"></i>
                                <i class="fas fa-umbrella"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Amenities -->

        </div>
    </div>


    <!-- BOOKING BTN -->
    <div class="book-btn-container">
        <a href="<?php echo URLROOT . "/home/hotelBooking/" . date('Y-m-d') . "/" . date('Y-m-d') . "/" . "name"; ?>" class="book-btn">Book Now</a>
    </div>
    <!-- END OF BOOKING BTN -->
</div>



<script>
    // Redirect Form Validation
    function validateRedirect() {
        // The form variables
        let arrivalDate = document.forms["redirectForm"]["arrival"].value;
        let departureDate = document.forms["redirectForm"]["departure"].value;
        let clientName = document.forms["redirectForm"]["name"].value;

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



    // Check Availability Form Validation
    function checkHotelAva() {
        // The form variables
        let checkDate = document.forms["chechHotel"]["checkDate"].value;
        let checkRoom = document.forms["chechHotel"]["checkRoom"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;


        console.log(chechAgainstDate);
        // Validation
        if (checkDate == "") {
            alert("The arrival date is empty!");
            errorMessage.innerText = "The arrival date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (checkDate < chechAgainstDate) {
            alert("The arrival date is not valid!");
            errorMessage.innerText = "The arrival date is not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (checkRoom == "") {
            alert("Please select a room!");
            errorMessage.innerText = "Please select a room!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (checkRoom == "null") {
            alert("Please select a room!");
            errorMessage.innerText = "Please select a room!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        }
    }




    // Display rooms or amenities on click
    const restaurantBtns = document.querySelectorAll(".restBtn");
    const restaurantTabs = document.querySelectorAll(".rommPageBtn");
    restaurantBtns[0].classList.add("active");
    restaurantTabs[0].style.display = "block";

    function removeActiveClass() {
        for (let i = 0; i < restaurantBtns.length; i++) {
            restaurantBtns[i].classList.remove("active");
        }
    }

    restaurantBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            removeActiveClass();
            btn.classList.add("active");

            for (let i = 0; i < restaurantTabs.length; i++) {
                restaurantTabs[i].style.display = "none";

                if (restaurantTabs[i].classList.contains(btn.dataset.opens)) {
                    restaurantTabs[i].style.display = "block";
                }
            }
        })
    })




    // Booking btns, hotel or check
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
                case "check":
                    bookingForms[1].classList.add("active-form");
                    bookingBtns[1].classList.add("active-booking-btn");
                    break;
            }
        })
    })




    // Hide success message
    const successMessage = document.querySelector(".fuckingSuccess");
    if (successMessage !== "") {
        setTimeout(() => {
            successMessage.innerHTML = "";
            successMessage.style.animation = "fade 2s";
        }, 8000)
    }




    // Stop the form re-submiting on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


<!-- FOOTER -->
<?php
require_once APPROOT . "/views/hotel/includes/contact.php";
require_once APPROOT . "/views/hotel/includes/footer.php";
?>