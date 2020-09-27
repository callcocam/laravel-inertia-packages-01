<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Call\Facades\Call;
use Call\Models\Form\Fields\Input;
use Call\Models\Form\Form;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View|\Call\Response
     */
    public function showLinkRequestForm()
    {
        $form = Form::make('column',
            [
                'email'=>Input::make('E-Mail Address','email')->type('email')
                    ->get(request()->get('email'))
            ]
        )->attribute('action',route('login'))->getArrayCopy();
        return Call::setRootView('layouts.auth')->render("Auth/Passwords/Email")->with($form);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => trans($response)], 200)
            : back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }
        return Redirect::route('admin')->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
