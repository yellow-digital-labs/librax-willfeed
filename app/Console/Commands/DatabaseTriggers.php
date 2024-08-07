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
        //products
        DB::unprepared('DROP TRIGGER IF EXISTS `products_before_insert`');
        DB::unprepared('CREATE TRIGGER products_before_insert BEFORE INSERT ON `products` FOR EACH ROW
                BEGIN
                    SET NEW.price_updated_at = CURDATE();
                END');
        
        DB::unprepared('DROP TRIGGER IF EXISTS `products_before_update`');
        DB::unprepared('CREATE TRIGGER products_before_update BEFORE UPDATE ON `products` FOR EACH ROW
                BEGIN
                    IF NEW.today_price<>OLD.today_price THEN
                        SET NEW.price_updated_at = CURDATE();
                    END IF;

                    IF NEW.price_updated_at<>OLD.price_updated_at THEN
                        SET NEW.old_price = OLD.today_price;
                        SET NEW.old_price_updated_at = OLD.price_updated_at;
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `products_after_insert`');
        DB::unprepared('CREATE TRIGGER products_after_insert AFTER INSERT ON `products` FOR EACH ROW
                BEGIN
                    INSERT INTO product_price_histories SET product_id=NEW.id, product_name=NEW.name, date=NEW.price_updated_at, price=NEW.today_price, date_old=NEW.old_price_updated_at, price_old=NEW.old_price;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `products_after_update`');
        DB::unprepared('CREATE TRIGGER products_after_update AFTER UPDATE ON `products` FOR EACH ROW
                BEGIN

                    IF NEW.price_type <> OLD.price_type THEN
                        UPDATE product_sellers SET price_type=NEW.price_type WHERE product_id=NEW.id;
                    ELSEIF NEW.today_price <> OLD.today_price AND NEW.price_type = "PLATTS" THEN
                        UPDATE product_sellers SET need_to_update = "1" WHERE product_id=NEW.id;
                    END IF;

                    IF NEW.today_price<>OLD.today_price THEN
                        IF NEW.price_updated_at<>OLD.price_updated_at THEN
                            -- INSERT
                            INSERT INTO product_price_histories SET product_id=NEW.id, product_name=NEW.name, date=NEW.price_updated_at, price=NEW.today_price, date_old=NEW.old_price_updated_at, price_old=NEW.old_price;
                        ELSE
                            -- UPDATE
                            UPDATE product_price_histories SET date=NEW.price_updated_at, price=NEW.today_price WHERE product_id=NEW.id AND date=NEW.price_updated_at;
                        END IF;
                    END IF;

                    IF NEW.tax <> OLD.tax THEN
                        UPDATE product_sellers SET tax=NEW.tax WHERE product_id=NEW.id;
                    END IF;
                END');

        //product_sellers
        DB::unprepared('DROP TRIGGER IF EXISTS `product_sellers_before_insert`');
        DB::unprepared('CREATE TRIGGER product_sellers_before_insert BEFORE INSERT ON `product_sellers` FOR EACH ROW
                BEGIN
                    SET NEW.seller_name = (SELECT business_name FROM user_details WHERE user_id=NEW.seller_id);
                    IF NEW.product_name IS NULL THEN
                        (SELECT name, price_type, today_price INTO @product_name, @price_type, @base_price FROM products WHERE id=NEW.product_id);
                        SET NEW.product_name = @product_name;
                        SET NEW.price_type = @price_type;
                    END IF;

                    IF NEW.price_type = "NORMAL PRICING" THEN
                        IF NEW.price_value IS NULL THEN
                            SET NEW.amount_before_tax = 0;
                        ELSE
                            SET NEW.amount_before_tax = NEW.price_value;
                        END IF;
                        IF NEW.price_value_30gg IS NULL THEN
                            SET NEW.amount_30gg = 0;
                        ELSE
                            SET NEW.amount_30gg = NEW.price_value_30gg;
                        END IF;
                        IF NEW.price_value_60gg IS NULL THEN
                            SET NEW.amount_60gg = 0;
                        ELSE
                            SET NEW.amount_60gg = NEW.price_value_60gg;
                        END IF;
                        IF NEW.price_value_90gg IS NULL THEN
                            SET NEW.amount_90gg = 0;
                        ELSE
                            SET NEW.amount_90gg = NEW.price_value_90gg;
                        END IF;
                    ELSEIF NEW.price_type = "PLATTS" THEN
                        IF NEW.price_value IS NULL THEN
                            SET NEW.amount_before_tax = 0;
                        ELSE
                            SET NEW.amount_before_tax = @base_price + NEW.price_value;
                        END IF;
                        IF NEW.price_value_30gg IS NULL THEN
                            SET NEW.amount_30gg = 0;
                        ELSE
                            SET NEW.amount_30gg = @base_price + NEW.price_value_30gg;
                        END IF;
                        IF NEW.price_value_60gg IS NULL THEN
                            SET NEW.amount_60gg = 0;
                        ELSE
                            SET NEW.amount_60gg = @base_price + NEW.price_value_60gg;
                        END IF;
                        IF NEW.price_value_90gg IS NULL THEN
                            SET NEW.amount_90gg = 0;
                        ELSE
                            SET NEW.amount_90gg = @base_price + NEW.price_value_90gg;
                        END IF;
                    END IF;

                    SET NEW.tax = (SELECT tax FROM products WHERE id=NEW.product_id);
                    IF NEW.amount_before_tax IS NULL THEN
                        SET NEW.amount_before_tax = 0;
                    END IF;
                    IF NEW.amount_30gg IS NULL THEN
                        SET NEW.amount_30gg = 0;
                    END IF;
                    IF NEW.amount_60gg IS NULL THEN
                        SET NEW.amount_60gg = 0;
                    END IF;
                    IF NEW.amount_90gg IS NULL THEN
                        SET NEW.amount_90gg = 0;
                    END IF;
                    SET NEW.amount = NEW.amount_before_tax + (NEW.amount_before_tax*NEW.tax/100);
                    -- SET NEW.current_stock = 0;
                    SET NEW.amount_before_tax_old = NEW.amount_before_tax;
                    SET NEW.amount_before_tax_old_date = CURDATE();
                END');
        
        DB::unprepared('DROP TRIGGER IF EXISTS `product_sellers_before_update`');
        DB::unprepared('CREATE TRIGGER product_sellers_before_update BEFORE UPDATE ON `product_sellers` FOR EACH ROW
                BEGIN
                    -- SET NEW.tax = 22;
                    (SELECT today_price INTO @base_price FROM products WHERE id=NEW.product_id);
                    IF NEW.need_to_update = "1" THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = NEW.price_value;
                            END IF;
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = NEW.price_value_30gg;
                            END IF;
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = NEW.price_value_60gg;
                            END IF;
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = NEW.price_value_90gg;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = @base_price + NEW.price_value;
                            END IF;
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = @base_price + NEW.price_value_30gg;
                            END IF;
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = @base_price + NEW.price_value_60gg;
                            END IF;
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = @base_price + NEW.price_value_90gg;
                            END IF;
                        END IF;
                        SET NEW.need_to_update = "0";
                    END IF;
                    IF NEW.price_type <> OLD.price_type THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = NEW.price_value;
                            END IF;
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = NEW.price_value_30gg;
                            END IF;
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = NEW.price_value_60gg;
                            END IF;
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = NEW.price_value_90gg;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = @base_price + NEW.price_value;
                            END IF;
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = @base_price + NEW.price_value_30gg;
                            END IF;
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = @base_price + NEW.price_value_60gg;
                            END IF;
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = @base_price + NEW.price_value_90gg;
                            END IF;
                        END IF;
                    END IF;

                    IF NEW.price_value<>OLD.price_value THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = NEW.price_value;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value IS NULL THEN
                                SET NEW.amount_before_tax = 0;
                            ELSE
                                SET NEW.amount_before_tax = @base_price + NEW.price_value;
                            END IF;
                        END IF;
                    END IF;

                    IF NEW.price_value_30gg<>OLD.price_value_30gg THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = NEW.price_value_30gg;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value_30gg IS NULL THEN
                                SET NEW.amount_30gg = 0;
                            ELSE
                                SET NEW.amount_30gg = @base_price + NEW.price_value_30gg;
                            END IF;
                        END IF;
                    END IF;

                    IF NEW.price_value_60gg<>OLD.price_value_60gg THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = NEW.price_value_60gg;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value_60gg IS NULL THEN
                                SET NEW.amount_60gg = 0;
                            ELSE
                                SET NEW.amount_60gg = @base_price + NEW.price_value_60gg;
                            END IF;
                        END IF;
                    END IF;

                    IF NEW.price_value_90gg<>OLD.price_value_90gg THEN
                        IF NEW.price_type = "NORMAL PRICING" THEN
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = NEW.price_value_90gg;
                            END IF;
                        ELSEIF NEW.price_type = "PLATTS" THEN
                            IF NEW.price_value_90gg IS NULL THEN
                                SET NEW.amount_90gg = 0;
                            ELSE
                                SET NEW.amount_90gg = @base_price + NEW.price_value_90gg;
                            END IF;
                        END IF;
                    END IF;

                    IF NEW.seller_id<>OLD.seller_id THEN
                        SET NEW.seller_name = (SELECT business_name FROM user_details WHERE user_id=NEW.seller_id);
                    END IF;

                    IF NEW.product_id<>OLD.product_id THEN
                        SET NEW.product_name = (SELECT name FROM products WHERE id=NEW.product_id);
                    END IF;

                    IF NEW.amount_30gg IS NULL THEN
                        SET NEW.amount_30gg = 0;
                    END IF;
                    IF NEW.amount_60gg IS NULL THEN
                        SET NEW.amount_60gg = 0;
                    END IF;
                    IF NEW.amount_90gg IS NULL THEN
                        SET NEW.amount_90gg = 0;
                    END IF;

                    IF NEW.tax <> OLD.tax THEN
                        SET NEW.amount = NEW.amount_before_tax + (NEW.amount_before_tax*NEW.tax/100);
                    END IF;

                    IF NEW.amount_before_tax <> OLD.amount_before_tax THEN
                        IF NEW.amount_before_tax IS NULL THEN
                            SET NEW.amount_before_tax = 0;
                        END IF;
                        SET NEW.amount = NEW.amount_before_tax + (NEW.amount_before_tax*NEW.tax/100);

                        IF NEW.amount_before_tax_old_date IS NULL THEN
                            SET NEW.amount_before_tax_old = OLD.amount_before_tax;
                            SET NEW.amount_before_tax_old_date = CURDATE();
                        END IF;

                        IF NEW.amount_before_tax_old_date <> CURDATE() THEN
                            SET NEW.amount_before_tax_old = OLD.amount_before_tax;
                            SET NEW.amount_before_tax_old_date = CURDATE();
                        END IF;
                    END IF;

                    /* IF NEW.stock_lifetime <> OLD.stock_lifetime OR NEW.stock_in_transit <> OLD.stock_in_transit THEN
                        SET NEW.current_stock = NEW.stock_lifetime - NEW.stock_in_transit;
                    END IF; */
                END');

        //product_seller_inventory_histories
        DB::unprepared('DROP TRIGGER IF EXISTS `product_seller_inventory_histories_before_insert`');
        /* DB::unprepared('CREATE TRIGGER product_seller_inventory_histories_before_insert BEFORE INSERT ON `product_seller_inventory_histories` FOR EACH ROW
                BEGIN
                    SET NEW.product_sellers_id = (SELECT id FROM product_sellers WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id);
                END'); */

        DB::unprepared('DROP TRIGGER IF EXISTS `product_seller_inventory_histories_after_insert`');
        /* DB::unprepared('CREATE TRIGGER product_seller_inventory_histories_after_insert AFTER INSERT ON `product_seller_inventory_histories` FOR EACH ROW
                BEGIN
                    SET @stock_lifetime = (SELECT COALESCE(SUM(qty), 0) FROM product_seller_inventory_histories WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id);

                    UPDATE product_sellers SET stock_lifetime=@stock_lifetime, stock_updated_at=NEW.created_at WHERE id=NEW.product_sellers_id;
                END'); */

        //orders
        DB::unprepared('DROP TRIGGER IF EXISTS `orders_before_insert`');
        DB::unprepared('CREATE TRIGGER orders_before_insert BEFORE INSERT ON `orders` FOR EACH ROW
                BEGIN
                    (SELECT business_name, contact_person INTO @user_name, @customer_contact FROM user_details WHERE user_id=NEW.user_id);
                    (SELECT business_name INTO @seller_name FROM user_details WHERE user_id=NEW.seller_id);
                    (SELECT name INTO @product_name FROM products WHERE id=NEW.product_id);
                    (SELECT amount INTO @product_amount FROM product_sellers WHERE product_id=NEW.product_id AND seller_id=NEW.seller_id LIMIT 1);
                    (SELECT amount_before_tax INTO @amount_before_tax FROM product_sellers WHERE product_id=NEW.product_id AND seller_id=NEW.seller_id LIMIT 1);
                    (SELECT name INTO @order_status FROM order_statuses WHERE id=NEW.order_status_id);
                    -- (SELECT email INTO @customer_email FROM users WHERE id=NEW.user_id);

                    SET NEW.user_name = @user_name;
                    SET NEW.seller_name = @seller_name;
                    SET NEW.product_name = @product_name;
                    -- SET NEW.product_amount = @amount_before_tax;
                    -- SET NEW.total_payable_amount = @product_amount * NEW.product_qty;
                    SET NEW.order_status = @order_status;
                    -- SET NEW.order_date = NOW();
                    -- SET NEW.customer_email = @customer_email;
                    -- SET NEW.customer_contact = @customer_contact;
                    -- SET NEW.payment_method_name = @payment_method_name;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `orders_before_update`');
        DB::unprepared('CREATE TRIGGER orders_before_update BEFORE UPDATE ON `orders` FOR EACH ROW
                BEGIN
                    IF NEW.order_status_id <> OLD.order_status_id THEN
                        (SELECT name INTO @order_status FROM order_statuses WHERE id=NEW.order_status_id);
                        SET NEW.order_status = @order_status;

                        IF NEW.order_status_id = 2 OR NEW.order_status_id = 3 THEN
                            IF NEW.seller_note IS NOT NULL THEN
                                INSERT INTO order_activity_histories SET order_id=NEW.id, status_title=CONCAT("Ordine ", @order_status), status_description=CONCAT("Note: ", NEW.seller_note), status_updated_at=NEW.updated_at;
                            ELSE
                                INSERT INTO order_activity_histories SET order_id=NEW.id, status_title=CONCAT("Ordine ", @order_status), status_description=CONCAT("Ordine stato aggiornato con successo a ", @order_status), status_updated_at=NEW.updated_at;
                            END IF;
                        ELSE
                            INSERT INTO order_activity_histories SET order_id=NEW.id, status_title=CONCAT("Ordine ", @order_status), status_description=CONCAT("Ordine stato aggiornato con successo a ", @order_status), status_updated_at=NEW.updated_at;
                        END IF;
                    END IF;

                    IF NEW.total_paid_amount <> OLD.total_paid_amount OR NEW.total_payable_amount <> OLD.total_payable_amount THEN
                        SET NEW.total_pending_amount = NEW.total_payable_amount - NEW.total_paid_amount;

                        IF NEW.total_pending_amount <= 0 THEN
                            SET NEW.payment_status = "paid";
                        ELSE
                            SET NEW.payment_status = "unpaid";
                        END IF;
                    END IF;

                    IF NEW.payment_status <> OLD.payment_status THEN
                        IF NEW.payment_status = "paid" THEN
                            INSERT INTO order_activity_histories SET order_id=NEW.id, status_title="Paid", status_description="Ordine pagato con successo", status_updated_at=NEW.updated_at;
                        ELSE
                            INSERT INTO order_activity_histories SET order_id=NEW.id, status_title="Unpaid", status_description="Ordine non pagato con successo", status_updated_at=NEW.updated_at;
                        END IF;
                    END IF;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `orders_after_update`');
        DB::unprepared('CREATE TRIGGER orders_after_update AFTER UPDATE ON `orders` FOR EACH ROW
                BEGIN
                    IF NEW.order_status_id <> OLD.order_status_id THEN
                        /* SET @stock_in_transit = (SELECT IFNULL(SUM(product_qty), 0) FROM orders WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id AND order_status_id=2);

                        UPDATE product_sellers SET stock_in_transit=@stock_in_transit WHERE seller_id=NEW.seller_id AND product_id=NEW.product_id; */

                        IF NEW.order_status_id = 4 THEN
                            SELECT COALESCE(SUM(total_payable_amount), 0) INTO @credit_used FROM orders WHERE user_id=NEW.user_id AND seller_id=NEW.seller_id AND order_status_id=4 AND payment_status="unpaid";

                            UPDATE customer_verifieds SET credit_used=@credit_used WHERE seller_id=NEW.seller_id AND customer_id=NEW.user_id;
                        END IF;
                    END IF;

                    IF NEW.payment_status <> OLD.payment_status THEN
                        SELECT COALESCE(SUM(total_payable_amount), 0) INTO @credit_used FROM orders WHERE user_id=NEW.user_id AND seller_id=NEW.seller_id AND order_status_id=4 AND payment_status="unpaid";

                        UPDATE customer_verifieds SET credit_used=@credit_used WHERE seller_id=NEW.seller_id AND customer_id=NEW.user_id;
                    END IF;
                END');

        //customer_verifieds
        DB::unprepared('DROP TRIGGER IF EXISTS `customer_verifieds_before_insert`');
        DB::unprepared('CREATE TRIGGER customer_verifieds_before_insert BEFORE INSERT ON `customer_verifieds` FOR EACH ROW
                BEGIN
                    (SELECT business_name, region, created_at INTO @customer_name, @customer_region, @customer_since FROM user_details WHERE user_id=NEW.customer_id);
                    (SELECT business_name INTO @seller_name FROM user_details WHERE user_id=NEW.seller_id);

                    SET NEW.customer_name = @customer_name;
                    SET NEW.customer_region = @customer_region;
                    SET NEW.customer_since = @customer_since;
                    SET NEW.seller_name = @seller_name;
                    SET NEW.status_on = NOW();
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `customer_verifieds_before_update`');
        DB::unprepared('CREATE TRIGGER customer_verifieds_before_update BEFORE UPDATE ON `customer_verifieds` FOR EACH ROW
                BEGIN
                    IF NEW.status <> OLD.status THEN
                        SET NEW.status_on = NOW();
                    END IF;

                    IF NEW.credit_limit <> OLD.credit_limit THEN
                        SELECT COALESCE(SUM(total_payable_amount), 0) INTO @credit_used FROM orders WHERE user_id=NEW.customer_id AND seller_id=NEW.seller_id AND order_status_id=4 AND payment_status="unpaid";

                        SET NEW.credit_used = @credit_used;
                        SET NEW.credit_avail = NEW.credit_limit - @credit_used;
                    END IF;

                    IF NEW.credit_used <> OLD.credit_used THEN
                        SET NEW.credit_avail = NEW.credit_limit - NEW.credit_used;
                    END IF;
                END');

        //users
        DB::unprepared('DROP TRIGGER IF EXISTS `users_before_insert`');
        DB::unprepared('CREATE TRIGGER users_before_insert BEFORE INSERT ON `users` FOR EACH ROW
                BEGIN
                    IF NEW.accountType <> 0 THEN
                        SELECT name INTO @accountTypeName FROM account_types WHERE id=NEW.accountType;
                        SET NEW.accountTypeName = @accountTypeName;
                    ELSE
                        SET NEW.accountTypeName = "Admin";
                    END IF;

                    IF NEW.accountType = "1" THEN
                        SELECT id INTO @subscription_id FROM subscriptions WHERE `status`="active" AND plan_for="buyer" LIMIT 1;
                    ELSE
                        SELECT id INTO @subscription_id FROM subscriptions WHERE `status`="active" AND plan_for="seller" LIMIT 1;
                    END IF;
                    SET NEW.subscription_id = @subscription_id;
                    SET NEW.exp_datetime = DATE_ADD(CURDATE(), INTERVAL 30 DAY);

                    SELECT name, amount INTO @subscription_name, @subscription_amount FROM subscriptions WHERE id=NEW.subscription_id;

                    SET NEW.subscription_name = @subscription_name;
                    SET NEW.subscription_amount = @subscription_amount;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `users_before_update`');
        DB::unprepared('CREATE TRIGGER users_before_update BEFORE UPDATE ON `users` FOR EACH ROW
                BEGIN
                    IF NEW.subscription_id <> OLD.subscription_id THEN
                        SELECT name, amount, plan_validity INTO @subscription_name, @subscription_amount, @plan_validity FROM subscriptions WHERE id=NEW.subscription_id;

                        SET NEW.subscription_name = @subscription_name;
                        SET NEW.subscription_amount = @subscription_amount;
                        IF @plan_validity = "semestrale" THEN
                            SET NEW.exp_datetime = DATE_ADD(CURDATE(), INTERVAL 6 MONTH);
                        ELSEIF @plan_validity = "annuale" THEN
                            SET NEW.exp_datetime = DATE_ADD(CURDATE(), INTERVAL 1 YEAR);
                        ELSE
                            SET NEW.exp_datetime = DATE_ADD(CURDATE(), INTERVAL 30 DAY);
                        END IF;
                    END IF;
                END');

        //user_details
        DB::unprepared('DROP TRIGGER IF EXISTS `user_details_after_insert`');
        DB::unprepared('CREATE TRIGGER user_details_after_insert AFTER INSERT ON `user_details` FOR EACH ROW
                BEGIN
                    UPDATE users SET name=NEW.business_name, profile_completed="Yes" WHERE id=NEW.user_id;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `user_details_after_update`');
        DB::unprepared('CREATE TRIGGER user_details_after_update AFTER UPDATE ON `user_details` FOR EACH ROW
                BEGIN
                    IF NEW.business_name<>OLD.business_name THEN
                        UPDATE users SET name=NEW.business_name WHERE id=NEW.user_id;
                    END IF;
                END');

        //subscription_payments
        DB::unprepared('DROP TRIGGER IF EXISTS `subscription_payments_before_insert`');
        DB::unprepared('CREATE TRIGGER subscription_payments_before_insert BEFORE INSERT ON `subscription_payments` FOR EACH ROW
                BEGIN
                    SELECT business_name INTO @user_name FROm user_details WHERE user_id=NEW.user_id;
                    SELECT name, amount INTO @subscription_name, @subscription_amount FROM subscriptions WHERE id=NEW.subscription_id;

                    SET NEW.user_name = @user_name;
                    SET NEW.subscription_name = @subscription_name;
                    SET NEW.subscription_amount = @subscription_amount;
                    SET NEW.transaction_amount = @subscription_amount;
                END');

        //user ratings
        DB::unprepared('DROP TRIGGER IF EXISTS `ratings_before_insert`');
        DB::unprepared('CREATE TRIGGER ratings_before_insert BEFORE INSERT ON `ratings` FOR EACH ROW
                BEGIN
                    SELECT business_name INTO @review_by_name FROM user_details WHERE user_id=NEW.review_by_id;
                    SELECT business_name INTO @review_for_name FROM user_details WHERE user_id=NEW.review_for_id;

                    SET NEW.review_by_name = @review_by_name;
                    SET NEW.review_for_name = @review_for_name;
                END');

        //order payments
        DB::unprepared('DROP TRIGGER IF EXISTS `order_payments_before_insert`');
        DB::unprepared('CREATE TRIGGER order_payments_before_insert BEFORE INSERT ON `order_payments` FOR EACH ROW
                BEGIN
                    SELECT name INTO @payment_type_name FROM payment_options WHERE id=NEW.payment_type_id;

                    SET NEW.payment_type_name = @payment_type_name;
                END');

        DB::unprepared('DROP TRIGGER IF EXISTS `order_payments_after_insert`');
        DB::unprepared('CREATE TRIGGER order_payments_after_insert AFTER INSERT ON `order_payments` FOR EACH ROW
                BEGIN
                    SELECT SUM(payment_amount) INTO @total_paid_amount FROM order_payments WHERE order_id=NEW.order_id;
                    UPDATE orders SET total_paid_amount=@total_paid_amount WHERE id=NEW.order_id;
                END');

        //user_details
        DB::unprepared('DROP TRIGGER IF EXISTS `user_details_after_update`');
        DB::unprepared('CREATE TRIGGER user_details_after_update AFTER UPDATE ON `user_details` FOR EACH ROW
                BEGIN
                    IF NEW.business_name <> OLD.business_name THEN
                        UPDATE customer_verifieds SET seller_name = NEW.business_name WHERE seller_id=NEW.user_id;
                        UPDATE customer_verifieds SET customer_name = NEW.business_name WHERE customer_id=NEW.user_id;

                        UPDATE orders SET user_name = NEW.business_name WHERE user_id=NEW.user_id;
                        UPDATE orders SET seller_name = NEW.business_name WHERE seller_id=NEW.user_id;

                        UPDATE product_sellers SET seller_name = NEW.business_name WHERE seller_id=NEW.user_id;

                        UPDATE subscription_payments SET user_name=NEW.business_name WHERE user_id=NEW.user_id;

                        UPDATE ratings SET review_by_name=NEW.business_name WHERE review_by_id=NEW.user_id;
                        UPDATE ratings SET review_for_name=NEW.business_name WHERE review_for_id=NEW.user_id;
                    END IF;

                    IF NEW.region <> OLD.region THEN
                        UPDATE customer_verifieds SET customer_region = NEW.region WHERE customer_id=NEW.user_id;
                    END IF;
                END');

        //customer_groups
        DB::unprepared('DROP TRIGGER IF EXISTS `customer_groups_after_insert`');
        DB::unprepared('CREATE TRIGGER customer_groups_after_insert AFTER INSERT ON `customer_groups` FOR EACH ROW
                BEGIN
                    SET @customer_groups_id = NEW.id;
                    INSERT INTO product_sellers(customer_groups_id, seller_id, seller_name, product_id, product_name, price_type, price_value, price_value_30gg, price_value_60gg, need_to_update, price_value_90gg, amount_before_tax, amount_before_tax_old, amount_before_tax_old_date, amount_30gg, amount_60gg, amount_90gg, tax, amount, current_stock, stock_in_transit, stock_lifetime, stock_updated_at, add_vat_to_price, delivery_time, delivery_days, days_off, status, created_at, updated_at) SELECT @customer_groups_id, seller_id, seller_name, product_id, product_name, price_type, price_value, price_value_30gg, price_value_60gg, need_to_update, price_value_90gg, amount_before_tax, amount_before_tax_old, amount_before_tax_old_date, amount_30gg, amount_60gg, amount_90gg, tax, amount, current_stock, stock_in_transit, stock_lifetime, stock_updated_at, add_vat_to_price, delivery_time, delivery_days, days_off, status, created_at, updated_at FROM product_sellers WHERE seller_id=NEW.vendor_id AND customer_groups_id=0;
                END');
    }
}
