<?php


namespace App\Exceptions;


use Exception;

class VerificationEmailException extends Exception
{
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $username = $request->user()->name;
        $numberFail = config('auth.number_of_resend_verify');
        return view('errors.fail_verification_email', compact('numberFail', 'username'));
    }


}