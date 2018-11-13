<?php

namespace App\Http\Controllers\Cabinet\Adverts;

use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\CreateRequest;
use App\UseCases\Adverts\AdvertService;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    private $service;

    public function __construct(AdvertService $service)
    {
        $this->service = $service;
    }

    public function region(Region $region = null)
    {
        $regions = Region::where('parent_id', $region ? $region->id : null)->orderBy('name')->get();
        return view('cabinet.adverts.create.region', compact('region', 'regions'));
    }

    public function advert(Region $region = null)
    {
        return view('cabinet.adverts.create.advert', compact('region'));
    }

    public function store(CreateRequest $request, Region $region = null)
    {
        try {
            $advert = $this->service->create(
                Auth::id(),
                $region ? $region->id : null,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('adverts.show', $advert);
    }
}