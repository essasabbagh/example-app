<h1> computer details</h1>

<div> 
    {{$computer['name']}} - {{$computer['price']}} 
    <a href="{{route('computers.edit', $computer)}}"> edit </a>
    <form action="{{route('computers.destroy', $computer)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">delete</button>
    </form>



</div>