<?php

namespace App\Console\Commands;

use App\Models\ActualUser;
use App\Models\Customer;
use Illuminate\Console\Command;

class CustomerMigrateDataToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:data_migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data customer to user table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $customers = Customer::all();
        $count = $customers->count();
        if ($this->migrateConfirmation($count)) {
            $bar = $this->output->createProgressBar($count);
            $errors = collect([]);
            $this->info("Процесс...");
            $bar->start();
            $counter = 0;
            $time_pre = microtime(true);
            try {
                $this->dataTransfer($customers, $errors, $counter, $bar);
            } catch (\Exception $e) {
                $this->error('Ошибка при миграции данных ');
                $this->newLine();
                $this->error($e);
            }
            $time_post = microtime(true);
            $bar->finish();
            $exec_time = $time_post - $time_pre;
            $this->sendResultInfo($errors, $counter, $exec_time);
        }
    }

    private function sendResultInfo($errors, $counter, $exec_time): void
    {
        $this->newLine(2);
        $this->info("Миграция данных завершенена!");
        $this->table(
            ['Строк добавлено', '<error>Не прошло валидацию</error>', 'Время выполнения, с.'],
            [[$counter, '<fg=red>' . $errors->count() . '</>', $exec_time]]
        );
        if ($errors->count() > 0) {
            if ($this->confirm('<fg=yellow>Отобразить строки не прошедшие валидацию?</>')) {
                $this->newLine();
                $this->info("<error>Строки не прошедшие валидацию!</error>");
                $this->table(
                    ['firstname', 'lastname', 'phone', 'email'],
                    $errors->toArray(),
                );
            }
        }
    }

    private function dataTransfer($customers, &$errors, &$counter, &$bar): void
    {
        foreach ($customers as $customer) {
            $phoneValidate = $this->phoneValidate($customer->phone);
            $user = ActualUser::where('phone', $phoneValidate)->first();
            if (!$phoneValidate) {
                $errors->push([$customer->firstname, $customer->lastname, '<fg=red>' . $customer->phone . '</>' . ' <error>(не валидный)</error>', $customer->email]);
            } elseif ($user) {
                $errors->push([$customer->firstname, $customer->lastname, '<fg=red>' . $customer->phone . '</>' . ' <error>(дубликат)</error>', $customer->email]);
            } else {
                ActualUser::factory()->create([
                    'firstname' => $customer->firstname,
                    'lastname' => $customer->lastname,
                    'phone' => $phoneValidate,
                    'email' => $customer->email,
                    'created_at' => NOW(),
                    'updated_at' => NOW(),
                ]);
                $counter++;
            }
            $bar->advance();
        }
    }

    private function migrateConfirmation($count): bool
    {
        return $this->confirm('<fg=yellow>В таблице обнаружено ' . $count . ' записей, подтвердить миграцию?</>');
    }

    private function phoneValidate($phone): ?string
    {
        $phone = substr(preg_replace('![^0-9]+!', '', $phone), -10);
        if ($phone && strlen($phone) === 10) return $phone;
        return false;
    }
}
