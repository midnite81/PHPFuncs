<?php
/*
Add this script to your plugins within MODX and you will be notified when users update pages on your MODX website. 
*/

$eventName = $modx->event->name;

$resourceId = $resource->get('id');
$title = $resource->get('pagetitle');
$url = $modx->makeUrl($resourceId, '', '', -1);
$user = $modx->user->get('id');
$userprofile = $modx->user->getOne('Profile');
$fullname = $userprofile->get('fullname');

// Exclude users in the following array if you don't want to know when they update pages
if (in_array($user,array(1,2,4))) return;

$nl = "\n";
$body[] = "<div style=\"font-family: arial; font-size: 12pt; \">" . $nl; 
$body[] = "<p>Hello,</p>" . $nl; 
$body[] = "<p>This email is to let you know that <b>" . $fullname . "</b> has updated the <b>" . $title . "</b> page on the MODX website.</p>" . $nl; 
$body[] = "<p>You can view the page by going to " . $url . ".</p>" . $nl; 
$body[] = "<p>Regards,<br><br>The Website</p>" . $nl; 
$body[] = "</div>" . $nl; 

$body = implode("",$body);            
$subject = 'Page Updated';
$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $body);
$modx->mail->set(modMail::MAIL_FROM, 'no-reply@mysite.org');
$modx->mail->set(modMail::MAIL_FROM_NAME, 'MODX Website');
$modx->mail->set(modMail::MAIL_SENDER, 'MODX Website');
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to','me@mysite.org');
$modx->mail->setHTML(true);
$modx->mail->send();