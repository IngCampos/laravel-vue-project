<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Complaint_type;
use App\Http\Requests\ComplaintRequest;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->paginate(10);
        return [
            'pagination' => [
                'total' => $complaints->total(),
                'current_page' => $complaints->currentPage(),
                'per_page' => $complaints->perPage(),
                'last_page' => $complaints->lastPage(),
                'from' => $complaints->firstItem(),
                'to' => $complaints->lastItem(),
            ],
            'complaints' => $complaints->load('complaint_type')
        ];
    }
    
    public function create()
    {
        return view('public/contact', [
            'complaint_types' =>  Complaint_type::get()
        ]);
    }

    public function store(ComplaintRequest $request)
    {
        Complaint::create($request->all());

        return redirect('/');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
    }
}
