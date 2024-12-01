<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Thêm giá trị 'paid' vào enum
            $table->enum('invoice_status', ['not_created', 'created', 'paid'])->default('not_created')->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Quay lại trạng thái ban đầu của enum
            $table->enum('invoice_status', ['not_created', 'created'])->default('not_created')->change();
        });
    }

};
