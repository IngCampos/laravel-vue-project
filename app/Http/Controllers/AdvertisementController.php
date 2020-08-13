<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advertisement::orderBy('order', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $advertisement = new Advertisement();
        $advertisement->order = $request->order;
        $this->upload_file($request->file, $request->image_source);
        $advertisement->image_source = $request->image_source;
        $advertisement->link = $request->link;
        $advertisement->save();
        return $advertisement;
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
        //The function just update one value, the link or the order
        $advertisement = Advertisement::find($id);
        if (isset($request->order)) {
            // The element that has the order it is obtained
            $auxiliar = Advertisement::where('order', $request->order)->first();
            if ($auxiliar != null) {
                // we look if an exist element has the new order to update.
                $auxiliar->order = $advertisement->order;
                $advertisement->order = null;
                $advertisement->update();
                $auxiliar->update();
                // the column of the element to update is set in null(unique column) and the element that has 
                // the order to update is set with the last order of the element to update
            }
            $advertisement->order = $request->order;
            $advertisement->update();
        } else {
            $advertisement->update($request->all());
        }
        return $advertisement;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::find($id);
        $this->delete_file($advertisement->image_source);
        $advertisement->delete();
    }

    /* Functions for the storage files */

    protected function delete_file($image_source)
    {
        // array to get just the name file, not the path.
        $exploded = explode('/', $image_source);
        Storage::disk('public')->delete('/carrousel/' . end($exploded));
    }

    protected function upload_file($file, $image_source)
    {
        // the array is split, the second place is the base64 code for saving well.
        $exploded = explode(',', $file);
        $decoded = base64_decode($exploded[1]);
        Storage::disk('public')->put('/carrousel/' . $image_source, $decoded, 'public');
    }
}
