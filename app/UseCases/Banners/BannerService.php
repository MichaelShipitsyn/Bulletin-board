<?php

namespace App\UseCases\Banners;

use App\Entity\Banner\Banner;
use App\Entity\Region;
use App\Entity\User;
use App\Http\Requests\Banner\CreateRequest;
use App\Http\Requests\Banner\EditRequest;
use App\Http\Requests\Banner\FileRequest;
use App\Http\Requests\Banner\RejectRequest;
use App\Services\Banner\CostCalculator;
use Carbon\Carbon;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    private $calculator;

    public function __construct(CostCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function create(User $user, ?Region $region, CreateRequest $request): Banner
    {
        /** @var Banner $banner */
        $banner = Banner::make([
            'name' => $request['name'],
            'limit' => $request['limit'],
            'url' => $request['url'],
            'format' => $request['format'],
            'file' => $request->file('file')->store('banners', 'public'),
            'status' => Banner::STATUS_DRAFT,
        ]);

        $banner->user()->associate($user);
        $banner->region()->associate($region);
        $banner->saveOrFail();

        return $banner;
    }

    public function changeFile($id, FileRequest $request): void
    {
        $banner = $this->getBanner($id);

        if (!$banner->canBeChanged()) {
            throw new \DomainException('Unable to edit the banner.');
        }

        Storage::delete('public/' . $banner->file);

        $banner->update([
            'format' => $request['format'],
            'file' => $request->file('file')->store('banners', 'public'),
        ]);
    }

    public function editByOwner($id, EditRequest $request): void
    {
        $banner = $this->getBanner($id);

        if (!$banner->canBeChanged()) {
            throw new \DomainException('Unable to edit the banner.');
        }

        $banner->update([
            'name' => $request['name'],
            'limit' => $request['limit'],
            'url' => $request['url'],
        ]);
    }

    public function editByAdmin($id, EditRequest $request): void
    {
        $banner = $this->getBanner($id);

        $banner->update([
            'name' => $request['name'],
            'limit' => $request['limit'],
            'url' => $request['url'],
        ]);
    }

    public function sendToModeration($id): void
    {
        $banner = $this->getBanner($id);
        $banner->sendToModeration();
    }

    public function cancelModeration($id): void
    {
        $banner = $this->getBanner($id);
        $banner->cancelModeration();
    }

    public function moderate($id): void
    {
        $banner = $this->getBanner($id);
        $banner->moderate();
    }

    public function reject($id, RejectRequest $request): void
    {
        $banner = $this->getBanner($id);
        $banner->reject($request['reason']);
    }

    public function pay($id): void
    {
        $banner = $this->getBanner($id);
        $banner->pay(Carbon::now());
    }

    public function click(Banner $banner): void
    {
        $banner->click();
    }

    private function getBanner($id): Banner
    {
        return Banner::findOrFail($id);
    }

    public function removeByOwner($id): void
    {
        $banner = $this->getBanner($id);

        if (!$banner->canBeRemoved()) {
            throw new \DomainException('Unable to remove the banner.');
        }

        $banner->delete();

        Storage::delete('public/' . $banner->file);
    }

    public function removeByAdmin($id): void
    {
        $banner = $this->getBanner($id);
        $banner->delete();
        Storage::delete('public/' . $banner->file);
    }
}