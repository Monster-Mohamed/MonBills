<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionEditRequest;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view("sections.index", compact("sections"));
    }

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
    public function store(SectionRequest $request)
    {
        $validated = $request->validated();

        Section::create([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "Created_by" => Auth::user()->name,
        ]);
        session()->flash("Add", "تم اضافة القسم بنجاح");
        return redirect("/sections");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionEditRequest $request)
    {
        $id = $request->id;
        $validated = $request->validated();
        $section = Section::find($id);
        $section->update([
            "section_name" => $request->section_name,
            "description" => $request->description,
        ]);
        session()->flash("Edit", "تم التعديل بنجاح");
        return redirect("/sections");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::find($request->id)->delete();
        session()->flash("Delete", "تم الحذف بنجاح");
        return redirect("/sections");
    }
}
