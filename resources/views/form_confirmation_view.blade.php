@section('title', 'confirmation')
@extends('layout.master')    
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .div_alert{
            position: fixed;
            top: 0;
            transition: 3s;
            display: none;
        }
    </style>
</head>
<body>
    <h3 class="text-center text-success my-2">Remplir le formulaire</h3>
    <div class="alert alert-warning text-center w-100 div_alert">
        <li><strong>votre commende a ete enregistrer notre equipe elle va appeler dans le 10 min prochaine</strong></li>
    </div>
    <div class="container border p-4 my-5">
        @auth
            <p id="user_id" style="display: none">{{ auth()->user()->id }}</p>
            <p id="prodect_id" style="display: none">{{$id}}</p>
            <p id="user_email" style="display: none">{{ auth()->user()->email }}</p>
        @endauth        
        <form id="confirmationForm">
            @foreach ($donne as $item)  
            @if ($item->email == auth()->user()->email)                                                   
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text"  value="{{$item->phone_number}}" required class="form-control phone_number" name="phone_number" id="phone" />           
            </div>
            <div class="mb-3">
                <label for="loca" class="form-label">Localisation</label>
                <textarea class="form-control localisation" name="localisation" id="loca" rows="3"  required>{{$item->localisation}}</textarea>
            </div>
            @endif  
            @endforeach
            <button type="submit" class="btn btn-success btn_confirmer">Confirmer</button>
        </form>
    </div>
</body>
</html>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', '#confirmationForm', function (e) {
                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var userId = $('#user_id').text();
                var prodectId = $('#prodect_id').text();
                var user_email = $('#user_email').text();

                $.ajax({
                    type: "post",
                    url: "{{ route('confirmer') }}",
                    data: {
                        'confirmer': 1,
                        'email': user_email,
                        'id_prodect': prodectId,
                        '_token': csrfToken
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (reject) {
                        console.log(reject);
                    }
                });

                $.ajax({
                    type: "put",
                    url: "{{ route('stock_confirmation') }}",
                    data: {
                        'phone': $('.phone_number').val(),
                        'localisation': $('.localisation').val(),
                        'id': userId,                        
                        '_token': csrfToken
                    },
                    success: function (response) {
                        console.log(response);
                        $('.div_alert').show();

                        setTimeout(function () {
                            $('.div_alert').hide();
                            setTimeout(function () {
                                window.location.href = '{{ route("panier_view") }}';
                            }, 500);
                        }, 6000);
                    },
                    error: function (reject) {
                        console.log(reject);
                    }
                });
            });
        });

    </script>
@endsection
