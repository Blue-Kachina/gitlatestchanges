<?php

namespace bluekachina\gitlatestchanges\commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class GitLatestChanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:changelog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrubs GIT for changes, updates changelog accordingly.';

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
        $branch= config('gitlatestchanges.BRANCH_CHANGES_SINCE');
        $process = new \Symfony\Component\Process\Process(["git rev-parse --short --verify {$branch}"]);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if($process->isSuccessful()){
            $output = $process->getOutput();
            Log::debug($output);
        } else {
            throw new ProcessFailedException($process);
        }
    }
}
