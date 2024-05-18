<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style_rate.css') }}"  type="text/css">

</head>
<body>
  <div class="container">
    <div class="row mt-3 mb-3 border border-3 rounded rounded-5" style="background-color: #fff;">
        <div class="col-md-4">
            <!-- <img src="img/icon-256x256.png" alt=""> -->
            <div style="margin-top: 100px;">
            <h4 class="mt-2">ID: #{{ Auth::user()->id }}</h4>
            <h4 class="">Name: {{ Auth::user()->name }}</h4>

          </div>
        </div>
        <h1 class="col-md-4" style="margin-top: 5rem; font-size: 2.5rem;">Please rate out toilet</h1>
        {{--  @if (!empty(session('status')))
            <div class="alert alert-success">{{ Session('status') }}</div>
        @endif  --}}
        <div class="col-md-4 text-center">
            <img class="" src="{{ asset('img/logo-niso.png') }}" alt="" width="220px" height="250px">
            <h4 style="text-transform:uppercase;">{{ $restaurant->name }}</h4>
            <h4 style="text-transform:uppercase;">{{ $area->name }}</h4>
        </div>
    </div>
    <div class="row mt-2 text-center border border-3 rounded rounded-5" style="background-color: #fff;">
        <div class="col-md-4 pb-2">
            <img src="{{ asset('img/Excellent.svg') }}" alt="" width="215px" height="215px" data-bs-toggle="modal" data-bs-target="#exampleModal" class="excellent">
            <h3 class="fw-bold excellent" data-bs-toggle="modal" data-bs-target="#exampleModal">Excellent</h3>
        </div>
        <div class="col-md-4 pb-2">
            <img src="{{ asset('img/Average.svg') }}" alt="" width="215px" height="215px" data-bs-toggle="modal" data-bs-target="#exampleModal" class="average">
            <h3 class="fw-bold average" data-bs-toggle="modal" data-bs-target="#exampleModal">Average</h3>
        </div>
        <div class="col-md-4 pb-2">
            <img src="{{ asset('img/Poor.svg') }}" alt="" width="215px" height="215px" data-bs-toggle="modal" data-bs-target="#exampleModal" class="poor">
            <h3 class="fw-bold poor" data-bs-toggle="modal" data-bs-target="#exampleModal">Poor</h3>
        </div>
    </div>
        @if (!empty(session('status')))
            <h2 class="alert alert-success col-md-12 text-center mt-2">{{ Session('status') }}</h2>
        @endif



    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-primary fw-bold" id="exampleModalLabel">Notification</h1>
          {{--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  --}}
        </div>
        <div class="modal-body fw-bold">
            Thanks for rate! Have a nice day!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="exit">Exit (<span id="countdown">5</span>)</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->






  </div>
  {{--  @if (!empty(session('status')))
  <div class="alert alert-success">{{ Session('status') }}</div>
@endif  --}}
  <form action="{{ route('rate_action') }}" method="POST" style="display: none">
    @csrf
    <input type="text" name="rate" value="" id="result_rate">
    <input type="number" name="restaurant_id" value="{{ $restaurant->id }}">
    <input type="number" name="area_id" value="{{ $area->id }}">
    <input type="number" name="user_id" value="{{ Auth::user()->id }}">
    <input type="submit" value="submit" id="sb">
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  {{--  <script>
    $(document).ready(function() {
      function updateCount() {
        var count = 5;
        function countdown() {
          $('#countdown').text(count);
          if (count > 0) {
            count--;
            setTimeout(countdown, 1000);
          } else {
            var value = $('#countdown').text();
            console.log(value);  // Log the final value of the countdown
          }
        }
        countdown();
      }

      $(".excellent, .average, .poor").click(function(){
        var rate = $(this).hasClass("excellent") ? "excellent" : $(this).hasClass("average") ? "average" : "poor";
        $("#result_rate").val(rate);
        $(".excellent, .average, .poor").not(this).addClass("img-no-click");

        // Open the modal
        $('#exampleModal').modal('show');

        // Start the countdown
        updateCount();
      });
    });
  </script>  --}}
  {{--  <script>
    $(document).ready(function() {

        $(".excellent").click(function(){
            $("#result_rate").val("excellent");4
            $(".average").addClass("img-no-click");
            $(".poor").addClass("img-no-click");

            // Initial count
    var count = 5;

    // Function to update the count
    function updateCount() {
        $('#countdown').text(count);
        if (count > 0) {
            count--;
            setTimeout(updateCount, 1000);
        }
    }

    // Start the countdown
    updateCount();
        });
        $(".average").click(function(){
            $("#result_rate").val("average");4
            $(".excellent").addClass("img-no-click");
            $(".poor").addClass("img-no-click");
            // Initial count
    var count = 5;

    // Function to update the count
    function updateCount() {
        $('#countdown').text(count);
        if (count > 0) {
            count--;
            setTimeout(updateCount, 1000);
        }
    }

    // Start the countdown
    updateCount();
        });



        $(".poor").click(function(){
            $("#result_rate").val("poor");4
            $(".excellent").addClass("img-no-click");
            $(".average").addClass("img-no-click");
            // Initial count
    var count = 5;

    // Function to update the count
    function updateCount() {
        $('#countdown').text(count);
        if (count > 0) {
            count--;
            setTimeout(updateCount, 1000);
        }
    }

    // Start the countdown
    updateCount();
        });


        var value = $('#countdown').text();
        console.log(value);  // This will log the text content of the span

    });
</script>  --}}


<script>
    $(document).ready(function() {

      function updateCount() {
        var count = 5;
        function countdown() {
          $('#countdown').text(count);
          if (count > 0) {
            count--;
            setTimeout(countdown, 1000);
          } else {
            var value = $('#countdown').text();
            console.log(value);  // Log the final value of the countdown
            if ($('#countdown').text() == 0) {
                $('#sb').click();
            }
          }
        }
        countdown();
      }

      $(".excellent, .average, .poor").click(function(){
        var rate = $(this).hasClass("excellent") ? "excellent" : $(this).hasClass("average") ? "average" : "poor";
        $("#result_rate").val(rate);
        $(".excellent, .average, .poor").not(this).addClass("img-no-click");

        // Start the countdown
        updateCount();
      });

      //if ($('#countdown').text() == 0) {
        //window.location.href = 'https://www.youtube.com';
    //}


    $('#exit').click(function() {
        $('#sb').click();
    });

    });
  </script>
</body>
</html>
