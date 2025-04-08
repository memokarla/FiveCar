<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logoFivecar.png') }}" type="image/x-icon">
    <title>Order Detail - FiveCar</title>
</head>
<body class="overflow-x-hidden bg-[#121212]">

    @extends('navbar') <!-- path yang menyimpan template navbar --> 

        <div>
            @livewire('order-detail.index', ['id' => $id]) 
        </div>
        
    @extends('footer')
    
</body>
</html>