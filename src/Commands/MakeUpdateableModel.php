<?php

namespace BinaryTorch\UpdatableModel\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeUpdateableModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:updateable {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new updateable model.';

    /**
     * @var Filesystem
     */
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generating a new updateable resource...');

        $updateablePath = app_path('UpdateableModels') . $this->argument('modelName') . 'UpdateableModel.php';

        dd($updateablePath);

        $this->info('Done.');
    }
}