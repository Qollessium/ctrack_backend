<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\AttachCryptoCurrencyRequest;
use App\Http\Requests\API\User\DetachCryptoCurrencyRequest;
use App\Models\CryptoCurrency;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Attach a CryptoCurrency to the user.
     *
     * @param  AttachCryptoCurrencyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachCryptoCurrency(AttachCryptoCurrencyRequest $request)
    {
        $user = auth()->user();
        $cryptoCurrency = CryptoCurrency::find($request->crypto_currency_id);

        $user->cryptoCurrencies()->attach($cryptoCurrency, ['analyze_method' => $request->analyze_method]);

        return response()->json(['message' => 'CryptoCurrency attached successfully'], 200);
    }

    /**
     * Detach a CryptoCurrency from the user.
     *
     * @param  DetachCryptoCurrencyRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachCryptoCurrency(DetachCryptoCurrencyRequest $request)
    {
        $user = auth()->user();
        $user->cryptoCurrencies()->detach($request->crypto_currency_id);

        return response()->json(['message' => 'CryptoCurrency detached successfully'], 200);
    }

}