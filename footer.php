<div class="footer_container">
    <!-- info section -->
    <section class="info_section ">
      <div class="container">
        <div class="contact_box">
          <a href="<?php echo get_option('map');?>">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
          </a>
          <a href="tel:<?php echo get_option('phone');?>">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </a>
          <a href="mailto:<?php echo get_option('email');?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
        <div class="info_links">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
            ));
            ?>
        </div>
        <div class="social_box">
          <a href="<?php echo get_option('facebook');?>">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="<?php echo get_option('twitter');?>">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="<?php echo get_option('linkedin');?>">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- end info_section -->
<!-- footer section -->
<footer class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br>
          Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->
<?php wp_footer();?>
  </div>
  <script>
   // Email validation handler
   function emailValidationHandler(selectors) {
            selectors.forEach(selector => {
                $(selector).on('change', function() {
                    let email = $(this).val();
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        alert('Please enter a valid email address');
                        $(this).focus();
                    }
                });
            });
        }
    
        emailValidationHandler([
            '#email'
        ]);
 // Keyup handler for alphabetic fields
 function alphabeticFieldHandler(selectors) {
            selectors.forEach(selector => {
                $(selector).keyup(function() {
                    let val = $(this).val().replace(/[^a-zA-Z\s]/g, ''); // Remove non-alphabetic, non-space characters
                    if (val.length > 0) {
                        val = val.charAt(0).toUpperCase() + val.slice(1); // Capitalize the first letter
                    }
                    $(this).val(val);
                });
            });
        }
        
        alphabeticFieldHandler([
            '#name','#address',
        ]);
        // Set maxlength for inputs
function setMaxLength(selectors, length) {
    selectors.forEach(selector => $(selector).attr('maxlength', length));
}

// Apply maxlength and numeric restriction to the input field
setMaxLength(['#phone'], 13);

$('#phone').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, ''); // Allow only numbers
});
	
</script>
</body>
</html>
