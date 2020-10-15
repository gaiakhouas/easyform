<?php

namespace App\Http\Controllers;

use App\Course;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\WishListServiceProvider;

class WishlistController extends Controller
{
    /**
     * After instanciation : 
     * redirect the user to the login page if he not connected
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * add a new product to the wish list and redirect the user to the cart page
     */
    public function store($id)
    {
        $course = Course::find($id);
        \Cart::session(Auth::user()->id . '_wishlist')->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->route('cart.index');
    }

    /**
     * get off the product from the wishlist
     */
    public function destroy($id)
    {
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);
        return redirect()->back()->with('success', 'Le cours a été supprimé de votre liste de souhaits !');
    }

    /**
     * move the product from the wishlist to the cart
     */
    public function toCart($id)
    {
        $course = Course::find($id);
        \Cart::session(Auth::user()->id . '_wishlist')->remove($id);
        \Cart::session(Auth::user()->id)->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->back()->with('success', 'Le cours "' . $course->title . '" a été ajouté à votre panier !');
    }

    /**
     * move the product from the cart to the wishlist
     */
    public function toWishlist($id)
    {
        $course = Course::find($id);
        \Cart::session(Auth::user()->id)->remove($id);
        \Cart::session(Auth::user()->id . '_wishlist')->add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price,
            'quantity' => 1,
            'associatedModel' => $course
        ]);

        return redirect()->route('cart.index');
    }
}
