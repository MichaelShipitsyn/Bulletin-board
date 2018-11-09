<?php

namespace App\UseCases\Adverts;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Region;
use App\Entity\User;
use App\Http\Requests\Adverts\CreateRequest;
use App\Http\Requests\Adverts\EditRequest;
use App\Http\Requests\Adverts\PhotosRequest;
use App\Http\Requests\Adverts\RejectRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdvertService
{
    public function create($userId, $regionId, CreateRequest $request): Advert
    {
        /** @var User $user */
        $user = User::findOrFail($userId);

        /** @var Region $region */
        $region = $regionId ? Region::findOrFail($regionId) : null;

        return DB::transaction(function () use ($request, $user, $region) {

            /** @var Advert $advert */
            $advert = Advert::make([
                'title' => $request['title'],
                'content' => $request['content'],
                'price' => $request['price'],
                'address' => $request['address'],
                'status' => Advert::STATUS_DRAFT,
            ]);

            $advert->user()->associate($user);
            $advert->region()->associate($region);
            $advert->saveOrFail();

            if (!empty($value)) {
                $advert->values()->create([
                    'value' => $value,
                ]);
            }

            return $advert;
        });
    }

    public function addPhotos($id, PhotosRequest $request): void
    {
        $advert = $this->getAdvert($id);

        DB::transaction(function () use ($request, $advert) {

            foreach ($request['files'] as $file) {
                $advert->photos()->create([
                    'file' => $file->store('adverts')
                ]);
            }
        });
    }

    public function edit($id, EditRequest $request): void
    {
        $advert = $this->getAdvert($id);

        $advert->update($request->only([
            'title',
            'content',
            'price',
            'address',
        ]));
    }

    public function sendToModeration($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->sendToModeration();
    }

    public function moderate($id): void
    {
        $advert = $this->getAdvert($id);

        $advert->moderate(Carbon::now());
    }

    public function reject($id, RejectRequest $request): void
    {
        $advert = $this->getAdvert($id);
        $advert->reject($request['reason']);
    }

    public function editAttributes($id, AttributesRequest $request): void
    {
        $advert = $this->getAdvert($id);

        DB::transaction(function () use ($request, $advert) {
            $advert->values()->delete();
            foreach ($advert->category->allAttributes() as $attribute) {
                $value = $request['attributes'][$attribute->id] ?? null;
                if (!empty($value)) {
                    $advert->values()->create([
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                    ]);
                }
            }
        });
    }

    public function expire(Advert $advert): void
    {
        $advert->expire();
    }

    public function close($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->close();
    }

    public function remove($id): void
    {
        $advert = $this->getAdvert($id);
        $advert->delete();
    }

    private function getAdvert($id): Advert
    {
        return Advert::findOrFail($id);
    }
}