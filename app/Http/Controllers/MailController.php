<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CommonSendEmail;

class MailController extends Controller
{
    public function tutorial()
    {    
        // 1)  Run the command to make CommonSendEmail as trait "php artisan make:notification CommonSendEmail"
        // 2)  create controller with "php artisan make:controller MailController"
        // 2)  add "use App\Notifications\CommonSendEmail" in MailController controller 
        // 3)  Fill the detail of smtp in env file 
    }

    public function index()
    {
        $recipient = User::find(1); 
        $token = "zadfadfsdfsds";
        $resetUrl = '/reset/password/' . $token . '?email=' . urlencode($recipient->email);

        $messages = [
            'subject' => 'Reset Your Password '. config('app.name') ,
            'greeting-text' => 'Dear ' .ucfirst($recipient->first_name). ',',
            'url-title' => 'Reset Password',
            'url' => $resetUrl,
            'lines_array' => [
                'body-text' => 'We received a request to reset your account password. To reset your password, please click on the link below:',
                'info' => "If you didn't request this password reset or believe it's a mistake, you can ignore this email. Your password will not be changed until you access the link above and create a new password.",
                'expiration' => "This password reset link is valid for the next 24 hours. After that, you'll need to request another password reset.",
            ],
            'thanks-message' => 'Thank you for using our application!',
        ];
        $recipient->notify(new CommonSendEmail($messages));
    }
}
