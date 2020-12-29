<?php

namespace App\Http\Controllers;

use App\Tender_section;
use App\Http\Requests\TenderSectionRequest;
use Illuminate\Support\Facades\Storage;


class TenderSectionController extends Controller
{
    public function index()
    {
        $tender_sections = Tender_section::orderBy('year', 'desc')->orderBy('number', 'asc')->get();
        for ($i = 0; $i < count($tender_sections); $i++) {
            $tender_sections[$i]->name = $tender_sections[$i]->get_name;
        }
        return view('permission.tender', [
            'tender_sections' =>  $tender_sections->load('tenders')
        ]);
    }

    public function store(TenderSectionRequest $request)
    {
        // TODO: Error in store a section
        $tender_section = new Tender_section();
        $tender_section->isInternational = ($request->isInternational == 'true' ? true : false);
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
        $tender_section->name = $tender_section->get_name;
        return $tender_section;
    }

    public function update(TenderSectionRequest $request, Tender_section $tender_section)
    {
        $tender_section->year = $request->year;
        $tender_section->isInternational = $request->isInternational;
        $tender_section->update();
        $tender_section->name = $tender_section->get_name;
        return $tender_section;
    }

    public function destroy(Tender_section $tender_section)
    {
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
