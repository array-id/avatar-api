<?php

namespace App\Console\Commands;

use ArrayID\StubGenerator;
use Illuminate\Console\Command;

class AvatarPipelineGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:avatar-pipeline {className : The new AvataPipeline class.}';

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
     * @return int
     */
    public function handle()
    {
        $class = $this->argument('className');

        $stub = new StubGenerator(
            app_path("Stubs/AvatarPipeline.stub"),
            app_path("Services/AvatarDriver/Pipeline/$class.php")
        );

        $stub->render([
            ':CLASS_NAME:' => $class
        ]);

        $this->info(sprintf('AvatarPipeline [%s] Generated Sucessfully.', $class));
    }
}
