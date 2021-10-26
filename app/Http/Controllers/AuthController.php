<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // PERTEMUAN PAK AIC 5 OKT

    public function register(Request $request)
    {
    $validatedData = $request->validate([
    'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
    ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
    ]);
    }

    public function login(Request $request)
    {
    if (!Auth::attempt($request->only('email', 'password'))) {
    return response()->json([
    'message' => 'Invalid login details'
            ], 401);
        }

    $user = User::where('email', $request['email'])->firstOrFail();

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
    ]);
    }
    //BATAS PERTEMUAN PAK AIC 5 OKT

    public function me(Request $request)
    {
    return $request->user();
    }

    /*public function me()
    {
        return
        [
            "NISN" => 3103119203,
            "Nama" => "Zulfiana Aulia Syafa",
            "Gender" => "Perempuan",
            "Phone" => 6281226000045,
            "Kelas" => "XII RPL 6"
        ];
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
