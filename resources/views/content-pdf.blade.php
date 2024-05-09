<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Generate</title>
    <style>
        td{
            width: 100% !important;
            border: 1px solid #ffffff;
            padding: 16px;
            text-align: justify;
        }
        td>.image{
            text-align: center !important;
        }
        /* table>tbody>tr>td>span>span{
            font-size: 40px !important;
        } */

        /* .content-container::before {
            content: "";
            background-image: url('{{asset("image/pattern.png")}}'); 
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            opacity: 0.3;
        } */
    </style>
</head>
<body >
    <div style="width: 100%; background-position:center; background-attachment:center; background-repeat: repeat-y; background-image:url('{{$content['background']}}')">
        {{-- <h3>{{$content->title}}</h3>

        {!! $content->contents !!} --}}
{{-- {{dd($contents)}} --}}

        @foreach ($contents as $content)
            <h3>{{$content->title}}</h3>

            {!! $content->contents !!}
        @endforeach
    </div>
</body>
</html>