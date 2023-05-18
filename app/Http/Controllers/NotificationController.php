<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venue;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ResetSuccessNotification;
use Notification;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\HtmlString;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        return view('product');
    }
    
    public function customerWelcomeNotification($user, $password, $url_handle) {
        $user = User::find($user->id);
      
  
        $notificationData = [
            'name' => $user->name,
            'body' => "Welcome to Event Organizer Pro. A user account has been created for you. Please log in using this email and the password below",
            'password' => $password,
            'url_handle' => $url_handle,
            'thanks' => 'Thank you',
            'notification_id'=> 001
        ];
  
        $user->notify(new WelcomeNotification($notificationData));

        // return redirect("/")->with("success", "yup");
        // dd('Task completed!');
    }

    public function resetSuccessNotification($user) {
        $user = User::where('email', $user->email)->first();
        $venue = Venue::find($user->venue);
      
  
        $notificationData = [
            'name' => $user->name,
            'body' => new HtmlString("You have successfully changed your Password at <strong>Event Organizer Pro</strong>. If this was not you please contact <a href='/support'>Support</a> immediately."),
            'url_handle' => $venue->url_handle,
            'thanks' => 'Thank you',
            'notification_id'=> 002
        ];
  
        $user->notify(new ResetSuccessNotification($notificationData));

        // return redirect("/")->with("success", "yup");
        // dd('Task completed!');
    }

    public function randomizedPasswordResetNotification($user, $password) {
        $user = User::where('email', $user->email)->first();
        $venue = Venue::find($user->venue);
      
  
        $notificationData = [
            'name' => $user->name,
            'body' => new HtmlString("User password has been reset to: " . $password . " If this was not you or you did not make a password change request, please contact <a href='/support'>Support</a> immediately."),
            'url_handle' => $venue->url_handle,
            'thanks' => 'Thank you',
            'notification_id'=> 003
        ];
  
        $user->notify(new ResetPasswordNotification($notificationData));

        // return redirect("/")->with("success", "yup");
        // dd('Task completed!');
    }

}