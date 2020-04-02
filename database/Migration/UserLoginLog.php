<?php declare(strict_types=1);


namespace Database\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class UserLoginLog
 *
 * @since 2.0
 *
 * @Migration(time=20200402143615)
 */
class UserLoginLog extends BaseMigration
{
    const TABLE = 'user_login_log';

    /**
     * @return void
     */
    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('用户登录日志');
            $blueprint->increments('user_login_log_id')->comment('主键');
            $blueprint->integer('user_id', false, true, 11)->comment('用户id');
            $blueprint->string('user_login_ip', 15)->default('')->comment('用户登录ip');
            $blueprint->timestamps();
//            $blueprint->tinyInteger('delete_flag', false, true, 1)->default(0)->comment('软删除 0正常 1删除');
            $blueprint->softDeletes()->comment('删除时间 为NULL未删除');
            $blueprint->index('user_id');
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
