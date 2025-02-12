<?php

function bootstrap_script_5(){
    wp_enqueue_style( 'bootstrap5','https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css' );
    wp_enqueue_script( 'js','https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' );
    wp_enqueue_script( 'popperjs','https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js' );
    wp_enqueue_script( 'minjs','https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js' );
    wp_enqueue_script( 'ajax','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js' );
    wp_enqueue_script( 'simo_js', plugins_url('/simotelwordpress/style/js/simo_js.js'),__FILE__ );
 }
 
 add_action( "wp_enqueue_scripts",'bootstrap_script_5' );
