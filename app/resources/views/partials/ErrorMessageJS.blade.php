@if($errors->any())
    @php
        $errMessages = '';
        foreach($errors->all() as $err):
            $errMessages .= $err . "<br/>";
        endforeach;
    @endphp
    <script>
        toast.error("{!! $errMessages !!}")
    </script>
@endif
