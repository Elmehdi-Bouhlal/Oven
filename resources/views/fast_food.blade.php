@section('title', 'Home')
@extends('layout.master')    
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        <li><strong>{{session('success')}}</strong></li>
    </div>
@endif
@if (session()->has('success_deconnecter'))
    <div class="alert alert-danger" role="alert">
        <li><strong>{{session('success_deconnecter')}}</strong></li>
    </div>
@endif
<style>
    .card {
        transition: transform 0.3s;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: scale(1.1);
    }

    .div_success {
        position: fixed;
        top: 0;
        display: none;
        transition: transform 1s;
        z-index: 999;
        width: 100%;
        text-align: center;
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
        align-items: center;
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
<div class="alert alert-success div_success" role="alert">
    <li><strong>ajouter au panier avec succès</strong></li>
</div>
<h2 style="font-weight: 700" class="text-center text-success my-4">Fast food</h2>
<div class="container my-5">
    <div class="row">
        @foreach ($data as $item)
        @if ($item->type == 'fast food')                    
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{$item->img_url}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title name">{{$item->name}}</h5>
                    <p style="display: none">{{$item->img_url}}</p>
                    @auth
                    <p style="display: none">{{auth()->user()->email}}</p>
                    @endauth                
                    <p class="card-text description">{{$item->description}}</p>
                    <p class="card-text prix">{{$item->prix}} dh</p>
                    <hr>
                    @guest
                    <div class="alert alert-warning" role="warning"><li>pour acheter vous devez être connecté</li></div>
                    <a href="/login" class="btn btn-warning text-dark" style="text-decoration: none">login</a>
                    @endguest
                    @auth
                    <a href="#" class="btn btn-warning btn-add-to-cart">Ajouter au panier</a>
                    <div class="d-flex justify-content-between my-2">
                        <button type="button" class="btn btn-primary btn-increment">+</button>
                        <p class="counter quantite">0</p>
                        <button type="button" class="btn btn-danger btn-decrement">-</button>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<x-footer />
<div class="loader-container">
    <div class="loader"></div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('.loader-container').show();    
            setTimeout(function () {
                $('.loader-container').hide();
            }, 1500);
        $(document).on('click', '.btn-add-to-cart', function (e) {
            e.preventDefault();

            var card = $(this).closest('.card');

            function getTrimmedText(selector) {
                var element = card.find(selector);
                return element.length ? element.text().trim() : '';
            }

            $.ajax({
                type: "post",
                url: "{{ route('stock') }}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'name_produit': getTrimmedText('.name'),
                    'img_url': getTrimmedText('.card-img-top'),
                    'description_produit': getTrimmedText('.description'),
                    'prix_produit': getTrimmedText('.prix'),
                    'quantite_produit': getTrimmedText('.quantite'),
                    'user': getTrimmedText('#utilisateur')
                },
                success: function (data) {
                    console.log(data);
                    $('.div_success').css('display', 'block');
                    setTimeout(function () {
                        $(".div_success").css("display", "none");
                    }, 2000);
                    $('.quantite').text(0);
                },
                error: function (reject) {
                    console.log(reject);
                }
            });
        });

        $(document).on('click', '.btn-increment', function () {
            var counterElement = $(this).siblings('.quantite');
            counterElement.text(parseInt(counterElement.text()) + 1);            
        });

        $(document).on('click', '.btn-decrement', function () {
            var counterElement = $(this).siblings('.quantite');
            var currentValue = parseInt(counterElement.text());
            counterElement.text(currentValue > 0 ? currentValue - 1 : 0);
        });
    });
</script>
@endsection
