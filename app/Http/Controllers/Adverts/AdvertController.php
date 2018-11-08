<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    public function index(Region $region = null)
    {
        $query = Advert::active()->with(['region'])->orderByDesc('published_at');

        if ($region) {
            $query->forRegion($region);
        }

        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $adverts = $query->paginate(20);

        return view('adverts.index', compact('region', 'regions', 'adverts'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return view('adverts.show', compact('advert'));
    }
}