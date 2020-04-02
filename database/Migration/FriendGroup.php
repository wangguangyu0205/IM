<?php declare(strict_types=1);


namespace Database\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class FriendGroup
 *
 * @since 2.0
 *
 * @Migration(time=20200402150246)
 */
class FriendGroup extends BaseMigration
{
    const TABLE = 'friend_group';

    /**
     * @return void
     */
    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('好友分组表');
            $blueprint->increments('friend_group_id')->comment('主键');
            $blueprint->integer('user_id', false, true, 11)->comment('所属用户');
            $blueprint->char('friend_group_name', 30)->comment('分组名');
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
