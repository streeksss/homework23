<?php


add_action ('wp_enqueue_scripts', 'load_scripts_styles');
function load_scripts_styles(){

    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('slick', get_template_directory_uri() . 'assets/css/slick.css');
    wp_enqueue_style('jquery.fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css');
    wp_enqueue_style('animate', get_template_directory_uri() . 'assets/css/animate.css');
    wp_enqueue_style('default', get_template_directory_uri() . '/assets/css/theme-color/default.css');

}





wp_enqueue_script('jquery');
add_action( 'wp_enqueue_scripts', function() {

    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/mail.js', array('jquery') );

    wp_localize_script(
        'ajax-script',
        'ajax_object',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'letter' )
        )
    );
});


add_action('wp_ajax_sendletter', 'sendletter');
add_action('wp_ajax_nopriv_sendletter', 'sendletter');
function sendletter() {

    if ( !wp_verify_nonce( $_POST['nonce'], 'letter' ) ) {
        die( 'Security check' );
    } else {

        $author = $_POST['author'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $error = '';
        if(!$author) {echo '/ Please, writing your name! /';}
        if(!$email) {echo  '/ You don\'t write email! /';}
        if(!$message || strlen($message) < 1) {echo '/ Message form is empty! /';}
        if( wp_mail( 'streeksmail@gmail.com', 'Sender: ' . $author.'Email:'.$email, $message ) ) {
            echo 'Your letter has been sent!';
        } else {
            echo 'Sorry, error!';
        }
        die();


    }
}
