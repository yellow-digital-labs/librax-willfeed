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

                    IF NEW.stock_lifetime <> OLD.stock_lifetime OR NEW.stock_in_transit <> OLD.stock_in_transit THEN
                        SET NEW.current_stock = NEW.stock_lifetime - NEW.stock_in_transit;
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
                    SET @stock_lifetime = (SELECT COALESCE(SUM(qty), 0) FROM product_seller_inventory_histories WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id);

                    UPDATE product_sellers SET stock_lifetime=@stock_lifetime, stock_updated_at=NEW.created_at WHERE id=NEW.product_sellers_id;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `orders_after_update`');
        DB::unprepared('CREATE TRIGGER orders_after_update AFTER UPDATE ON `orders` FOR EACH ROW
                BEGIN
                    IF NEW.order_status_id <> OLD.order_status_id THEN
                        SET @stock_in_transit = (SELECT NEW.product_qty FROM orders WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id AND order_status_id=2);

                        UPDATE product_sellers SET stock_in_transit=@stock_in_transit WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id;
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `customer_verifieds_before_insert`');
        DB::unprepared('CREATE TRIGGER customer_verifieds_before_insert BEFORE INSERT ON `customer_verifieds` FOR EACH ROW
                BEGIN
                    (SELECT business_name, region, created_at INTO @customer_name, @customer_region, @customer_since FROM user_details WHERE user_id=NEW.customer_id);

                    SET NEW.customer_name = @customer_name;
                    SET NEW.customer_region = @customer_region;
                    SET NEW.customer_since = @customer_since;
                    SET NEW.status_on = NOW();
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `customer_verifieds_before_update`');
        DB::unprepared('CREATE TRIGGER customer_verifieds_before_update BEFORE UPDATE ON `customer_verifieds` FOR EACH ROW
                BEGIN
                    IF NEW.status <> OLD.status THEN
                        SET NEW.status_on = NOW();
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `orders_before_insert`');
        DB::unprepared('CREATE TRIGGER orders_before_insert BEFORE INSERT ON `orders` FOR EACH ROW
                BEGIN
                    (SELECT business_name, contact_person INTO @user_name, @customer_contact FROM user_details WHERE user_id=NEW.user_id);
                    (SELECT business_name INTO @seller_name FROM user_details WHERE user_id=NEW.seller_id);
                    (SELECT name INTO @product_name FROM products WHERE id=NEW.product_id);
                    (SELECT amount INTO @product_amount FROM product_sellers WHERE product_id=NEW.product_id AND seller_id=NEW.seller_id);
                    (SELECT name INTO @order_status FROM order_statuses WHERE id=NEW.order_status_id);
                    (SELECT email INTO @customer_email FROM users WHERE id=NEW.user_id);

                    SET NEW.user_name = @user_name;
                    SET NEW.seller_name = @seller_name;
                    SET NEW.product_name = @product_name;
                    SET NEW.product_amount = @product_amount;
                    SET NEW.total_payable_amount = @product_amount * NEW.product_qty;
                    SET NEW.order_status = @order_status;
                    SET NEW.order_date = NOW();
                    SET NEW.customer_email = @customer_email;
                    SET NEW.customer_contact = @customer_contact;
                    SET NEW.payment_method_name = @payment_method_name;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `orders_before_update`');
        DB::unprepared('CREATE TRIGGER orders_before_update BEFORE UPDATE ON `orders` FOR EACH ROW
                BEGIN
                    IF NEW.order_status <> OLD.order_status THEN
                        (SELECT name INTO @order_status FROM order_statuses WHERE id=NEW.order_status_id);
                        SET NEW.order_status = @order_status;
                    END IF;
                END');
    }
}
