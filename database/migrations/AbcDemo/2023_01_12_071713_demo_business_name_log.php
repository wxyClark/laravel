<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'demo_business_name_log';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->integer('tenant_id')->unsigned()->default(0)->comment('租户ID');
            $table->bigInteger('business_name_code')->unsigned()->default(0)->comment('业务编码');
            $table->bigInteger('business_name_detail_code')->unsigned()->default(0)->comment('业务详情编码');
            $table->tinyInteger('action_type')->unsigned()->default(0)->comment('操作类型(1：A; 2:B)');
            $table->string('remark', 255)->default('')->comment('操作备注');

            //  只记录有变更的数据，每个字段一条记录，便于前段展示，查询
            $table->string('column_name')->comment('变更字段');
            $table->json('column_value')->comment('变更前后的值[before => [original => 1, transform => 状态1], after=> [] ]');

            $table->bigInteger('created_by_uniq_code')->unsigned()->default(0)->comment('创建人编码');
            $table->timestamps();

            $table->unique(['tenant_id', 'business_name_code'], 'uk_tenant_id_business_name_code');
            $table->index(['action_type'], 'idx_action_type');
            $table->index(['created_by_uniq_code'], 'idx_created_by_uniq_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
