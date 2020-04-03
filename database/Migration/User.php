<?php declare(strict_types=1);


namespace Database\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class User
 *
 * @since 2.0
 *
 * @Migration(time=20200402142240)
 */
class User extends BaseMigration
{

    const TABLE = 'user';

    /**
     * @return void
     */
    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('用户');
            $blueprint->increments('user_id')->comment('主键');
            $blueprint->string('email', 50)->comment('用户登录帐号 邮箱');
            $blueprint->char('username', 30)->comment('用户昵称');
            $blueprint->char('password', 60)->comment('用户密码');
            $blueprint->tinyInteger('status', false, true, 1)->default(0)->comment('用户在线状态 0离线 1在线');
            $blueprint->char('sign', 50)->comment('用户签名');
            $blueprint->string('avatar', 255)->comment('用户头像');
            $blueprint->timestamps();
//            $blueprint->tinyInteger('delete_flag', false, true, 1)->default(0)->comment('软删除 0正常 1删除');
            $blueprint->softDeletes()->comment('删除时间 为NULL未删除');
            $blueprint->index('user_id');
            $blueprint->index('user_login_id');
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
