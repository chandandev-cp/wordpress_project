<?php
//Template Name: Home page
get_header();
?>
 <!-- slider section -->
 <section class="slider_section ">
      <div class="container ">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="detail-box">
              <h1>
                Discover Restuarant And Food
              </h1>
              <p>
                when looking at its layout. The point of using Lorem Ipsum
              </p>
            </div>
            <div class="find_container ">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <form>
                      <div class="form-row ">
                        <div class="form-group col-lg-5">
                          <input type="text" class="form-control" id="inputHotel" placeholder="Restaurant Name">
                        </div>
                        <div class="form-group col-lg-3">
                          <input type="text" class="form-control" id="inputLocation" placeholder="All Locations">
                          <span class="location_icon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                          </span>
                        </div>
                        <div class="form-group col-lg-3">
                          <div class="btn-box">
                            <button type="submit" class="btn ">Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider_container">
        <?php
        if(have_rows('home_banner_slider_info')){
            while(have_rows('home_banner_slider_info')){
                the_row();
                ?>
 <div class="item">
          <div class="img-box">
            <img src="<?php the_sub_field('image');?>" alt="" />
          </div>
        </div>
                <?php
            }
        }
        ?>
       
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- recipe section -->

  <section class="recipe_section layout_padding-top">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Best Popular Recipes
        </h2>
      </div>
      <div class="row">
        <?php
        $wpfeatures=array(
          'post_type' => 'Receipe',
          'post_status' => 'publish',
          'orderby' => 'date',
          'order' => 'ASC',
          'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
  $featurequery= new Wp_Query($wpfeatures);
  while($featurequery->have_posts()){
        $featurequery->the_post();
        $imagepath=wp_get_attachment_image_src(get_post_thumbnail_id(),'large');
        ?>
<div class="col-sm-6 col-md-4 mx-auto">
          <div class="box">
            <div class="img-box">
              <img src="<?php echo $imagepath[0];?>" class="box-img" alt="">
            </div>
            <div class="detail-box">
              <h4>
                <?php echo the_title();?>
              </h4>
              <a href="<?php echo the_permalink();?>">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>

        <?php
  }
  wp_reset_postdata();

        ?>
        
      </div>
      <div class="btn-box">
        <a href="">
          Order Now
        </a>
      </div>
    </div>
  </section>

  <!-- end recipe section -->
   <?php echo the_content();?>
<?php
get_footer();
?>