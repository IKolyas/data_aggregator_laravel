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
        if ($this->confirm('В таблице "' . (new Customer())->getTable() . '" обнаружено ' . $count . ' записей, подтвердить миграцию?')) {
            $bar = $this->output->createProgressBar($count);
            $errors = collect([]);
            try {
                $this->info("Процесс...");
                $bar->start();
                $time_pre = microtime(true);
                $counter = 0;
                foreach ($customers as $customer) {
                    $phoneValidate = $this->phoneValidate($customer->phone);
                    $user = ActualUser::where('phone', $phoneValidate)->first();
                    if(!$phoneValidate) {
                        $errors->push([$customer->firstname, $customer->lastname, $customer->phone . ' (не валидный)', $customer->email]);
                    } elseif ($user) {
                        $errors->push([$customer->firstname, $customer->lastname, $customer->phone . ' (дубликат)', $customer->email]);
                    } else {
                        ActualUser::factory()->count(1)->create([
                            'firstname' => $customer->firstname,
                            'lastname' => $customer->lastname,
                            'phone' => $phoneValidate,
                            'email' => $customer->email,
                        ]);
                        $counter++;
                    }
                    $bar->advance();
                }

                $time_post = microtime(true);
                $exec_time = $time_post - $time_pre;
                $bar->finish();
                $this->newLine();
                $this->info("Миграция данных завершенена!");
                $this->newLine();
                $this->table(
                    ['Строк добавлено', 'Не прошло валидацию', 'Время выполнения, с.'],
                    [[$counter, $errors->count(), $exec_time]]
                );
                if($errors->count() > 0) {
                    $this->newLine();
                    $this->info("Строки не прошедшие валидацию!");
                    $this->table(
                        ['firstname', 'lastname', 'phone', 'email'],
                        $errors->toArray(),
                    );
                }

            } catch (\Exception $e) {
                $this->error('Ошибка при миграции данных ');
                $this->newLine();
                $this->error($e);
            }

//        ActualUser::factory()->count($count)->make();
//        return 0;
        }
    }

    private function phoneValidate($phone)
    {
        $phone = substr(preg_replace('![^0-9]+!', '', $phone), -10);
        if($phone && strlen($phone) === 10) return $phone;
        return false;
    }
}
