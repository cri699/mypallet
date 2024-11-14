<?php

namespace App\Http\Controllers;

use App\Enums\TransportType;
use App\Http\Requests\TransportUnit\TransportUnitIndexRequest;
use App\Http\Requests\TransportUnit\TransportUnitStoreRequest;
use App\Models\TransportUnit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransportUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TransportUnitIndexRequest $request) : JsonResponse
    {
        $type = $request->query('type');
        $search = $request->query('search');

        $transportUnits = TransportUnit::where('type', $type)
            ->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
            ->get();

        return response()->json($transportUnits, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportUnitStoreRequest $request) : JsonResponse
    {
        $transportUnit = TransportUnit::create($request->validated());
        return response()->json($transportUnit, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
}
