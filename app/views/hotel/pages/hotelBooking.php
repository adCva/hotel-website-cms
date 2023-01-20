<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";

if (!$data['arrival']) {
    header("Location:" . URLROOT . "/home");
    die();
}
?>

<!-- LOCATION MESSAGE -->
<div class="location-message">
    <h1><span>Juno Hotel</span> > Hotel Room Booking</h1>
</div>
<!-- END OF LOCATION MESSAGE -->


<div class="hotelBooking-container">
    <div class="hotelBooking" id="home">

        <div class="booking-wrapper">

            <div class="booking-form">

                <!-- FORM -->
                <form action="<?php echo URLROOT; ?>/home/setBooking" method="POST" class="reserv-form" name="bookingFormHotel" onsubmit="return bookingValidation()">
                    <div class="form-group-three">
                        <div class="reserv-group">
                            <label>Arrival Date: </label>
                            <input type="date" name="arrival" value="<?php echo $data['arrival']; ?>" class="arive">
                        </div>

                        <div class="reserv-group">
                            <label>Departure Date: </label>
                            <input type="date" name="departure" value="<?php echo $data['departure']; ?>" class="departure">
                        </div>

                        <select name="roomTotal" id="rooms">
                            <option value="null">-- Rooms Nr --</option>
                            <option value="1">1 Room</option>
                            <option value="2">2 Rooms</option>
                            <option value="3">3 Rooms</option>
                            <option value="4">4 Rooms</option>
                            <option value="5">5 Rooms</option>
                        </select>
                    </div>

                    <div class="form-group-three">
                        <select name="persons" class="persons">
                            <option value="null">-- Adults --</option>
                            <option value="1">1 Person</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                            <option value="5">5 Persons</option>
                        </select>

                        <select name="kids" class="kids">
                            <option value="null">-- Kids --</option>
                            <option value="0">0 Kids</option>
                            <option value="1">1 Kid</option>
                            <option value="2">2 Kids</option>
                            <option value="3">3 Kids</option>
                            <option value="4">4 Kids</option>
                            <option value="5">5 Kids</option>
                        </select>

                        <select name="room" class="type">
                            <?php foreach ($data['rooms'] as $room) : ?>
                                <option value="<?php echo $room->roomType; ?>" data-price="<?php echo $room->roomPrice; ?>" class="prices"><?php echo ucfirst($room->roomType); ?> Room</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group-three">
                        <input type="text" name="name" value="<?php echo $data['name']; ?>" class="nameInput">
                        <input type="email" name="email" placeholder="Email *">
                        <input type="text" name="phone" placeholder="Phone (Optional)">
                    </div>
                    <input type="submit" name="book" value="Book">
                </form>
                <!-- END OF FORM -->


                <!-- Error or Success Messages -->
                <p class="fuckingError"><?php echo $data['error']; ?></p>


                <!-- ROOMS -->
                <div class="rooms" style="margin-top: 4rem;">
                    <?php foreach ($data['rooms'] as $room) : ?>
                        <div class="book-list-card">
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
            </div>
            <!-- END OF ROOMS -->

        </div>

        <!-- BILL -->
        <div class="booking-bill">
            <div class="bill">
                <h1><i class="fas fa-money-bill-wave-alt"></i>&nbsp; Bill Details</h1>
                <div class="bill-group">
                    <h3 id="arrival">
                        <span>Arrive: </span>
                        <?php
                        $arrive = date_create($data['arrival']);
                        echo date_format($arrive, "D M d Y");
                        ?>
                    </h3>
                    <h3 id="departure">
                        <span>Leave: </span>
                        <?php
                        $leave = date_create($data['departure']);
                        echo date_format($leave, "D M d Y");
                        ?>
                    </h3>
                </div>
                <div class="column-group">
                    <h3 id="room">Room Type: &nbsp; Standard</h3>
                    <h3 id="roomsNr">Rooms Number: &nbsp; 1 Room</h3>
                    <h3 id="nameDisplay">For: &nbsp; <?php echo $data['name']; ?></h3>
                    <h3 id="adults">Adults: &nbsp; 1 Person</h3>
                    <h3 id="kids">Kids: &nbsp; 0 Kids</h3>
                </div>
                <div class="bill-group">
                    <h3>Total</h3>
                    <h3 id="total">$ 62</h3>
                </div>
            </div>
        </div>
        <!-- END OF BILL -->

    </div>
</div>


<script>
    // Booking page update display (on bill).
    const arrive = document.getElementById("arrival");
    const departure = document.getElementById("departure");
    const roomType = document.getElementById("room");
    const roomsNr = document.getElementById("roomsNr");
    const adults = document.getElementById("adults");
    const kids = document.getElementById("kids");
    const total = document.getElementById("total");
    const name = document.getElementById("nameDisplay");


    // Update Arrival Date
    const ariveInput = document.querySelector(".arive");
    ariveInput.addEventListener("change", () => {
        let arriveDate = new Date(ariveInput.value);
        arrive.innerHTML = `<span>Arrive: </span> ${arriveDate.toDateString()}`;
    });


    // Update Departure Date
    const departureInput = document.querySelector(".departure");
    departureInput.addEventListener("change", () => {
        let departureDate = new Date(departureInput.value);
        departure.innerHTML = `<span>Leave: </span> ${departureDate.toDateString()}`;
    });


    // Update Room Type 
    const roomTypeInput = document.querySelector(".type");
    let price = 0;
    roomTypeInput.addEventListener("change", () => {
        roomType.innerHTML = `<h3 id="room">Room Type: &nbsp; ${roomTypeInput.value}</h3>`;
        price = roomTypeInput.value;

    });


    // Update Rooms Nr 
    const roomsFormInput = document.getElementById("rooms")
    roomsFormInput.addEventListener("change", () => {
        roomsNr.innerHTML = `<h3 id="roomsNr">Rooms Number: &nbsp; ${roomsFormInput.value} Room</h3>`;
    });


    // Update Name
    const nameInput = document.querySelector(".nameInput");
    nameInput.addEventListener("change", () => {
        console.log('test name');
        name.innerHTML = `<h3 id="nameDisplay">For: &nbsp; ${nameInput.value}</h3>`;
    });


    // Update Nr Of Adults 
    const personsInput = document.querySelector(".persons");
    personsInput.addEventListener("change", () => {
        if (personsInput.value < 2) {
            adults.innerHTML = `<h3 id="adults">Adults: &nbsp; ${personsInput.value} Person</h3>`;
        } else {
            adults.innerHTML = `<h3 id="adults">Adults: &nbsp; ${personsInput.value} Persons</h3>`;
        }
    });


    // Update Nr Of Kids Date
    const kidsInput = document.querySelector(".kids");
    kidsInput.addEventListener("change", () => {
        if (kidsInput.value == 1) {
            kids.innerHTML = `<h3 id="kids">Kids: &nbsp; ${kidsInput.value} Kid</h3>`;
        } else {
            kids.innerHTML = `<h3 id="kids">Kids: &nbsp; ${kidsInput.value} Kids</h3>`;
        }
    });


    // Update Total Price Date
    const prices = document.querySelectorAll(".prices");
    const roomsTotal = document.getElementById("rooms");
    const type = document.querySelector(".type");
    let rooms = 1;
    let getPrice = prices[0].dataset.price;

    roomsTotal.addEventListener("change", () => {
        rooms = roomsTotal.value;
    })

    type.addEventListener("change", () => {
        let optionIndex = type.options.selectedIndex;
        for (let i = 0; i < prices.length; i++) {
            getPrice = prices[optionIndex].dataset.price;
        }
    })

    class Price {
        constructor(price, rooms) {
            this.price = price;
            this.rooms = rooms;
        }

        calcTotal() {
            return this.price * this.rooms;
        }
    }

    window.addEventListener("change", () => {
        let price1 = new Price(getPrice, rooms);
        let resault = price1.calcTotal();

        total.innerHTML = `<h3 id="total">$ ${price1.calcTotal()}</h3>`;
    })




    // Booking Form Validation
    function bookingValidation() {
        // The form variables
        let formArrival = document.forms["bookingFormHotel"]["arrival"].value;
        let formDeparture = document.forms["bookingFormHotel"]["departure"].value;
        let formTotalRooms = document.forms["bookingFormHotel"]["roomTotal"].value;
        let formAdults = document.forms["bookingFormHotel"]["persons"].value;
        let formKids = document.forms["bookingFormHotel"]["kids"].value;
        let formRoom = document.forms["bookingFormHotel"]["room"].value;
        let formName = document.forms["bookingFormHotel"]["name"].value;
        let formEmail = document.forms["bookingFormHotel"]["email"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (formArrival == "") {
            alert("The arrival date is empty!");
            return false;
        } else if (arrival < chechAgainstDate) {
            alert("The arrival date is not valid!");
            errorMessage.innerText = "The arrival date is not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formDeparture == "") {
            alert("The departure date is empty!");
            errorMessage.innerText = "The departure date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formDeparture == formArrival) {
            alert("The departure date cannot be the same as the arrival date!");
            errorMessage.innerText = "The departure date cannot be the same as the arrival date!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formDeparture < formArrival) {
            alert("The departure date is not valid!");
            errorMessage.innerText = "The departure date is not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formTotalRooms == "null") {
            alert("Please select how many rooms you want to book!");
            errorMessage.innerText = "Please select how many rooms you want to book!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formAdults == "null") {
            alert("Please select how many adults!");
            errorMessage.innerText = "Please select how many adults!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formKids == "null") {
            alert("Please select how many kids!");
            errorMessage.innerText = "Please select how many kids!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formRoom == "") {
            alert("Please select what type of room do you want!");
            errorMessage.innerText = "Please select what type of room do you want!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formName == "") {
            alert("Please give us your name so that we can give it to our reptilian friends!");
            errorMessage.innerText = "Please give us your name so that we can give it to our reptilian friends!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (formEmail == "") {
            alert("We want to spam you with useless stuff even after you clearly mentioned you don't want anything more. So give us your email!");
            errorMessage.innerText = "We want to spam you with useless stuff even after you clearly mentioned you don't want anything more. So give us your email!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else {
            alert("At this point the form was submitted successfully and in a normal situation the booking is created and will appear in the HMS. However, there is no SMTP to automatically send the confirmation email set in controller/Home.php->setBooking() so the script will throw an error. Also, no payment page because laziness.");
            return false;
        }
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