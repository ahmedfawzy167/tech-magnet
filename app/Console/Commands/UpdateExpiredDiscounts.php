<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Discount;
use Illuminate\Console\Command;

class UpdateExpiredDiscounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discounts:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Discounts that Expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Discount::where('expiry_date', '<', Carbon::now())
            ->update(['is_active' => 0]);

        $this->info('Expired Discounts Updated Successfully.');
    }
}
