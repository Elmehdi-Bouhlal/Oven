@props(['data'])

<style>
    .card {
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.1);
    }
</style>

<div class="container">
  <div class="row justify-content-center">
    @foreach ($data as $item)
      <div class="col-md-4 mb-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="{{$item->img_url}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title name">{{$item->name}}</h5>
            <p class="card-text description">{{$item->description}}</p>
            <p class="card-text prix">{{$item->prix}} dh</p>
            <a href="#" class="btn btn-warning btn-add-to-cart">Ajouter au panier</a>
            <div class="d-flex justify-content-between my-2">
              <button type="button" class="btn btn-primary btn-increment">+</button>
              <p class="counter quantite">0</p>
              <button type="button" class="btn btn-danger btn-decrement">-</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@section('script')
    <script>
      $(document).on('click', '.btn-add-to-cart', function (e) {
        e.preventDefault();
        var card = $(this).closest('.card');
        $.ajax({
          type: "post",
          url: "{{ route('stock') }}",
          data: {
            '_token': "{{csrf_token()}}",
            'name_produit': card.find('.name').text(),
            'description_produit': card.find('.description').text(),
            'prix_produit': card.find('.prix').text(),
            'quantite_produit': card.find('.quantite').text()
          },
          success: function (response) {
            console.log(response);
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
    </script>
@endsection
