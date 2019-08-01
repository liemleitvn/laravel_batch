<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\VerificationEmailException;
use App\Http\Controllers\Controller;
use App\Jobs\SendWelcomeMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend(Request $request)
    {
        if ($request->user()->number_of_resend_verify >= config('auth.number_of_resend_verify')) {
            DB::table('users')
                ->delete($request->user()->id);

            $username = $request->user()->name;
            $numberFail = config('auth.number_of_resend_verify');
            return view('errors.fail_verification_email', compact('numberFail', 'username'));
        }

        else {
            DB::table('users')
                ->where('id', $request->user()->id)
                ->update(['number_of_resend_verify' => $request->user()->number_of_resend_verify + 1]);

            if ($request->user()->hasVerifiedEmail()) {
                return redirect($this->redirectPath());
            }

            $request->user()->sendEmailVerificationNotification();
        }

        return back()->with('resent', true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws AuthorizationException
     */
    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            dispatch(new SendWelcomeMail($request->user()->toArray()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}
