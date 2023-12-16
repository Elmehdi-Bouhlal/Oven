@section('title','panier')
@extends('layout.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .div_supprimer{
            position: fixed;
            top: 0;
            z-index: 111;
            transition: 2s;
            display: none;
        }
        .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .loader {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #ffc107;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
</head>
<body>    
    <div class="alert alert-danger w-100 text-center div_supprimer">
        <li><strong>le article a ete supprimer avec success</strong></li>
    </div>
    <h1 class="text-center text-success my-2">Your orders</h1>
    <form class="table-responsive my-4 container">
        <table class="table table-success">
            <thead>
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Description</th>                    
                    <th scope="col">Quantite</th>    
                    <th scope="col" class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16"><path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/></svg></th>    
                    <th scope="col" class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/></svg></th>    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)  
                @if ($item->utilisateur==auth()->user()->email)                                    
                    <tr>                        
                        <td><img width="100" src='{{$item->img_produit}}' alt="img"></td>
                        <td>{{$item->name_produit}}</td>
                        <td>{{$item->prix}}</td>
                        <td>{{$item->description}}</td>
                        <td class="text-center">X{{$item->quantite}}</td>
                        @if ($item->nouvelle_colonne==0)                                                    
                            <td><button data-id="{{ $item->id }}" class="btn btn-success btn_confirmer">Confirmer</button></td>
                            <td><button class="btn btn-danger btn_supprimer" data-id="{{ $item->id }}">Supprimer</button></td>                                      
                        @else                            
                            <td class="text-success text-center " colspan="2">votre commende a ete confirmer</td>
                        @endif
                    </tr>                                    
                @endif                                             
                @endforeach
            </tbody>
        </table>
    </form>        
@endsection
</body>
<div class="loader-container">
    <div class="loader"></div>
</div>
</html>

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>        
        $(document).ready(function () {
            $('.loader-container').show();    
            setTimeout(function () {
                $('.loader-container').hide();
            }, 2000);
            $(document).on('click', '.btn_supprimer', function (e) {
                e.preventDefault();                
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var itemId = $(this).data('id');
                var row = $(this).closest('tr');
                $.ajax({
                    type: "post",
                    url: "{{ route('delete') }}",
                    data: {
                        'id': itemId,
                        '_token': csrfToken 
                    },
                    success: function (data) {
                        console.log(data);                                                
                        row.remove();
                        $('.div_supprimer').css('display','block')
                        setTimeout(function() {
                            $(".div_supprimer").css("display", "none");
                        }, 2000);
                    },
                    error: function (reject) {
                        console.log(reject);
                    }
                });
            });
            $(document).on('click', '.btn_confirmer', function (e) {
                e.preventDefault();                
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var itemId = $(this).data('id');
                $.ajax({
                    type: "post",
                    url: "{{ route('form_confirmation_view') }}",
                    data: {
                        'id': itemId,
                        '_token': csrfToken 
                    },
                    success: function (data) {
                        //console.log(data.donne);
                        window.location.href = "{{ route('test') }}?id=" + data.data;                                                                        
                    },
                    error: function (reject) {
                        console.log(reject);
                    }
                });
            });
        });
    </script>
@endsection