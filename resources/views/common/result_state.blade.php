@if(Session::has("result"))
    @if(Session::get("result")["code"] == 1)
        toastr.success("{{ Session::get("result")["message"] }}");
    @endif

    @if(Session::get("result")["code"] == 0)
        toastr.error("{{ Session::get("result")["message"] }}");
    @endif
@endif