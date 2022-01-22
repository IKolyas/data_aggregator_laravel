<?php

namespace App\Console\Commands;

use App\Models\ActualUser;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user factory';

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
    public function handle(): void
    {

        $count = $this->option('count');
//        if (!$count) $count = $this->ask('Количество генераций: ');
//        if (!(int)$count) $this->error('Введённые данные не являются числом!'); return;

        if ($this->confirm('Будет добавлено следующее количество записей: ' . $count . '. Подтвердить?')) {
            $bar = $this->output->createProgressBar($count);
            try {
                $this->info("Процесс...");
                $bar->start();
                $time_pre = microtime(true);
                for ($i = 1; $i <= $count; $i++) {
//                $user = ActualUser::factory()->count($count)->make();
                    ActualUser::factory()->count(1)->create();
                    $bar->advance();
                }
                $time_post = microtime(true);
                $exec_time = $time_post - $time_pre;
                $bar->finish();
                $this->newLine();
                $this->info("Данные успешно добавлены в таблицу!");
                $this->newLine();
                $this->table(
                    ['Количество строк добавлено', 'Всего строк', 'Время выполнения операции'],
                    [[$count, ActualUser::all()->count(), $exec_time]]
                );
            } catch (\Exception $e) {
                $this->error('Ошибка при добавлении данных! ' . $e);
                $this->newLine();
                $this->error($e);
            }

//        ActualUser::factory()->count($count)->make();
//        return 0;
        }
    }
}
