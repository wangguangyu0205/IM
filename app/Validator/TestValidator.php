<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Validator;


use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class TestValidator
 * @package App\Validator
 * @Validator(name="TestValidator")
 */
class TestValidator
{
    /**
     * @IsInt()
     * @NotEmpty()
     * @Required()
     * @var integer
     */
    protected $id;
}
