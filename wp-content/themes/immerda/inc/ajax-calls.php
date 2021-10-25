<?php
/* E-Mail vom Chatbot senden */
function chatbot_send_mail_ajax() {
  /* Variabeln deklarieren */
  $send_mail = esc_attr( $_POST['email'] );
  $content = $_POST['bot_content'];
  $headers = array('Content-Type: text/html; charset=UTF-8');
  /* E-Mail senden */
  wp_mail( $send_mail, 'Neue Chatbot Nachricht', $content, $headers );
}
add_action( 'wp_ajax_nopriv_chatbot_send_mail_ajax', 'chatbot_send_mail_ajax' );
add_action( 'wp_ajax_chatbot_send_mail_ajax', 'chatbot_send_mail_ajax' );