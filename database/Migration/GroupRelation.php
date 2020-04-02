<?php declare(strict_types=1);


namespace Database\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class GroupRelation
 *
 * @since 2.0
 *
 * @Migration(time=20200402151950)
 */
class GroupRelation extends BaseMigration
{

    const TABLE = 'group_relation';

    /**
     * @return void
     */
    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('群友关系');
            $blueprint->increments('group_relation_id')->comment('主键');
            $blueprint->integer('user_id', false, true, 11)->comment('用户id');
            $blueprint->integer('friend_group_id', false, true, 11)->comment('好友所属分组id');
            $blueprint->timestamps();
//            $blueprint->tinyInteger('delete_flag', false, true, 1)->default(0)->comment('软删除 0正常 1删除');
            $blueprint->softDeletes()->comment('删除时间 为NULL未删除');
            $blueprint->index('user_id');
            $blueprint->index('friend_group_id');
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
