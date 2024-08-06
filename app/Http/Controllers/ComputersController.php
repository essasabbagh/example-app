<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Computer;

// class ComputersController extends Controller
// {

//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         return view('computers.index',[
//             'computers' => Computer::all()
//         ]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         return view('computers.create');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {

//         $request->validate([
//             'computer-name' =>'required|string|max:255',
//             'computer-price' =>'required|integer|min:1000|max:10000'
//         ]);
//         $computer = new Computer();

//         $computer->name = strip_tags($request->input('computer-name'));
//         $computer->price = strip_tags($request->input('computer-price'));

//         $computer->save();

//         return redirect()->route('computers.index');

//         // 

//         // need model fillablle
//         // https://laravel.com/docs/11.x/eloquent#mass-assignment

//         Computer::create([
//             'name' => strip_tags($request->input('computer-name')),
//             'price' => strip_tags($request->input('computer-price'))
//         ]);

//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $computer)
//     {
        
//         // $to_update = Computer::where('id', $computer)->first();
//         // $to_update = Computer::where('id', $computer)->get();
//         // if (is_null($to_update)) {
//         //     return view('computers.index');
//         // }
//         // dd($to_update);
//         return view('computers.show', [
//             // 'computer' => $to_update
//             'computer' => Computer::findOrFail($computer)
//         ]);
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $computer)
//     {
//         return view('computers.edit', [
//             'computer' => Computer::findOrFail($computer)
//         ]);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $computer)
//     {
//         $request->validate([
//             'computer-name' =>'required|string|max:255',
//             'computer-price' =>'required|integer|min:1000|max:10000'
//         ]);

//         $to_update = Computer::findOrFail($computer);
//         // $to_update = Computer::where($computer)->get();

//         // dd($to_update);

//         $to_update->name = strip_tags($request->input('computer-name'));
//         $to_update->price = strip_tags($request->input('computer-price'));

//         $to_update->save();

//         return redirect()->route('computers.show', $computer);
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $computer)
//     {
//         $to_delete = Computer::findOrFail($computer);
//         $to_delete->delete();

//         return redirect()->route('computers.index');
//     }
// }
