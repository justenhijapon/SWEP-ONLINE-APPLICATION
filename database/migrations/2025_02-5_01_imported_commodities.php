<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the table exists
        if (!Schema::hasTable('imported_commodities')) {
            // Create the table if it does not exist
            Schema::create('imported_commodities', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('year')->nullable();
                $table->date('date')->nullable();
                $table->text('name')->nullable();
                $table->text('designation')->nullable();
                $table->text('company')->nullable();
                $table->text('tin')->nullable();
                $table->text('quantity_mt')->nullable();
                $table->text('bill_landing_no')->nullable();
                $table->text('prod_description')->nullable();
                $table->text('country_origin')->nullable();
                $table->text('port_discharge')->nullable();
                $table->text('purpose_importation')->nullable();
                $table->text('bill_landing_path')->nullable();
                $table->text('commercial_invoice_path')->nullable();
                $table->text('packing_list_path')->nullable();
                $table->text('cert_origin')->nullable();
                $table->text('cert_analysis_path')->nullable();
                $table->text('notarized_gmo_non_gmo_path')->nullable();
                $table->text('important_declaration_path')->nullable();
                $table->text('path')->nullable();
                $table->text('recycle_path')->nullable();
                $table->integer('view_count')->default(0);
                $table->timestamps();
                $table->string('ip_created')->nullable();
                $table->string('ip_updated')->nullable();
                $table->string('user_created')->nullable();
                $table->string('user_updated')->nullable();
                $table->integer('post')->default(0);
                $table->integer('active')->nullable();

                // Soft delete and tracking columns
                $table->timestamp('deleted_at')->nullable();
                $table->unsignedBigInteger('deleted_by_user')->nullable();
                $table->timestamp('restored_at')->nullable();
                $table->unsignedBigInteger('restored_by_user')->nullable();
            });
        } else {
            // Modify the existing table to add missing columns
            Schema::table('imported_commodities', function (Blueprint $table) {
                if (!Schema::hasColumn('imported_commodities', 'slug')) {
                    $table->string('slug')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'year')) {
                    $table->string('year')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'date')) {
                    $table->date('date')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'name')) {
                    $table->string('name')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'designation')) {
                    $table->text('designation')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'company')) {
                    $table->text('company')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'tin')) {
                    $table->text('tin')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'contact')) {
                    $table->text('contact')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'quantity_mt')) {
                    $table->text('quantity_mt')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'bill_landing_no')) {
                    $table->text('bill_landing_no')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'prod_description')) {
                    $table->text('prod_description')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'country_origin')) {
                    $table->text('country_origin')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'port_discharge')) {
                    $table->text('port_discharge')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'purpose_importation')) {
                    $table->text('purpose_importation')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'bill_landing_path')) {
                    $table->text('bill_landing_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'commercial_invoice_path')) {
                    $table->text('commercial_invoice_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'packing_list_path')) {
                    $table->text('packing_list_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'cert_origin')) {
                    $table->text('cert_origin')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'cert_analysis_path')) {
                    $table->text('cert_analysis_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'notarized_gmo_non_gmo_path')) {
                    $table->text('notarized_gmo_non_gmo_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'important_declaration_path')) {
                    $table->text('important_declaration_path')->nullable();
                }

                if (!Schema::hasColumn('imported_commodities', 'path')) {
                    $table->text('path')->nullable();
                }if (!Schema::hasColumn('imported_commodities', 'recycle_path')) {
                    $table->text('recycle_path')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'view_count')) {
                    $table->integer('view_count')->default(0);
                }
                if (!Schema::hasColumn('imported_commodities', 'ip_created')) {
                    $table->string('ip_created')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'ip_updated')) {
                    $table->string('ip_updated')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'user_created')) {
                    $table->string('user_created')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'user_updated')) {
                    $table->string('user_updated')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'active')) {
                    $table->integer('active')->nullable();
                }

                if (!Schema::hasColumn('imported_commodities', 'post')) {
                    $table->integer('post')->default(0);
                }

                // Soft delete and tracking columns
                if (!Schema::hasColumn('imported_commodities', 'deleted_at')) {
                    $table->timestamp('deleted_at')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'deleted_by_user')) {
                    $table->unsignedBigInteger('deleted_by_user')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'restored_at')) {
                    $table->timestamp('restored_at')->nullable();
                }
                if (!Schema::hasColumn('imported_commodities', 'restored_by_user')) {
                    $table->unsignedBigInteger('restored_by_user')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imported_commodities');
    }
};
