<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";
?>
<!-- LOCATION MESSAGE -->
<div class="location-message">
    <h1><span>Juno Hotel</span> > Restaurant</h1>
</div>
<!-- END OF LOCATION MESSAGE -->

<!-- RESTAURANT PAGE -->
<div class="big-lebowski">

    <!-- Booking and check -->
    <section class="booking-container" style="margin-bottom: 0;">
        <div class="booking">
            <div class="bookings-btns">
                <button class="booking-btn active-booking-btn" data-opens="restaurant"><i class="fas fa-utensils"></i> Restaurant</button>
                <button class="booking-btn" data-opens="check"><i class="far fa-clock"></i> Check Availability</button>
            </div>

            <!-- Booking -->
            <div class="booking-form-container active-form">
                <form action="<?php echo URLROOT; ?>/home/restaurant" method="POST" class="form" name="restBook" onsubmit="return restBookValidate()">
                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="date" name="date">
                    </div>
                    <select name="adults">
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
                    <select name="time">
                        <option value="null">-- Hour --</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                        <option value="20">20:00</option>
                        <option value="21">21:00</option>
                        <option value="22">22:00</option>
                    </select>
                    <input type="text" name="clientName" placeholder="Name">
                    <input type="submit" name="bookRestaurant" value="Book Now">
                </form>
            </div>

            <!-- Check -->
            <div class="booking-form-container display">
                <form action="<?php echo URLROOT; ?>/home/restaurant" method="POST" class="form" name="restCheck" onsubmit="return checkRestAvailValidate()">
                    <div class="form-group">
                        <label>Select Date</label>
                        <input type="date" name="checkDay">
                    </div>
                    <select name="checkHour">
                        <option value="null">-- Hour --</option>
                        <option value="17">17:00</option>
                        <option value="18">18:00</option>
                        <option value="19">19:00</option>
                        <option value="20">20:00</option>
                        <option value="21">21:00</option>
                        <option value="22">22:00</option>
                    </select>
                    <input type="submit" name="checkRest" value="Book Now">
                </form>
            </div>

            <!-- Error or Success Messages -->
            <p class="fuckingError"><?php echo $data['restMessage']; ?></p>
            <p class="fuckingSuccess"><?php echo $data['restMessageSuccess']; ?></p>
        </div>
    </section>
    <!-- End of Booking and check -->



    <!--SMALL DESC -->
    <div class="small-desc" id="home">
        <h2 class="title">Come and experience the sights and sounds of Rome.</h2>
        <div class="small-desc-text">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus optio assumenda in, soluta omnis veritatis eius, enim illum dignissimos voluptates mollitia minima voluptatem eveniet doloribus deleniti. Labore culpa laboriosam a quisquam deleniti accusamus quos provident possimus consequatur dolor debitis aliquid laborum suscipit adipisci beatae nihil, vel obcaecati fugiat assumenda minus nulla pariatur quo? Id, labore. Repellendus neque soluta maiores iure saepe earum est quo eligendi aliquam facere quam asperiores fugit optio ex, velit illum quod nam nobis eos ab? Error molestias nisi cumque ad aperiam impedit itaque. Unde saepe, cupiditate odit sit enim error iusto adipisci veniam, quam soluta ut? <br><span class="condition-bold">Restaurant reservations are available from 17:00 PM, we are open for breakfast and lunch and they do not require reservation. If you made a reservation remember to use the name the reservation was made with.</span></p>
            <div class="small-desc-checkin">
                <p><i class="far fa-clock"></i> &nbsp; We open at 07:00 AM</p>
                <p><i class="far fa-clock"></i> &nbsp; We close at 23:00 PM</p>
            </div>
        </div>
    </div>
    <!--END OF SMALL DESC -->


    <!--RESTAURANT CONTENT -->
    <div class="rooms-list">
        <div class="restaurant-btns">
            <button data-opens="menu" class="restBtn">Menu</button>
            <button data-opens="events" class="restBtn">Events</button>
        </div>

        <!-- Menu -->
        <div class="restaurant-container">
            <div class="menu restTab">
                <h1 class="title title-afterline-30">Our Menu</h1>
                <?php foreach ($data['menuItems'] as $menu) : ?>
                    <div class="menu-list-card">
                        <div class="menu-item">
                            <img src="<?php echo URLROOT . "/images/" . $menu->img; ?>" alt="Menu Image">
                            <div class="menu-item-text">
                                <h1><?php echo $menu->name; ?></h1>
                                <div class="menu-details">
                                    <h2><?php echo $menu->ingredients; ?></h2>
                                </div>
                                <h2 class="menu-item-price">$ <?php echo $menu->price; ?></h2>
                                <h2><?php echo $menu->description; ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Events -->
            <div class="events restTab">
                <h1 class="title title-afterline-30">Events</h1>
                <?php foreach ($data['eventsItems'] as $events) : ?>
                    <div class="menu-list-card">
                        <div class="menu-item">
                            <img src="<?php echo URLROOT . "/images/" . $events->img; ?>" alt="Event Image" width="300px" height="300px">
                            <div class="menu-item-text">
                                <h1><?php echo $events->name; ?></h1>
                                <div class="menu-details">
                                    <h2>Event Day:&nbsp;
                                        <?php
                                        $day = date_create($events->day);
                                        echo date_format($day, "D d F, Y");
                                        ?>
                                    </h2>
                                </div>
                                <h2 class="menu-item-price event-price">Event Price:&nbsp; $ <?php echo $events->price; ?></h2>
                                <h2><?php echo $events->details; ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>

    </div>
</div>





<script>
    // Restaurant Booking Form Validation
    function restBookValidate() {
        // The form variables
        let formDate = document.forms['restBook']['date'].value;
        let formAdults = document.forms['restBook']['adults'].value;
        let formTime = document.forms['restBook']['time'].value;
        let formClientName = document.forms['restBook']['clientName'].value;

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




    // Check Restaurant Availability Form Validation
    function checkRestAvailValidate() {
        // The form variables
        let checkDate = document.forms["restCheck"]["checkDay"].value;
        let checkHour = document.forms["restCheck"]["checkHour"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (checkDate == "") {
            alert("Select date is empty!");
            errorMessage.innerText = "Select date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (checkDate < chechAgainstDate) {
            alert("Please choose a valid date!");
            errorMessage.innerText = "Please choose a valid date!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (checkHour == "" || checkHour == "null") {
            alert("Please select the hour!");
            errorMessage.innerText = "Please select the hour!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        }
    }




    // Section btns
    const restaurantBtns = document.querySelectorAll(".restBtn");
    const restaurantTabs = document.querySelectorAll(".restTab");
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




    // Booking section on the Restaurant page
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
                case "restaurant":
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




    // Hide success text
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
</script>


<!-- FOOTER -->
<?php
require_once APPROOT . "/views/hotel/includes/contact.php";
require_once APPROOT . "/views/hotel/includes/footer.php";
?>