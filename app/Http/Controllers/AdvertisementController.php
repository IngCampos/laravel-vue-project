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
        $request->validate([
            'order' => 'unique:advertisements'
        ]);

        // TODO: Use the functions all() as possible in order to have clean code
        $advertisement = new Advertisement();
        $advertisement->order = $request->order;
        $this->upload_file($request->file, $request->image_source);
        $advertisement->image_source = '/storage/ads/' . $request->image_source;
        $advertisement->link = $request->link;
        $advertisement->save();
        return $advertisement;
    }

    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        // TODO: Improve the PHP code
        //The function just update one value, the link or the order
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
