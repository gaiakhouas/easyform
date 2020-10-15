<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use Stripe\Charge;
use App\CourseUser;
use Stripe\StripeClient;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;
use App\Http\Managers\PaymentManager;
use App\Http\Managers\FormatManager as ManagersFormatManager;


class CheckoutController extends Controller
{
    /**
     * after instanciation : 
     * redirect the user on case he is not connected
     * add a manager for the payment 
     */
    public function __construct(PaymentManager $paymentManager)
    {
        $this->middleware('auth');
        $this->paymentManager = $paymentManager;    
    }

    /**
     * return the checkout page
     */
    public function checkout()
    {
        return view('checkout.payment');
    }

    /**
     * create a payment for the cart added
     */
    public function charge(Request $request)
    {
        $cart = \Cart::session(Auth::user()->id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_PRIVATE_KEY'));
        $rate = 0.10;
        $taxTotal = $cart->getTotal() * $rate;
        $roundedTax = round($taxTotal, 2);
        $price_cents = ($cart->getTotal() + $roundedTax) * 100;
        try {
            $charge = $stripe->charges->create([
                "amount" =>  $price_cents,
                "currency" => "eur",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "receipt_email" => Auth::user()->email
            ]);
            foreach (\Cart::getContent() as $item) :
                $taxUnit = $item->price * $rate;
                $roundedTaxUnit = round($taxUnit, 2);
                $instructor_part = $this->paymentManager->getInstructorPart($item->price + $taxUnit);
                $elearning_part = $this->paymentManager->getElearningPart($item->price + $roundedTaxUnit);
                Payment::create([
                    'course_id' =>   $item->id,
                    'amount' => ($item->price + $roundedTaxUnit),
                    'instructor_part' =>  $instructor_part,
                    'elearning_part' =>  $elearning_part,
                    'email' =>  Auth::user()->email,
                ]);
                CourseUser::create([
                    'course_id' => $item->id,
                    'user_id' =>  Auth::user()->id
                ]);
            endforeach;
            return redirect()->route('checkout.success')->with('success', 'Paiement accepté !');
        } catch (\Stripe\Exception\CardException  $e) {
            throw $e;
        }
    }

    /**
     * return the home page in case the user's already been redirected to the success page of payment
     */
    public function success()
    {
        $formatManager = new ManagersFormatManager();
        if (!session()->has('success')) :
            return view('main.home');
        else :
            $order = \Cart::session(Auth::user()->id)->getContent();
            \Cart::session(Auth::user()->id)->clear();
            return view('checkout.success', [
                'order' => $order,
                'formatManager' => $formatManager
            ]);
        endif;
    }
}
