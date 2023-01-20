<?php
require_once APPROOT . "/views/hotel/includes/header.php";
?>

<!-- Success Messages -->
<div class="message-container">
    <h1><i class="fas fa-check-circle"></i></h1>
    <?php if ($data['message'] == "restaurant") : ?>
        <h2>Your restaurant reservation is made.<br> Thank you for booking your dinner with us! For any further information, please contact us on our phone <span class="special-char">+04-0123456789</span> or on our email at <span class="special-char">email@email.com</span>.<br>We look forward to seeing you.</h2>
    <?php elseif ($data['message'] == "hotel") : ?>
        <h2>Your hotel reservation is made.<br> Thank you for booking your stay with us! For any further information, please contact us on our phone <span class="special-char">+04-0123456789</span> or on our email at <span class="special-char">email@email.com</span>.<br>We look forward to seeing you.</h2>
    <?php elseif ($data['message'] == "review") : ?>
        <h2>Thank you for your review.<br>For any further information, please contact us on our phone <span class="special-char">+04-0123456789</span> or on our email at <span class="special-char">email@email.com</span></h2>
    <?php elseif ($data['message'] == "help") : ?>
        <h2>We register your request and we will come back to you with a replay as soon as possible. If time is of the essence, please search your answer on our page.<br>For any further information, please contact us on our phone <span class="special-char">+04-0123456789</span> or on our email at <span class="special-char">email@email.com</span></h2>
    <?php endif; ?>
    <p class="countdown-text">You will be redirected to the home page in</p>
    <p class="countdown">20</span></p>
    <a href="<?php echo URLROOT; ?>/home/index" class="countdown-link-back">Back Home</a>
</div>
<!-- End of Success Messages -->

<script>
    // Update countdown and redirect to home page
    let countdown = 20;
    const count = document.querySelector(".countdown");
    setInterval(() => {
        countdown--;
        count.innerHTML = countdown;
    }, 1000)
    setTimeout(() => {
        window.location.replace("http://localhost/juno/home");
    }, 20000)
</script>