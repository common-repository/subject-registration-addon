<?php



// HELP PAGE CALLBACK
function rsgsrf_help_page(){
    ?>
    <link href="<?php echo rsgsrf_lib.'lity/dist/lity.css'; ?>" rel="stylesheet">
    <script src="<?php echo rsgsrf_lib.'lity/dist/lity.js'; ?>"></script>

    <div class="rsgsrf_help_page rynerg_rsgsrf">

        <div class="rsgsrf__title">
            <p class="rsgsrf_big_title">Help</p>
        </div>
        <div class="rsgsrf__contents rsgsrf_admin">
            <br>
            <div class="rsgsrf__contents_table" style="background-color: #fff; padding:10px;">
                <p>
                    Welcome and thank you for using this addon.<br>
                    This helps in adding different subjects with their respective prices for different school levels and types.
                </p>
                <p>
                    If you are using the <a href="#">Gravity Forms</a> Plugin to display your registration form, simply add the different classes to bind the contents added here.
                </p>
                <p>
                    <span class="rsgsrf_reg_title">rsgsrf_reg_form</span> Add this to the form class. To add the class, just go to Admin Dashboard -> Forms -> Your Form -> Settings -> CSS Class Name<br>
                    <a href="<?php echo rsgsrf_admin_img; ?>img1.png" data-lity style="padding:10px; ">
                        <img src="<?php echo rsgsrf_admin_img; ?>img1.png" width='300'>
                    </a>
                </p>
                <br>
                <p>
                    <span class="rsgsrf_reg_title">rsgsrf_form_subjects</span> Add this class to an HTML block. To add the class, just go to Forms -> Your Form -> Add Standar Field -> Choose HTML. 
                    <br>At the HTML block go to the Appearance Option then add the class to "Custom CSS Class". This will display the tables you created.<br>
                    <a href="<?php echo rsgsrf_admin_img; ?>img2.png" data-lity style="padding:10px; ">
                        <img src="<?php echo rsgsrf_admin_img; ?>img2.png" width='300'>
                    </a>
                </p>
                <br>
                <p>
                    <span class="rsgsrf_reg_title">rsgsrf_form_price</span> Since this includes product prices, add this class to a Product Block. To add this, go to Forms-> -> Your Form -> Add Pricing Field -> Choose "Product".
                    <br>
                    &emsp;General Options<br>
                    &emsp;&emsp;Field Label: Price<br>
                    &emsp;&emsp;Field Type: User Defined Price<br>
                    <br>
                    &emsp;Appearance Option <br>
                    &emsp;&emsp;Custom CSS Class: rsgsrf_form_price
                    <br>
                    <a href="<?php echo rsgsrf_admin_img; ?>img3.png" data-lity style="padding:10px; ">
                        <img src="<?php echo rsgsrf_admin_img; ?>img3.png" width='300'>
                    </a>
                </p>
                <br>
                <p>
                    <span class="rsgsrf_reg_title">rsgsrf_form_added_subjects</span> To display the added subjects at the notification and frontend form, add this class.<br>
                    First, add a field from Forms -> Your Form -> "Advanced Fields". Select the "List" field.
                    <br>
                    &emsp;General Options<br>
                    &emsp;&emsp;Field Label: Subjects Added<br>
                    <br>
                    &emsp;Appearance Option <br>
                    &emsp;&emsp;Custom CSS Class: rsgsrf_form_added_subjects
                    <br>
                    &emsp;Advanced Option <br>
                    &emsp;&emsp;Check the "Allow field to be populated dynamically"
                    <br>
                    <a href="<?php echo rsgsrf_admin_img; ?>img4.png" data-lity style="padding:10px; ">
                        <img src="<?php echo rsgsrf_admin_img; ?>img4.png" width='300'>
                    </a>
                </p>
            </div>
        </div>
    </div>
    <?php
}
