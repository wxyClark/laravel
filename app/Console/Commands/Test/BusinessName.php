<?php

namespace App\Console\Commands\Test;

use App\Services\AbcDemo\BusinessNameService;
use Illuminate\Console\Command;

class BusinessName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test:BusinessName {--action=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $action = $this->option('action');
        if (empty($action)) {
            return Command::INVALID;
        }

        dd($this->$action());
    }

    /**
     * @desc ok
     * @return mixed
     * @author wxy
     * @ctime 2023/2/14 11:00
     */
    private function add()
    {
        $params = [
            'tenant_id'     => 500001,
            'user_code'     => 111111,
            'business_name' => '业务名称1',
            'color'         => 'FFF333',
            'type'          => 1,
            'status'        => 2,
            'percent'       => 34,

            'details' => [
                [
                    'desc'               => '详细描述1',
                    'attributes'         => [
                        'label' => 'label1',
                        'key' => 'key1',
                    ],
                ],
                [
                    'desc'               => '详细描述2',
                    'attributes'         => [
                        'label' => 'label2',
                        'key' => 'key2',
                    ],
                ],
            ],
        ];

        return app(BusinessNameService::class)->add($params);
    }
}
