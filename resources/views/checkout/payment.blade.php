@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form id="payment-form" class="jumbotron row contact_form" action="{{ route('checkout.charge') }}" method="POST">
                    @csrf
                    <div class="col-md-12 from-group">
                        <div class="create_account">
                            <h3 class="mb-3">Paiement</h3>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>

                        </div>
                    </div>
                    <button id="complete-order" type="submit" class="primary-btn my-3">Procéder au paiement</button>
                </form>
                <div class="order-details my-5">
                    <h3>Détails de la commande</h3>
                    <table class="table table-striped">
                        <tbody>
                            @foreach (Cart::session(Auth::user()->id)->getContent() as $item)
                     
                            <tr>
                                <td><img class="cart-img"
                                        src="{{ asset('storage/courses/'. $item->model->user_id.'/'.$item->model->image.'') }}" />
                                </td>
                                <td>
                                    <p><b>{{ $item->name }}</b></p>
                                    <p>{{ $item->name }}</p>
                                </td>
                                <td class="text-right">{{ $item->price }} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Résumé
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p>Prix d'origine:</p>
                            <p>{{ Cart::getTotal() }} €</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Taxe:</p>
                            @php
                                $tax = Cart::getTotal()*0.1;
                                $roundedTax=round($tax);
                            @endphp
                            <p>{{  $roundedTax }} €</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p><b>Prix total:</b></p>
                            <p><b>{{ Cart::getTotal()+$roundedTax }} €</b></p>
                        </div>
                        <small class="card-text">Comme exigé par la loi, Elearning prélève les taxes sur les transactions
                            applicables aux achats réalisés dans certaines juridictions fiscales.
                            En validant votre achat, vous acceptez ces Conditions générales d'utilisation.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('stripe')
    <script src="{{ asset('js/stripe.js') }}"></script>
@stop
