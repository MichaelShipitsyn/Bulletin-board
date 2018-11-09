<?php

namespace App\Console\Commands\Search;

use App\Entity\Adverts\Advert\Advert;
use App\Services\Search\AdvertIndexer;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Illuminate\Console\Command;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Foundation\Application;

class InitCommand extends Command
{
    protected $signature = 'search:init';
    private $client;

    public function __construct(Application $app)
    {
        parent::__construct();
        $config = $app->make('config')->get('elasticsearch');
        $this->client = ClientBuilder::create()
            ->setHosts($config['hosts'])
            ->setRetries($config['retries'])
            ->build();
    }

    public function handle(): bool
    {
        try {
            $this->client->indices()->delete([
                'index' => 'my_avito'
            ]);
        } catch (Missing404Exception $e) {}

        $this->client->indices()->create([
            'index' => 'my_avito',
            'body' => [
                'mappings' => [
                    'advert' => [
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'published_at' => [
                                'type' => 'date',
                            ],
                            'title' => [
                                'type' => 'text',
                            ],
                            'content' => [
                                'type' => 'text',
                            ],
                            'price' => [
                                'type' => 'integer',
                            ],
                            'status' => [
                                'type' => 'keyword',
                            ],
                            'regions' => [
                                'type' => 'integer',
                            ],
                        ],
                    ],
                ],
                'settings' => [
                    'analysis' => [
                        'char_filter' => [
                            'replace' => [
                                'type' => 'mapping',
                                'mappings' => [
                                    '&=> and '
                                ],
                            ],
                        ],
                        'filter' => [
                            'word_delimiter' => [
                                'type' => 'word_delimiter',
                                'split_on_numerics' => false,
                                'split_on_case_change' => true,
                                'generate_word_parts' => true,
                                'generate_number_parts' => true,
                                'catenate_all' => true,
                                'preserve_original' => true,
                                'catenate_numbers' => true,
                            ],
                            'trigrams' => [
                                'type' => 'ngram',
                                'min_gram' => 4,
                                'max_gram' => 6,
                            ],
                        ],
                        'analyzer' => [
                            'default' => [
                                'type' => 'custom',
                                'char_filter' => [
                                    'html_strip',
                                    'replace',
                                ],
                                'tokenizer' => 'whitespace',
                                'filter' => [
                                    'lowercase',
                                    'word_delimiter',
                                    'trigrams',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        return true;
    }
}