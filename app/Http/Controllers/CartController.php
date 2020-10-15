<?php

namespace App\Http\Controllers;

use App\Course;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * after instanciation : 
     * redirect the user to the login page if he is not connected
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * return the cart page
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * add a product into the cart class
     */
    public function store($id)
    {
        $course = Course::find($id);
        // now the product to be added on cart
        $product = array(
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        );

        // finally add the product on the cart

        \Cart::session(Auth::user()->id)->add($product);
        return redirect()->route('cart.index');
    }

    /**
     * destroy a product from the cart class
     */
    public function  destroy($id)
    {
        \Cart::session(Auth::user()->id)->remove($id);
        return redirect()->back()->with('success', 'Le cours a été supprimé de votre panier !');
    }

    /**
     * clear the cart class from all the products previously added
     */
    public function clear()
    {
        $cart = \Cart::session(Auth::user()->id);
        $cart->clear();
        return redirect()->back()->with('success', 'Votre panier a été vidé avec succès !');
    }
}
