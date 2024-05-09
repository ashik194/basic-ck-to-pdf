<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table>tbody>tr>td>span>span{
            font-size: 40px !important;
        }
        td>.image{
            text-align: center !important;
        }
        
        .content-container::before {
            content: "";
            background-image: url('{{asset("image/pattern.png")}}'); 
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            background-position:center;
            background-attachment:center;
            background-repeat: repeat-y;
        }
    </style>
</head>
<body>
    <div class="content-container" >
        <h3>{{$content->title}}</h3>
        <p style="width: 100%;">{!! $content->contents !!}</p>
        <a href="{{route('generate',$content->id)}}">Download</a>
    </div>
</body>
</html>