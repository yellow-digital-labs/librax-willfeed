<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseTriggers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:database-triggers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add triggers to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `product_sellers_before_insert`');
        DB::unprepared('CREATE TRIGGER product_sellers_before_insert BEFORE INSERT ON `product_sellers` FOR EACH ROW
                BEGIN
                    SET NEW.seller_name = (SELECT business_name FROM user_details WHERE user_id=NEW.seller_id);
                    SET NEW.product_name = (SELECT name FROM products WHERE id=NEW.product_id);
                    SET NEW.tax = 22;
                    SET NEW.amount = NEW.amount_before_tax + (NEW.amount_before_tax*NEW.tax/100);
                    SET NEW.current_stock = 0;
                END');
        
        DB::unprepared('DROP TRIGGER IF EXISTS `product_sellers_before_update`');
        DB::unprepared('CREATE TRIGGER product_sellers_before_update BEFORE UPDATE ON `product_sellers` FOR EACH ROW
                BEGIN
                    SET NEW.tax = 22;

                    IF NEW.seller_id<>OLD.seller_id THEN
                        SET NEW.seller_name = (SELECT business_name FROM user_details WHERE user_id=NEW.seller_id);
                    END IF;

                    IF NEW.product_id<>OLD.product_id THEN
                        SET NEW.product_name = (SELECT name FROM products WHERE id=NEW.product_id);
                    END IF;

                    IF NEW.amount_before_tax <> OLD.amount_before_tax THEN
                        SET NEW.amount = NEW.amount_before_tax + (NEW.amount_before_tax*NEW.tax/100);
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `product_seller_inventory_histories_before_insert`');
        DB::unprepared('CREATE TRIGGER product_seller_inventory_histories_before_insert BEFORE INSERT ON `product_seller_inventory_histories` FOR EACH ROW
                BEGIN
                    SET NEW.product_sellers_id = (SELECT id FROM product_sellers WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id);
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `product_seller_inventory_histories_after_insert`');
        DB::unprepared('CREATE TRIGGER product_seller_inventory_histories_after_insert AFTER INSERT ON `product_seller_inventory_histories` FOR EACH ROW
                BEGIN
                    
                END');
    }
}
