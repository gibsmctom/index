<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Internet Provider
 */

get_header(); ?>

<div id="content">

  <?php
    $internet_provider_hidcatslide = get_theme_mod('internet_provider_hide_categorysec', true);
    $internet_provider_pageboxes = get_theme_mod('internet_provider_pageboxes');

    if ($internet_provider_hidcatslide && $internet_provider_pageboxes) { ?>
    <section id="catsliderarea">
      <div class="catwrapslider">
        <div class="owl-carousel">
          <?php if( get_theme_mod('internet_provider_pageboxes',false) ) { ?>
          <?php $internet_provider_queryvar = new WP_Query('cat='.esc_attr(get_theme_mod('internet_provider_pageboxes',false)));
            while( $internet_provider_queryvar->have_posts() ) : $internet_provider_queryvar->the_post(); ?>
              <div class="slidesection"> 
                <?php if(has_post_thumbnail()){
                  the_post_thumbnail('full');
                  } else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slider.png" alt="<?php echo esc_attr( 'slider', 'internet-provider'); ?>"/>
                <?php } ?>
                <div class="slider-box">
                  <?php if ( get_theme_mod('internet_provider_pgboxes_title') != "") { ?>
                    <span><?php echo esc_html(get_theme_mod('internet_provider_pgboxes_title','')); ?></span>
                  <?php } ?>
                  <h1><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h1>
                  <?php
                    $trimexcerpt = get_the_excerpt();
                    $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = 20 );
                    echo '<p>' . esc_html( $shortexcerpt ) . '</p>'; 
                  ?>
                  <div class="pagemore">
                    <?php 
                    $internet_provider_button_text = get_theme_mod('internet_provider_button_text', 'Read More');
                    $internet_provider_button_link_slider = get_theme_mod('internet_provider_button_link_slider', ''); 
                    if (empty($internet_provider_button_link_slider)) {
                        $internet_provider_button_link_slider = get_permalink();
                    }
                    if ($internet_provider_button_text || !empty($internet_provider_button_link_slider)) { ?>
                      <?php if(get_theme_mod('internet_provider_button_text', 'Read More') != ''){ ?>
                        <a href="<?php echo esc_url($internet_provider_button_link_slider); ?>" class="button redmor">
                          <?php echo esc_html($internet_provider_button_text); ?>
                            <span class="screen-reader-text"><?php echo esc_html($internet_provider_button_text); ?></span>
                        </a>
                      <?php } ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
        </div>
      </div>
      <div class="clear"></div>
    </section>
  <?php } ?>
  
  <?php
    $internet_provider_hidepageboxes = get_theme_mod('internet_provider_disabled_pgboxes', true);
    $internet_provider_pageboxes = get_theme_mod('internet_provider_pageboxes');
    if( $internet_provider_hidepageboxes && $internet_provider_pageboxes){
  ?>
    <div id="services_section" class="text-center my-5">
      <div class="container">
        <div class="row">
          <?php for($p=1; $p<4; $p++) { ?>
          <?php if( get_theme_mod('internet_provider_pageboxes'.$p,false)) { ?>
            <?php $internet_provider_querymed = new WP_query('page_id='.esc_attr(get_theme_mod('internet_provider_pageboxes'.$p,false)) ); ?>
              <?php while( $internet_provider_querymed->have_posts() ) : $internet_provider_querymed->the_post(); ?>
              <div class="col-lg-4 col-md-4">
                <div class="pagecontent mb-3">
                  <?php if (has_post_thumbnail() ){ ?>
                    <div class="thumbbx"><?php the_post_thumbnail();?></div>
                  <?php } ?>
                  <div class="text-inner-box p-3">
                    <h2><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h2>
                    <div class="price-box">
                      <?php if(get_theme_mod('internet_provider_projects_price') != ''){ ?>
                        <h3><?php echo esc_html(get_theme_mod('internet_provider_projects_price')); ?></h3>
                      <?php }?>
                    </div>
                    <div class="serv-btn">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','internet-provider'); ?></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } } ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  <?php }?>
</div>

<?php get_footer(); ?>