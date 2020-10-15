@extends('layouts.instructor-app')

@section('content')
    <section class="contact-from-section spad">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-lg-10 jumbotron">
                    <h3 class="mb-5">Participants</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Inscription</th>
                                <th scope="col">Participant</th>
                                <th scope="col">Cours</th>
                                <th scope="col">Prix payé</th>
                                <th scope="col">Votre revenu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participants as $participant)
                                @if (count($participants) > 0)
                                    <tr>
                                        <th>{{ $formatManager->getDateFr($participant->created_at) }}</th>
                                        <td>{{ $participant->email }}</td>
                                        <td>{{ $participant->course->title }}</td>
                                        <td>{{ $participant->amount }} €</td>
                                        <td>{{ $participant->instructor_part }} €</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <p>Ce cours n'a pas encore de participants.</p>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
