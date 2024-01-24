<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Car::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = Car::create([
            "licensePlateNumber" => $request->licensePlateNumber,
            "brand" => $request->brand,
            "model" => $request->model,
            "yearOfManufacture" => $request->yearOfManufacture,
            "fuelType" => $request->fuelType
            
        ]);
        return $car;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        if(is_null($car)) {
            return response()->json(["message"=>"No item found with id $id"],404);
        }
        return $car;
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
}
