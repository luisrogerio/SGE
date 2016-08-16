@extends('layouts.layout')

@section('content')



    <body>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        function getMessage(){
            $.ajax({
                type:'post',
                url:'/getmsg',
                data:'_token = {!! csrf_token() !!}',
                success:function(data){
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>

    <div id = 'msg'>This message will be replaced using Ajax. Click the button to replace the message.</div>
    <?php
    echo Form::button('Replace Message',['onClick'=>'getMessage()']);
    ?>

    </body>
















@endsection