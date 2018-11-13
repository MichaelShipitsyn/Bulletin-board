<?php

namespace App\Http\Controllers\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Adverts\SearchRequest;
use App\ReadModel\AdvertReadRepository;
use App\UseCases\Adverts\SearchService;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function index(SearchRequest $request, Region $region = null)
    {
        $regions = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $adverts = $this->search->search($region, $request, 20, $request->get('page', 1));

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