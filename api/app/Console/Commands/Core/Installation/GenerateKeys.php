<?php

namespace App\Console\Commands\Core\Installation;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Enum\Filesystem\Filesystem as FilesystemEnum;
use Modules\Core\Enum\Filesystem\Security;

class GenerateKeys extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:installation:keys';

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
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Filesystem $objFilesystem) {
        $objKeysPath = Security::KEYS;

        for ($i = 1; $i <= 10; $i++) {
            $keyPath = $objKeysPath->value . FilesystemEnum::DS . $i . FilesystemEnum::DS;
            $objPrivateKey = openssl_pkey_new();
            openssl_pkey_export($objPrivateKey, $strPrivateKey);
            $arrKeyDetails = openssl_pkey_get_details($objPrivateKey);

            $objFilesystem->put($keyPath . "private.key", $strPrivateKey);
            $objFilesystem->put($keyPath . "public.key", $arrKeyDetails["key"]);
        }

        return 0;
    }
}
