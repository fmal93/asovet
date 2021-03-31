
@if ($output->responseCode == 0)
    <form action="{{ $result->urlRedirection }}" method="POST" role="form" id="return-form">
        @csrf
        <input type="hidden" name="token_ws" value="{{ $tokenWs }}">
    </form>
    <script>
        document.getElementById('return-form').submit();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endif
       