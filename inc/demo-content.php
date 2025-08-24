<div class="theme-offer">
   <?php
     // POST and update the customizer and other related data of Internet Provider
    if ( isset( $_POST['submit'] ) ) {

        // Check if Classic Blog Grid plugin is installed
        if (!is_plugin_active('classic-blog-grid/classic-blog-grid.php')) {
            // Plugin slug and file path for Classic Blog Grid
            $internet_provider_plugin_slug = 'classic-blog-grid';
            $internet_provider_plugin_file = 'classic-blog-grid/classic-blog-grid.php';
        
            // Check if Classic Blog Grid is installed and activated
            if ( ! is_plugin_active( $internet_provider_plugin_file ) ) {
        
                // Check if Classic Blog Grid is installed
                $internet_provider_installed_plugins = get_plugins();
                if ( ! isset( $internet_provider_installed_plugins[ $internet_provider_plugin_file ] ) ) {
        
                    // Include necessary files to install plugins
                    include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
                    include_once( ABSPATH . 'wp-admin/includes/file.php' );
                    include_once( ABSPATH . 'wp-admin/includes/misc.php' );
                    include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        
                    // Download and install Classic Blog Grid
                    $internet_provider_upgrader = new Plugin_Upgrader();
                    $internet_provider_upgrader->install( 'https://downloads.wordpress.org/plugin/classic-blog-grid.latest-stable.zip' );
                }
        
                // Activate the Classic Blog Grid plugin after installation (if needed)
                activate_plugin( $internet_provider_plugin_file );
            }
        }

        // ------- Create Main Menu --------
        $internet_provider_menuname = 'Primary Menu';
        $internet_provider_bpmenulocation = 'primary';
        $internet_provider_menu_exists = wp_get_nav_menu_object( $internet_provider_menuname );
    
        if ( !$internet_provider_menu_exists ) {
            $internet_provider_menu_id = wp_create_nav_menu( $internet_provider_menuname );

            // Create Home Page
            $internet_provider_home_title = 'Home';
            $internet_provider_home = array(
                'post_type'    => 'page',
                'post_title'   => $internet_provider_home_title,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'home'
            );
            $internet_provider_home_id = wp_insert_post($internet_provider_home);
            // Assign Home Page Template
            add_post_meta($internet_provider_home_id, '_wp_page_template', '/template-home-page.php');
            // Update options to set Home Page as the front page
            update_option('page_on_front', $internet_provider_home_id);
            update_option('show_on_front', 'page');
            // Add Home Page to Menu
            wp_update_nav_menu_item($internet_provider_menu_id, 0, array(
                'menu-item-title' => __('Home', 'internet-provider'),
                'menu-item-classes' => 'home',
                'menu-item-url' => home_url('/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $internet_provider_home_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create a new Page 
            $internet_provider_pages_title = 'Pages';
            $internet_provider_pages_content = '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
            $internet_provider_pages = array(
                'post_type'    => 'page',
                'post_title'   => $internet_provider_pages_title,
                'post_content' => $internet_provider_pages_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'pages'
            );
            $internet_provider_pages_id = wp_insert_post($internet_provider_pages);
            // Add Pages Page to Menu
            wp_update_nav_menu_item($internet_provider_menu_id, 0, array(
                'menu-item-title' => __('Pages', 'internet-provider'),
                'menu-item-classes' => 'pages',
                'menu-item-url' => home_url('/pages/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $internet_provider_pages_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Create About Us Page 
            $internet_provider_about_title = 'About Us';
            $internet_provider_about_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
            $internet_provider_about = array(
                'post_type'    => 'page',
                'post_title'   => $internet_provider_about_title,
                'post_content' => $internet_provider_about_content,
                'post_status'  => 'publish',
                'post_author'  => 1,
                'post_slug'    => 'about-us'
            );
            $internet_provider_about_id = wp_insert_post($internet_provider_about);
            // Add About Us Page to Menu
            wp_update_nav_menu_item($internet_provider_menu_id, 0, array(
                'menu-item-title' => __('About Us', 'internet-provider'),
                'menu-item-classes' => 'about-us',
                'menu-item-url' => home_url('/about-us/'),
                'menu-item-status' => 'publish',
                'menu-item-object-id' => $internet_provider_about_id,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type'
            ));

            // Assign the menu to the primary location if not already set
            if ( ! has_nav_menu( $internet_provider_bpmenulocation ) ) {
                $internet_provider_locations = get_theme_mod( 'nav_menu_locations' );
                if ( empty( $internet_provider_locations ) ) {
                    $internet_provider_locations = array();
                }
                $internet_provider_locations[ $internet_provider_bpmenulocation ] = $internet_provider_menu_id;
                set_theme_mod( 'nav_menu_locations', $internet_provider_locations );
            }
        }

        //Header Section
        set_theme_mod( 'internet_provider_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Slider Section
        set_theme_mod( 'internet_provider_pgboxes_title', 'EIUSMOD TEMPOR' );
        set_theme_mod( 'internet_provider_button_link_slider', '#' );
        
        // Create the 'Internet Provider' category and retrieve its ID
        $internet_provider_slider_category_id = wp_create_category('Internet Provider');
    
        // Set the category in theme mods for the slider section
        if (!is_wp_error($internet_provider_slider_category_id)) {
            set_theme_mod('internet_provider_pageboxes', $internet_provider_slider_category_id); // Update with correct category ID
        }
        
        $internet_provider_titles = array(
            'LOREM IPSUM DOLAR sit amet adipiscing ELITSE',
            'Unlimited Plans with High-Speed Connectivity',
            '24/7 Customer Support for Seamless Browsing',
        );
        // Create three demo posts and assign them to the 'Internet Provider' category
        for ($internet_provider_i = 0; $internet_provider_i <= 2; $internet_provider_i++) {
            $internet_provider_content = 'Lorem ipsum is simply dummy text of the printing and typesetting industry.';
            set_theme_mod('internet_provider_title' . ($internet_provider_i + 1), $internet_provider_titles[$internet_provider_i]);
    
            // Prepare the post object
            $internet_provider_my_post = array(
                'post_title'    => wp_strip_all_tags($internet_provider_titles[$internet_provider_i]),
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array($internet_provider_slider_category_id),
            );
    
            // Insert the post into the database
            $internet_provider_post_id = wp_insert_post($internet_provider_my_post);
    
            // If the post was successfully created, set the featured image
            if (!is_wp_error($internet_provider_post_id)) {
                $internet_provider_image_url = get_template_directory_uri() . '/images/slider' . ($internet_provider_i + 1) . '.png';
                $internet_provider_image_id = media_sideload_image($internet_provider_image_url, $internet_provider_post_id, null, 'id');
                if (!is_wp_error($internet_provider_image_id)) {
                    set_post_thumbnail($internet_provider_post_id, $internet_provider_image_id);
                } else {
                    error_log('Failed to set post thumbnail for post ID: ' . $internet_provider_post_id);
                }
            } else {
                error_log('Failed to create post: ' . print_r($internet_provider_post_id, true));
            }
        }  

        // Services Section
        // Set the price for the services
        set_theme_mod('internet_provider_projects_price', '$ 25.99'); // Default price for services          
       // Create service pages and assign them to theme mods
        $internet_provider_service_titles = array('BROADBAND', 'HIGH-SPEED', 'FIBER OPTIC');
        $internet_provider_service_images = array(
            get_template_directory_uri() . '/images/services/service1.png',
            get_template_directory_uri() . '/images/services/service2.png',
            get_template_directory_uri() . '/images/services/service3.png'
        );

        foreach ($internet_provider_service_titles as $internet_provider_index => $internet_provider_title) {
            $internet_provider_service_page = array(
                'post_title'   => wp_strip_all_tags($internet_provider_title),
                'post_status'  => 'publish',
                'post_type'    => 'page',
            );
            
            $internet_provider_service_page_id = wp_insert_post($internet_provider_service_page);
            
            if (!is_wp_error($internet_provider_service_page_id)) {
                set_theme_mod('internet_provider_pageboxes' . ($internet_provider_index + 1), $internet_provider_service_page_id);
                
                // Set featured image for the page
                $internet_provider_image_id = media_sideload_image($internet_provider_service_images[$internet_provider_index], $internet_provider_service_page_id, null, 'id');
                if (!is_wp_error($internet_provider_image_id)) {
                    set_post_thumbnail($internet_provider_service_page_id, $internet_provider_image_id);
                }
            }
        }

        // Set the default price for services
        set_theme_mod('internet_provider_projects_price', '$ 25.99');

    // Show success message and the "View Site" button
         echo '<div class="success">Demo Import Successful</div>';
    }
     ?>
    <ul>
        <li>
        <hr>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
           <!-- Show demo importer form only if it's not submitted -->
           <?php echo esc_html( 'Click on the below content to get demo content installed.', 'internet-provider' ); ?>
          <br>
          <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'internet-provider' ); ?></b></small>
          <br><br>

          <form id="demo-importer-form" action="" method="POST" onsubmit="return confirm('Do you really want to do this?');">
            <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','internet-provider'); ?>" class="button button-primary button-large">
          </form>
        <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '</div>';
        }
        ?>

        <hr>
        </li>
    </ul>
 </div>