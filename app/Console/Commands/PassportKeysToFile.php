<?php

namespace App\Console\Commands;

use App\Models\PassportKey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PassportKeysToFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:key-to-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = PassportKey::query()->where(['system' => 'backend'])->first();
        if (Storage::disk('storage')->put('oauth-public.key', $model->public_key)) {
            $this->info( "公钥已成功写入");
        } else {
            $this->error( "公钥已成功写入失败");
        }
        if (Storage::disk('storage')->put('oauth-private.key', $model->private_key)) {
            $this->info("私钥已成功写入");
        } else {
            $this->error("私钥已成功写入失败");
        }

    }
}
