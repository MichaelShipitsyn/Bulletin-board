<?php

namespace App\Services\Search;

use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Advert\Value;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Foundation\Application;



class AdvertIndexer
{
    private $client;

    public function __construct(Application $app)
    {
        $config = $app->make('config')->get('elasticsearch');
        $this->client = ClientBuilder::create()
            ->setHosts($config['hosts'])
            ->setRetries($config['retries'])
            ->build();
    }

    public function clear(): void
    {
        $this->client->deleteByQuery([
            'index' => 'app',
            'type' => 'advert',
            'body' => [
                'query' => [
                    'match_all' => new \stdClass(),
                ],
            ],
        ]);
    }

    public function index(Advert $advert): void
    {
        $regions = [];

        if ($region = $advert->region) {
            do {
                $regions[] = $region->id;
            } while ($region = $region->parent);
        }

        $this->client->index([
            'index' => 'app',
            'type' => 'advert',
            'id' => $advert->id,
            'body' => [
                'id' => $advert->id,
                'published_at' => $advert->published_at ? $advert->published_at->format(DATE_ATOM) : null,
                'title' => $advert->title,
                'content' => $advert->content,
                'price' => $advert->price,
                'status' => $advert->status,
                'regions' => $regions,
            ],
        ]);
    }
    public function remove(Advert $advert): void
    {
        $this->client->delete([
            'index' => 'app',
            'type' => 'advert',
            'id' => $advert->id,
        ]);
    }
}