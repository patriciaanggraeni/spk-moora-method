<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $criteria = Criterion::all();

        return view('criteria.index')->with([
            'title' => 'Criteria',
            'prev_step' => route('home'),
            'next_step' => route('alternative.index'),
            'criteria' => $criteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('criteria.create')->with([
            'title' => 'Tambah Kriteria',
            'prev_step' => route('criteria.index'),
            'next_step' => route('alternative.index'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|between:0,99.99',
            'type' => 'required|in:benefit,cost',
        ]);

        $criterion = new Criterion;
        $criterion->name = $validatedData['name'];
        $criterion->weight = $validatedData['weight'];
        $criterion->type = $validatedData['type'];
        $criterion->save();

        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Criterion $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criterion $criteria)
    {
        return view('criteria.edit')->with([
            'title' => 'Edit Kriteria',
            'criteria' => $criteria,
            'prev_step' => route('criteria.index'),
            'next_step' => route('criteria.update', $criteria->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criterion $criteria)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'type' => 'required|in:benefit,cost',
        ]);

        $criteria->update($validatedData);
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criterion $criteria)
    {
        $criteria->delete();
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
