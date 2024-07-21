<h1> About</h1>

<div> 
@foreach ($computers as $computer) 
<ul>
    <a href="{{ route('computers.show', ['computer' => $computer['id']]) }}" 
        <li> {{$computer['name']}} - {{$computer['price']}}</li>
    </a> 
</ul>

@endforeach

</div>