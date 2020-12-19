<?php

namespace App\Console\Commands;

use ArrayID\StubGenerator;
use Illuminate\Console\Command;

class AvatarDriverGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:avatar-driver {className : The class name for the new AvatarDriver instance.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new AvatarDriver instance implementation.';

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
            app_path("Stubs/AvatarDriver.stub"),
            app_path("Services/AvatarDriver/$class.php")
        );

        $stub->render([
            ':CLASS_NAME:' => $class
        ]);

        $this->info(sprintf('AvatarDriver [%s] Generated Sucessfully.', $class));
    }
}
