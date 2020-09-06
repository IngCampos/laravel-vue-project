<?php

namespace App\Http\Controllers;

use App\Tender;
use App\Tender_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tender = new Tender();
        $tender->internal_file = $request->internal_file;
        $tender->name = $request->name;
        $tender->tender_section_id = $request->tender_section_id;
        if ($request->internal_file == 1) {
            $this->upload_file($request->file, $request->name_file);
            $tender->link = '/storage/tenders/' . $request->name_file;
        } else {
            $tender->link = $request->link;
        }
        $tender->save();
        return $tender;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $tender_section = Tender_section::find($tender->id);
        return $tender_section->tenders;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tender $tender)
    {
        // TODO: Use $tender parameters insted of Tender::find(id)
        $tender = Tender::find($tender->id);
        $tender->name = $request->name;
        $tender->update();
        return $tender;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender = Tender::find($tender->id);
        // if the tender has a internal file, it must be deleted.
        if ($tender->internal_file = 1)
            $this->delete_file($tender->link);
        $tender->delete();
    }

    /* Functions for the storage files */

    protected function upload_file($file, $name)
    {
        // the array is split, the second place is the base64 code for saving well.
        $exploded = explode(',', $file);
        $decoded = base64_decode($exploded[1]);
        Storage::disk('public')->put('/tenders/' . $name, $decoded, 'public');
    }

    protected function delete_file($link)
    {
        // array to get just the name file, not the path.
        $exploded = explode('/', $link);
        Storage::disk('public')->delete('/tenders/' . end($exploded));
    }
}
