<?php
require_once APPROOT . "/views/hotel/includes/header.php";
require_once APPROOT . "/views/hotel/includes/navbar.php";
?>


<!-- LOCATION MESSAGE -->
<div class="location-message">
    <h1><span>Juno Hotel</span> > Contact</h1>
</div>
<!-- END OF LOCATION MESSAGE -->


<div class="big-lebowski" id="home">
    <div class="contact">

        <!-- Map and access details -->
        <div class="map">
            <div class="access">
                <h1>Find Us</h1>
                <h3>184 Roma, Piazza del Colosseo, Italia</h3>
                <p><i class="fas fa-car-side"></i> &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                <p><i class="fas fa-bus"></i> &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni.</p>
                <p><i class="fas fa-train"></i> &nbsp; Termini: Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                <p><i class="fas fa-plane"></i> &nbsp; Ciampino: Lorem ipsum dolor sit amet.</p>
                <p><i class="fas fa-plane"></i> &nbsp; Fiumicino: Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto.</p>
            </div>
            <a href="https://www.google.com/maps/@41.8905382,12.4914913,18z"> <img src="<?php echo URLROOT; ?>/images/map.jpg" alt="Map Image"></a>
        </div>
    </div>

    <!-- Contact Details -->
    <div class="contact-details-container">
        <div class="contact-details">
            <p><i class="fas fa-map-marker"></i> &nbsp; Piazza del Colosseo, 184 Roma, Italia</p>
            <p><i class="fas fa-phone-alt"></i> &nbsp; +0123-456-7890</p>
            <p><i class="fas fa-envelope"></i> &nbsp; email@email.com</p>
            <p><i class="fas fa-comment"></i> &nbsp; +0123456789012345</p>
        </div>
    </div>


    <!-- Request help form -->
    <div class="contact">
        <div class="request-form">
            <h1>Contact Us</h1>
            <p>If you need any assistance or have any questions, please contact us.</p>
            <p class="success"><?php echo $data['success']; ?></p>
            <form action="<?php echo URLROOT; ?>/home/contact" method="POST" class="contact-form" name="requestForm" onsubmit="return requestHelpValidate()">
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <label>You Need The Response Until</label>
                <input type="date" name="deadline">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Message"></textarea>
                <input type="submit" name="send" value="Send">
            </form>

            <!-- Error or Success Messages -->
            <p class="fuckingError"></p>
            <p class="fuckingSuccess"></p>
        </div>
    </div>
</div>



<script>
    // Request Help Form Validation
    function requestHelpValidate() {
        // The form variables
        let name = document.forms["requestForm"]["name"].value;
        let email = document.forms["requestForm"]["email"].value;
        let deadline = document.forms["requestForm"]["deadline"].value;
        let description = document.forms["requestForm"]["description"].value;

        //Error message <p>
        let errorMessage = document.querySelector(".fuckingError");

        // Check Against Date
        let year = new Date().getFullYear();
        let month = new Date().getMonth() < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1;
        let day = new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate();
        let chechAgainstDate = `${year}-${month}-${day}`;

        // Validation
        if (name == "") {
            alert("Please specify a name!");
            errorMessage.innerText = "Please specify a name!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (email == "") {
            alert("Please specify email address!");
            errorMessage.innerText = "Please specify email address!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (deadline == "") {
            alert("The deadline date is empty!");
            errorMessage.innerText = "The deadline date is empty!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (deadline < chechAgainstDate) {
            alert("The deadline date not valid!");
            errorMessage.innerText = "The deadline date not valid!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else if (description == "") {
            alert("Please add text!");
            errorMessage.innerText = "Please add text!";
            setTimeout(() => {
                errorMessage.innerHTML = "";
                errorMessage.style.animation = "fade 2s";
            }, 4000)
            return false;
        } else {
            alert("At this point the form was submitted successfully and in a normal situation the help request is created and will appear in the HMS. However, there is no SMTP to automatically send the confirmation email set in controller/Home.php->contact() so the script will throw an error.");
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
require_once APPROOT . "/views/hotel/includes/footer.php";
?>