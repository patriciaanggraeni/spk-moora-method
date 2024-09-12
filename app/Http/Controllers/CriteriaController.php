<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'next_step' => route('alternatives.index'),
            'criteria' => $criteria,
        ]);
    }


    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|between:0,99.99',
            'type' => 'required|in:benefit,cost',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('criteria.create')->with([
            'title' => 'Add Criteria',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Criterion::create([
            'name' => $request->input('name'),
            'weight' => $request->input('weight'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('criteria.index')->with('success', 'Criterion added successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criterion $criteria): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('criteria.edit')->with([
            'title' => 'Edit Criteria',
            'criteria' => $criteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criterion $criteria): RedirectResponse
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $criteria->update([
            'name' => $request->input('name'),
            'weight' => $request->input('weight'),
            'type' => $request->input('type'),
        ]);

        return redirect()->route('criteria.index')->with('success', 'Criterion updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criterion $criteria): RedirectResponse
    {
        $criteria->decisionMatrices()->delete();

        $criteria->delete();

        return redirect()->route('criteria.index')->with('success', 'Criterion deleted successfully.');
    }

}
