@extends('layouts.app')
@section('content')
    <div class="container mb-4 pb-5">
        <p>{{ Count(Cart::session(Auth::user()->id)->getContent()) }} produit en cours dans le panier</p>
        <div class="jumbotron">
            @if(Count(Cart::session(Auth::user()->id)->getContent()) > 0)
            <div class="d-flex justify-content-center mb-4">
                <a href="{{ route('cart.clear') }}" class="btn btn-block btn-light w-25">
                    Vider le panier
                </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                @foreach (Cart::session(Auth::user()->id)->getContent() as $item)
                                    <tr>
                                        <td><img class="cart-img"
                                                src="{{ asset('storage/courses/' . $item->model->user_id . '/' . $item->model->image . '') }}" />
                                        </td>
                                        <td>
                                            <p><b>{{ $item->name }}</b></p>
                                            <p>Par {{ $item->model->user->name }}</p>
                                        </td>
                                        <td class="text-left">
                                            <small><a class="btn border"
                                                    href="{{ route('cart.destroy', $item->id) }}">Supprimer</a></small><br>
                                            <small><a class="btn border"
                                                    href="{{ route('wishlist.toWishlist', $item->id) }}">Ajouter à la liste
                                                    de souhaits</a></small>
                                        </td>
                                        <td class="text-right">{{ $item->price }} €</td>
                                    </tr>
                                @endforeach
                                @php
                                $tax = Cart::getSubTotal()*0.1;
                                $roundedTax = round($tax, 2);
                                @endphp
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Sous-total</td>
                                    <td class="text-right">{{ Cart::getSubTotal() }} €</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Taxe</td>
                                    <td class="text-right">{{ $roundedTax }} €</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>{{ Cart::getTotal() + $roundedTax }} €</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-6">
                            <a href="{{ route('courses.index') }}" class="btn btn-block btn-light">Continuer vos achats</a
                                href="#">
                        </div>
                        <div class="col-sm-12 col-md-6 text-right">
                            <a href="{{ route('checkout.payment') }}" class="btn btn-lg btn-block btn-success text-uppercase">Payer</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart text-center">
                <i class="fas fa-shopping-cart fa-7x"></i>
                <h4 class="my-5">Votre panier est vide. Continuez vos achats et trouvez un cours !</h4>
                <a href="{{ route('courses.index') }}" class="primary-btn">
                    <i class="fas fa-arrow-right ml-2"></i> Continuez vos achats</a>
            </div>
            @endif
        </div>
        @if(Count(Cart::session(Auth::user()->id.'_wishlist')->getContent()) > 0)
        <div class="wish-list jumbotron pt-3">
            <h3 class="my-3">Récemment ajouté à la liste de souhaits</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        @foreach (Cart::session(Auth::user()->id . '_wishlist')->getContent() as $item)
                            <tr>
                                <td><img class="cart-img"
                                        src="{{ asset('storage/courses/' . $item->model->user_id . '/' . $item->model->image . '') }} " />
                                </td>
                                <td>
                                    <p><b>{{ $item->name }}</b></p>
                                    <p>Par {{ $item->model->user->name }}</p>
                                </td>
                                <td class="text-left">
                                    <small><a class="btn border"
                                            href="{{ route('wishlist.destroy', $item->id) }}">Supprimer</a></small><br>
                                    <small><a class="btn border" href="{{ route('wishlist.toCart', $item->id) }}">Ajouter au
                                            panier</a></small>
                                </td>
                                <td class="text-right">{{ $item->price }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="empty-cart text-center">
            <i class="fas fa-heart fa-7x"></i>
            <h4 class="my-5">Votre liste de souhaits est vide. Continuez vos achats et trouvez un cours !</h4>
            <a href="{{ route('courses.index') }}" class="primary-btn">
                <i class="fas fa-arrow-right ml-2"></i> Continuez vos achats</a>
        </div>
        @endif
    </div>
@endsection
