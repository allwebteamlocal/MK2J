<?php

//load core template
gidd_include_file( GIDDCORE . 'gidd_wp_helper.php' );
gidd_include_file( GIDDCORE . 'gidd_wp_filter.php' );
gidd_include_file( GIDDPATH . '___gidd.php' );


//load core extension
gidd_include_file( GIDDPATH . 'core_extension/gidd_conf/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_widget/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_layout/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_word_limit/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_comment/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_option/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_static/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_cycle/gidd_load.php' );


//miscellaneous settings
gidd_include_file( GIDDCORE . 'misc_setting.php' );


//general template
gidd_include_file( GIDDCORE . 'gidd_login.php' );
gidd_include_file( GIDDPATH . 'gidd_master/config.php' );
gidd_include_file( GIDDPATH . 'gidd_master/message_template.php' );


//load template
gidd_include_file( GIDDCORE . 'gidd_dynamic_page.php' );
gidd_include_file( GIDDCORE . 'wp_template/gidd_wp_template.php' );
gidd_include_file( GIDDCORE . 'admin_template/gidd_admin_template.php' );


/** end */