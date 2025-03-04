<li>
    @php
        $msg = "Hello, I am interested in your car " . \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeUrl("/{$car->id}/{$car->slug}");
        $isMobile = Browser::isMobile();
        $url = $isMobile ? "https://api.whatsapp.com/send?phone=" . urlencode($car->company?->phone_02) . "&text=" . urlencode($msg) : "https://web.whatsapp.com/send?phone=" . urlencode($car->company?->phone_02) . "&text=" . urlencode($msg);
    @endphp

{{--    <a class="car-contact btn-whatsapp-action" target="_blank" data-type="whatsapp" data-id="{{$car->id}}"--}}
    <a class="btn-whatsapp-action" target="_blank"  href="{{ $url }}"
       data-toggle="tooltip" data-placement="top"
       title="{{$car->company->phone_02}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24">
            <g>
                <path fill="none" d="M0 0h24v24H0z"/>
                <path fill-rule="nonzero" d="M2.004 22l1.352-4.968A9.954 9.954 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.954 9.954 0 0 1-5.03-1.355L2.004 22zM8.391 7.308a.961.961 0 0 0-.371.1 1.293 1.293 0 0 0-.294.228c-.12.113-.188.211-.261.306A2.729 2.729 0 0 0 6.9 9.62c.002.49.13.967.33 1.413.409.902 1.082 1.857 1.971 2.742.214.213.423.427.648.626a9.448 9.448 0 0 0 3.84 2.046l.569.087c.185.01.37-.004.556-.013a1.99 1.99 0 0 0 .833-.231c.166-.088.244-.132.383-.22 0 0 .043-.028.125-.09.135-.1.218-.171.33-.288.083-.086.155-.187.21-.302.078-.163.156-.474.188-.733.024-.198.017-.306.014-.373-.004-.107-.093-.218-.19-.265l-.582-.261s-.87-.379-1.401-.621a.498.498 0 0 0-.177-.041.482.482 0 0 0-.378.127v-.002c-.005 0-.072.057-.795.933a.35.35 0 0 1-.368.13 1.416 1.416 0 0 1-.191-.066c-.124-.052-.167-.072-.252-.109l-.005-.002a6.01 6.01 0 0 1-1.57-1c-.126-.11-.243-.23-.363-.346a6.296 6.296 0 0 1-1.02-1.268l-.059-.095a.923.923 0 0 1-.102-.205c-.038-.147.061-.265.061-.265s.243-.266.356-.41a4.38 4.38 0 0 0 .263-.373c.118-.19.155-.385.093-.536-.28-.684-.57-1.365-.868-2.041-.059-.134-.234-.23-.393-.249-.054-.006-.108-.012-.162-.016a3.385 3.385 0 0 0-.403.004z"/>
            </g>
        </svg>{{__('lang.Whatsapp')}}
    </a>

</li>
<li>
    <span  class="car-contact" data-type="email" data-id="{{$car->id}}" data-toggle="tooltip" data-placement="top" title="{{$car->company->user->email}}">
        <i class="fa fa-envelope"></i> {{__('lang.Email')}}
    </span>
</li>
<li>
    <span  class="car-contact" data-type="phone" data-id="{{$car->id}}" data-toggle="tooltip" data-placement="top" title="{{$car->company->phone_01}}">
        <i class="fa fa-phone"></i> {{__('lang.Call')}}
    </span>
</li>
@section('js')
    <script>
        $(document).ready(function() {
            $('.btn-whatsapp-action').on('click', function(e) {
                e.preventDefault(); // otherwise, it won't wait for the ajax response
                $link = $(this); // because '$(this)' will be out of scope in your callback

                $.ajax({
                    type: 'GET',
                    url: '{{LaravelLocalization::localizeUrl("/a/{$car->id}?type=whatsapp")}}', // Replace with your AJAX endpoint
                    // data: mydata,
                    contentType: 'application/json',
                    error: function (err) {
                        alert("error - " + err);
                    },
                    success: function () {
                        window.location.href = $link.attr('href');
                    }
                });



                // Perform the AJAX request
                {{--$.ajax({--}}
                {{--    url: '{{LaravelLocalization::localizeUrl("/a/{$car->id}?type=whatsapp")}}', // Replace with your AJAX endpoint--}}
                {{--    method: 'POST', // or 'GET' depending on your needs--}}
                {{--    data: {--}}
                {{--        car_id: carId,--}}
                {{--        type: type--}}
                {{--    },--}}
                {{--    success: function(response) {--}}
                {{--        console.log('AJAX request successful:', response);--}}
                {{--        // Handle the response here (e.g., show a message, redirect, etc.)--}}
                {{--    },--}}
                {{--    error: function(xhr, status, error) {--}}
                {{--        console.error('AJAX request failed:', error);--}}
                {{--        // Handle errors here--}}
                {{--    }--}}
                {{--});--}}
            });
        });
    </script>
@endsection
