<?php declare(strict_types=1);
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Migration;


use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class Test
 * @package App\Migration
 * @Migration(time=20200331133425)
 */
class Test extends BaseMigration
{

    const TABLE = 'test';

    public function up(): void
    {
        $this->schema->createIfNotExists(self::TABLE, function (Blueprint $blueprint) {
            $blueprint->comment('test database');
            $blueprint->increments('id')->comment('主键id');
            $blueprint->char('name','20')->comment('用户名');
            $blueprint->char('password','20')->comment('密码');
            $blueprint->index(['name']);
            $blueprint->engine  = 'Innodb';
            $blueprint->charset = 'utf8mb4';
        });
    }

    public function down(): void
    {
        $this->schema->dropIfExists(self::TABLE);
    }
}
