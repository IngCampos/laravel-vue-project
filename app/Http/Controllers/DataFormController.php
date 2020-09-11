<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Department;
use Illuminate\Http\Request;
use App\User;
use App\Tender_section;
use Carbon\Carbon;

class DataFormController extends Controller
{
    //This controller is made in order to get specific data for sweetalerts option forms

    // TODO: Use the resource edit in each Controller instead of using this Controller.

    // TODO: Delete Request $request, it is not used.
    public function data_user(Request $request)
    {
        // Data for sweetalert
        $users = User::orderBy('name', 'asc')->get();
        foreach ($users as $concept) {
            $data[$concept->name . ' ' . $concept->id] = $concept->name;
        }
        return $data;
    }
    public function data_department(Request $request)
    {
        // Data for sweetalert
        foreach (Department::get() as $department) {
            $data[$department->id] = $department->name;
        }
        return  $data;
    }

    public function data_dates_complaint()
    {
        // Data for Vue2-pickdate, the dates allowed to select are between the last complaint and the present day
        return [explode(' ', Carbon::now())[0], explode(' ', Complaint::orderBy('created_at')->first()->created_at)[0]];
    }

    public function data_tender_section()
    {
        // Data for tender section form
        $tender_sections = Tender_section::orderBy('year', 'desc')->orderBy('number', 'asc')->get();
        for ($i = 0; $i < count($tender_sections); $i++) {
            $data[$tender_sections[$i]->id] = "Public tender " . ($tender_sections[$i]->isInternational ? 'International' : 'National') . " 00" . $tender_sections[$i]->number . -$tender_sections[$i]->year;
        }
        return $data;
    }

    public function date()
    {
        return explode('-', explode(' ', Carbon::now())[0]);
    }
}
