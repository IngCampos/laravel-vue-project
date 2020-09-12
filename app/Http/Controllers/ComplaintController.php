<?php

namespace App\Http\Controllers;

use App\Complaint;
use App\Http\Requests\ComplaintRequest;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::find($id);
        $complaint->delete();
    }
}
