<?php declare(strict_types=1);


namespace Database\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class UserApplication
 *
 * @since 2.0
 *
 * @Migration(time=20200402152255)
 */
class UserApplication extends BaseMigration
{
    const TABLE = 'user_application';

    /**
     * @return void
     */
    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('用户申请表');
            $blueprint->increments('user_application_id')->comment('主键');
            $blueprint->integer('user_id', false, true, 11)->comment('申请方');
            $blueprint->integer('receiver_id', false, true, 11)->comment('接收方');
            $blueprint->enum('application_type', ['friend', 'group'])->comment('申请类型 好友 ｜ 群');
            $blueprint->tinyInteger('application_status', false, true, 1)->default(0)->comment('申请状态 0创建 1同意 2拒绝');
            $blueprint->string('application_reason', 255)->default('')->comment('申请原因');
            $blueprint->timestamps();
//            $blueprint->tinyInteger('delete_flag', false, true, 1)->default(0)->comment('软删除 0正常 1删除');
            $blueprint->softDeletes()->comment('删除时间 为NULL未删除');
            $blueprint->index('user_id');
            $blueprint->index('receiver_id');
            $blueprint->engine = 'Innodb';
            $blueprint->charset = 'utf8mb4';
        });

    }

    /**
     * @return void
     */
    public function down(): void
    {
        $this->schema->drop(self::TABLE);
    }
}
