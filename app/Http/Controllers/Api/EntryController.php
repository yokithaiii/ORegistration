<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntryRequest;
use App\Http\Resources\Api\EntryResource;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = EntryResource::collection(Entry::where('executor_id', auth()->id())->get());

        return response()->json([
            'data' => $entries
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntryRequest $request)
    {
        $data = $request->validated();

        $entry = Entry::updateOrCreate([
            'name' => $data['name'],
            'tel' => $data['tel'],
            'service' => $data['service'],
            'date' => $data['date'],
            'time' => $data['time'],
            'executor_id' => $data['executor_id'],
        ]);

        return response()->json([
            'message' => 'Новая запись',
            'data' => $entry,
        ], 201);
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
