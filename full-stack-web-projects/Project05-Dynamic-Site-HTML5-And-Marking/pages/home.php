<section class="banner-container">
    <div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form.jpg');" class="banner-single"></div><!--banner-single-->
    <div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form2.jpg');" class="banner-single"></div><!--banner-single-->
    <div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form3.jpg');" class="banner-single"></div><!--banner-single-->
    <div class="overlay"></div><!--overlay-->
        <div class="center">
        <form method="post">
            <h2>What's the best e-mail?</h2>
            <input type="email" name="email" required />
            <input type="hidden" name="identificator" value="form_home" />
            <input type="submit" name="action" value="Register!">
        </form>
        </div><!--center-->
        <div class="bullets"></div><!--bullets-->
    </section><!--banner-container-->

    <section class="description-author">
        <div class="center">
        <div class="w100 left">
            <h2 class="text-center"><img src="<?php echo INCLUDE_PATH ?>images/photo.jpg" /> <?php echo $infoSite['name_author']; ?></h2>
            <p><?php echo $infoSite['description']; ?></p>
        </div><!--w100-->
        <div class="clear"></div>
        </div><!--center-->
    </section><!--description-author-->

    <section class="hardskills">

        <div class="center">
            <h2 class="title">Hard Skills</h2>
            <div class="w33 left box-hardskill">
                <h3><i class="<?php echo $infoSite['icon1']; ?>" aria-hidden="true"></i></h3>
                <h4>CSS3</h4>
                <p><?php echo $infoSite['description1']; ?></p>
            </div><!--hardskills-->
            <div class="w33 left box-hardskill">
                <h3><i class="<?php echo $infoSite['icon2']; ?>" aria-hidden="true"></i></h3>
                <h4>HTML5</h4>
                <p><?php echo $infoSite['description2']; ?></p>
            </div><!--hardskill-->
            <div class="w33 left box-hardskill">
                <h3><i class="<?php echo $infoSite['icon3']; ?>" aria-hidden="true"></i></h3>
                <h4>JavaScript</h4>
                <p><?php echo $infoSite['description3']; ?></p>
            </div><!--hardskill-->
            <div class="clear"></div>
        </div><!--center-->

    </section><!--hardskills-->

    <section class="extras">

        <div class="center">
            <div id="testimonials" class="w50 left testimonials-container">
                <h2 class="title">Customer's Testimonials</h2>
                <?php
                    $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.testimonials` ORDER BY order_id ASC LIMIT 3");
                    $sql->execute();
                    $testimonials = $sql->fetchAll();
                    foreach ($testimonials as $key => $value) {
                ?>
                <div class="testimonial-single">
                    <p class="testimonial-description">"<?php echo $value['testimonial']; ?>"</p>
                    <p class="name-author"><?php echo $value['name']; ?> - <?php echo $value['date']; ?></p>
                </div><!--testimonial-single-->
                <?php } ?>
            </div><!--w50-->
            <div id="services" class="w50 left services-container">
                <h2 class="title">Services</h2>
                <div class="services">
                <ul>
                    <?php 
                        $sql = MySql::connect()->prepare("SELECT * FROM `tb_site.services` ORDER BY order_id ASC LIMIT 3");
                        $sql->execute();
                        $services = $sql->fetchAll();
                        foreach ($services as $key => $value) {
                    ?>
                    <li><?php echo $value['service']; ?></li>
                    <?php } ?>
                </ul>
                </div><!--services-->
            </div><!--w50-left-->
            <div class="clear"></div>
        </div><!--center--> 
    </section><!--extras-->
