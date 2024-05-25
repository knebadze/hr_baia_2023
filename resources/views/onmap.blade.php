@extends('layouts.appPage')
@section('title-block')
    {{ __('lang.page_title_onmap') }}
@endsection
@section('content')

<!-- CONTENT START -->
<div class="page-content">

    <!-- SECTION CONTENT START -->
   <coming-soon />
    <!-- SECTION CONTENT END  -->

 </div>
 <!-- CONTENT END -->
</div>
{{-- <script type="text/javascript">
    $(function()
    {
        $('.range input').on('mousemove', function(){
            var getValRange = $(this).val();
            $('.range span').text(getValRange + 'km');
        });

    });
</script> --}}
{{-- -------------------------------- --}}
{{-- <style>
    .slideContainer {
      width: 100%;
    }

    .sliderRange {
      -webkit-appearance: none;
      width: 100%;
      height: 15px;
      border-radius: 5px;
      background: #dae6f6;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }

    .sliderRange:hover {
      opacity: 1;
    }

    .sliderRange::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #1967d2;
      cursor: pointer;
    }

    .sliderRange::-moz-range-thumb {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #1967d2;
      cursor: pointer;
    }
    </style>
    <script>
        var slider = document.getElementById("myMapRange");
        var output = document.getElementById("mapRange");
        output.innerHTML = slider.value;

        slider.oninput = function() {
          output.innerHTML = this.value;
        }
    </script> --}}
@endsection
