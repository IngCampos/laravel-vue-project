<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Http\Requests\AdvertisementRequest;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        return view('app.advertisement', [
            'advertisements' =>  Advertisement::orderBy('expiration', 'asc')->get()
        ]);
    }

    public function store(AdvertisementRequest $request)
    {
        unset($request->file);
        $advertisement = Advertisement::create($request->all());
        $this->upload_file($request->file, $request->image_source);
        
        return $advertisement;
    }

    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $advertisement->update($request->all());
        $advertisement->save();
        
        return $advertisement;
    }

    public function destroy(Advertisement $advertisement)
    {
        $this->delete_file($advertisement->image_source);
        $advertisement->delete();
    }

    /* Functions for the storage files */

    // TODO: create just one function for all controllers
    private function delete_file($image_source)
    {
        // array to get just the name file, not the path.
        $exploded = explode('/', $image_source);
        Storage::disk('public')->delete('/ads/' . end($exploded));
    }

    // TODO: create just one function for all controllers
    private function upload_file($file, $image_source)
    {
        // the array is split, the second place is the base64 code for saving well.
        $exploded = explode(',', $file);
        $decoded = base64_decode($exploded[1]);
        Storage::disk('public')->put('/ads/' . $image_source, $decoded, 'public');
    }
}
