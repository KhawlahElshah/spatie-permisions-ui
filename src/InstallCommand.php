<?php

namespace ISOMLY\SpatiePermissionsUI;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions-ui:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic permissions and roles views and routes for spatie permissions';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/stubs/routes.stub'),
            FILE_APPEND
        );

        $this->info('Permissions UI scaffolding generated successfully.');
    }
}
