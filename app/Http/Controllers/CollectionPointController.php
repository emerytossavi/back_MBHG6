<?php

namespace App\Http\Controllers;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class CollectionPointController extends Controller
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
    public function show(CollectionPoint $collectionPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionPoint $collectionPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CollectionPoint $collectionPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionPoint $collectionPoint)
    {
        //
    }

    public function importFromCSV()
    {
        $path = public_path('data/coordonnes.csv');

        if (!file_exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Fichier CSV introuvable.'
            ], 404);
        }

        $file = fopen($path, 'r');
        $index = 1;
        $imported = 0;

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            if (count($data) < 2) continue;

            CollectionPoint::create([
                'name' => 'Point_' . $index,
                'address' => 'Point_' . $index,
                'latitude' => $data[0],
                'longitude' => $data[1],
            ]);

            $index++;
            $imported++;
        }

        fclose($file);

        return response()->json([
            'success' => true,
            'message' => "$imported points importés avec succès."
        ]);
    }

}
