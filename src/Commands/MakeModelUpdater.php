<?php

namespace Laimoon\ModelUpdater\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeModelUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:updater {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model updater.';

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * The construct.
     *
     * @param Filesystem $filesystem
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = $this->argument('model').'Updater';
        $updatersDir = app_path('Updaters');
        $updaterPath = app_path('Updaters/').$modelName.'.php';

        if (!$this->filesystem->isDirectory($updatersDir)) {
            $this->filesystem->makeDirectory($updatersDir, 0755, true);
        }

        if (!$this->filesystem->exists($updaterPath)) {
            $content = $this->getClassContentFromStub($modelName);

            $this->filesystem->put($updaterPath, $content);

            $this->info('Model updater generated');
        } else {
            $this->error('File Already Exists!');
        }
    }

    /**
     * @return string
     */
    protected function getClassContentFromStub($class)
    {
        return str_replace(
            '{{CLASSNAME}}',
            $class,
            $this->getStubContent()
        );
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @return string
     */
    protected function getStubContent()
    {
        return $this->filesystem->get(base_path('/vendor/laimoon/model-updater/stubs/ModelUpdater.stub'));
    }
}
