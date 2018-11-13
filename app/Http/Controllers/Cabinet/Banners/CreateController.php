<?php

namespace App\Http\Controllers\Cabinet\Banners;

use App\Entity\Banner\Banner;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateRequest;
use App\UseCases\Banners\BannerService;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    private $service;

    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    public function region(Region $region = null)
    {
        $regions = Region::where('parent_id', $region ? $region->id : null)->orderBy('name')->get();
        return view('cabinet.banners.create.region', compact('region', 'regions'));
    }

    public function banner(Region $region = null)
    {
        $formats = Banner::formatsList();
        return view('cabinet.banners.create.banner', compact('region', 'formats'));
    }

    public function store(CreateRequest $request, Region $region = null)
    {
        try {
            $banner = $this->service->create(
                Auth::user(),
                $region,
                $request
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.banners.show', $banner);
    }
}