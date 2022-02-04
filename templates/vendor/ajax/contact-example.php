<?php namespace ProcessWire;
/**
 *  Contact Form
 *  Method: POST
 *  @var string (email) email - as honeypot - needs to be empty value
 *  @var string (email) user_mail - default form email
 *  @var string (text) name 
 *  @var string (text) subject
 *  @var string (textarea) message
 */

$to = $system->settings("email");
$from = $system->settings("site_email");

//
//  Response
//
$response = [
  "status" => "empty",
  "reset_form" => true,
];

//
//  Process form 
//
if($input->post && empty($honeypot)) {

  $honeypot = $input->post->email;
  $name = $sanitizer->text($input->post->name);
  $email = $sanitizer->email($input->post->user_mail);
  $subject = $sanitizer->text($input->post->subject);
  $message = $sanitizer->textarea($input->post->message);
  $message = nl2br($message);

  // Validation using Valitron included in WireKitHelper
  $helper = $modules->get("WireKitHelper");
  $v = $helper->validator($_POST);
  $v->rule('required', ['name', 'user_mail', 'subject', 'message']); 
  $v->rule('email', 'user_mail');

  $v->labels(array(
    'name' => 'Name',
    'user_mail' => 'Email',
    'subject' => 'Subject',
    'message' => 'Message'
  ));

  if(empty($honeypot) && $v->validate()) {

    $m = $mail->new(); 
    $m->to($to);
    $m->from($from);
    $m->replyTo($email, $name);
    $m->subject($subject);
    $m->body($message);
    $m->send();

    $res_title = sprintf("Thank you %s!", $name);
    $res_message = "Your message has been sent. Thank you for your time.";

    $response["status"] = "success";
    $response["modal"] = "<h3>$res_title</h3><p>$res_message</p>";

  } else {
    
    // get errors from valitron and store them in errors array
    $errors = [];
    $errors_fields = [];
    foreach($v->errors() as $key => $value) {
      $errors[] = $value[0]; 
      $errors_fields[] = $key;
    }
    
    $response["status"] = "error";
    $response["errors"] = $errors;
    $response["reset_form"] = false;
    $response["error_fields"] = $errors_fields;

  }

}

//
//  Set header, return response
//
header('Content-type: application/json');
echo json_encode($response);

exit();