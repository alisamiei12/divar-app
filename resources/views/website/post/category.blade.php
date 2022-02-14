@extends('website.main1')

@section('content')
  <div class="content-header">
    دیوار قم:‌ انواع آگهی‌ها و خدمات در قم
  </div>
  <div class="items" id="data-wrapper">
    
  </div>
@endsection

@section('scripts')
<script type="text/javascript">
var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);
        
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });
        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/c/{{$slug}}?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function () {
                        $('.auto-load').show();
                    }
                })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

</script>
@endsection