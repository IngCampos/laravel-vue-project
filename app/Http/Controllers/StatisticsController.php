<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\User;
use App\Department;
use App\Complaint;
use App\Complaint_type;
use App\Permission;
use App\Machine;
use App\Machine_state;
use App\Tender;
use App\Tender_section;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function detail_user()
    {
        $data['total'] = User::all()->count();
        foreach (Department::all() as $department) {
            $data['department_types'][$department->name] = Department::find($department->id)->users()->count();
        }
        return $data;
    }

    public function detail_permission()
    {
        $data['total'] = 0;
        foreach (Permission::all() as $permission) {
            $data['permission_types'][$permission->name] = Permission::find($permission->id)->users()->count();
            $data['total'] +=  Permission::find($permission->id)->users()->count();
        }
        return $data;
    }

    public function detail_complaint($dates)
    {
        $date = explode(',', $dates);
        $data['total'] = Complaint::whereBetween('created_at', [$date[0], $date[1] . ' 23:59:59'])->count();
        $data['complaint_types'] = [];
        foreach (Complaint_type::all() as $complaint_type) {
            array_push($data['complaint_types'], (object) ['Type' => $complaint_type->name, "Amount" => Complaint_type::find($complaint_type->id)->complaints()->whereBetween('created_at', [$date[0], $date[1] . ' 23:59:59'])->count()]);
        }
        $data['date'] = Carbon::now();
        return $data;
    }

    public function detail_machine()
    {
        $data['total'] = Machine::all()->count();
        $data['machine_states'] = [];
        foreach (Machine_state::all() as $machine_state) {
            array_push($data['machine_states'], (object) ['State' => $machine_state->name, "Amount" => Machine_state::find($machine_state->id)->machines()->count()]);
        }
        $data['date'] = Carbon::now();
        return $data;
    }

    public function detail_advertisement()
    {
        $data['total'] = Advertisement::all()->count();
        $data['with_link'] = Advertisement::where('link', '!=', '')->count();
        return $data;
    }

    public function detail_tender()
    {
        $data['total'] = Tender::all()->count();
        $data['internal_file'] = Tender::where('internal_file', 1)->count();
        $data['external_file'] = Tender::where('internal_file', 0)->count();
        $data['tender_sections'] = [];
        foreach (Tender_section::orderBy('year', 'desc')->orderBy('number', 'asc')->get() as $tender_section) {
            array_push($data['tender_sections'], (object) ['Name' => "Public tender " . ($tender_section->isInternational ? "International" : "National") . " 00" .
                $tender_section->number . "-" . $tender_section->year, "Amount" => Tender_section::find($tender_section->id)->tenders()->count()]);
        }
        $data['date'] = Carbon::now();
        return $data;
    }
}
