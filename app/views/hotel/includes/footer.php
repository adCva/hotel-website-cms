<section class="footer-container">
    <div class="footer">

        <!-- Footer Main -->
        <div class="footer-wrapper">

            <!-- Footer group, logo and social -->
            <div class="footer-group">
                <div class="footer-logo">
                    <h1 class="footer-logo-icon"><i class="fas fa-h-square"></i></h1>
                    <div class="footer-logo-name-star">
                        <h1 class="footer-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h1>
                        <h1>Juno Hotel</h1>
                    </div>
                </div>
                <div class="footer-icons">
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fab fa-tripadvisor"></i></a>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fab fa-twitter-square"></i></a>
                </div>
            </div>

            <!-- Footer group, contact -->
            <div class="footer-group">
                <h2 class="footer-subtitle">Contact Us</h2>
                <p><i class="fas fa-envelope"></i> &nbsp; email@email.com</p>
                <p><i class="fas fa-map-marker-alt"></i> &nbsp; Piazza del Colosseo, 184 Roma, Italia</p>
                <p><i class="fas fa-phone-alt"></i> &nbsp; +0123-456-7890</p>
            </div>

            <!-- Footer group, desc -->
            <div class="footer-group">
                <h2 class="footer-desc">Juno Hotel is a simple, cosy and friendly four star Hotel at a short stroll from the Pantheon and Piazza Venezia. We are the hotel for the people who want to experience italian culture in all it's aspects.</h2>
            </div>

        </div>
        <!-- End of Footer Main -->

    </div>
</section>


<!-- Footer Sec -->
<div class="copywrite-container">
    <a id="scrollToTop" href="#"><i class="fas fa-chevron-up"></i></a>
    <div class="footer">
        <p class="ending">&copy; <?php echo date('Y'); ?> Juno Hotel. All rights reserved.</p>
    </div>
</div>
<!-- Footer Sec -->



<script>
    // Scroll to top.
    const scrollToTopBtn = document.getElementById('scrollToTop');
    scrollToTopBtn.addEventListener('click', () => window.scrollTo({
        top: 0,
        behavior: 'smooth'
    }));


    // Open menu on mobile (for navbar).
    let mobileBtn = document.getElementById("mobile_btn");
    let menu = document.getElementById("menu");
    mobileBtn.addEventListener("click", () => {
        menu.classList.toggle("active-menu");
        if (menu.classList.contains("active-menu")) {
            mobileBtn.innerHTML = "<i class='fas fa-times'></i>";
        } else {
            mobileBtn.innerHTML = "<i class='fas fa-bars'></i>";
        }
    });


    // Highlight current page (on navbar).
    let dataPage = document.querySelectorAll("[data-page]");
    let local = ((window.location.pathname).split('/'))[3];
    for (let i = 0; i < dataPage.length; i++) {
        if (dataPage[i].dataset.page === local) {
            dataPage[i].classList.toggle("active-page");
        }
    }
</script>


<!--The End-->
</body>

</html>