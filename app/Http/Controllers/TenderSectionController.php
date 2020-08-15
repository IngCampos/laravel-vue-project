<?php

namespace App\Http\Controllers;

use App\Tender_section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TenderSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tender_sections = Tender_section::orderBy('year', 'desc')->orderBy('number', 'asc')->get();
        for ($i = 0; $i < count($tender_sections); $i++) {
            $tender_sections[$i]->tenders = Tender_section::find($tender_sections[$i]->id)->tenders;
        }
        return $tender_sections;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tender_section = new Tender_section();
        $tender_section->isFederal = ($request->isFederal == 'true' ? true : false);
        $tender_sections = Tender_section::where('year', $request->year)->orderBy('number', 'asc')->get();
        if (count($tender_sections) == 0) $tender_section->number = 1;
        else {
            for ($i = 0; $i < count($tender_sections); $i++) {
                if ($tender_sections[$i]->number != ($i + 1)) {
                    $tender_section->number = ($i + 1);
                    break;
                }
                if (($i + 1) == count($tender_sections)) {
                    $tender_section->number = $i + 2;
                }
            }
        }
        $tender_section->year = $request->year;
        $tender_section->save();
        $tender_section->tenders;
        return $tender_section;
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
        $tender_section = Tender_section::find($id);
        $tender_section->year = $request->year;
        $tender_section->isFederal = $request->isFederal;
        $tender_section->update();
        return $tender_section;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tender_section = Tender_section::find($id);
        $tenders = $tender_section->tenders;
        for ($i = 0; $i < count($tenders); $i++) {
            // all the files from this section are deleting
            $this->delete_file($tenders[$i]->link);
        }
        $tender_section->delete();
    }

    protected function delete_file($link)
    {
        // array to get just the name file, not the path.
        $exploded = explode('/', $link);
        Storage::disk('public')->delete('/tenders/' . end($exploded));
    }
}
