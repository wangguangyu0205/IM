<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Validator;


use Swoft\Validator\Annotation\Mapping\IsArray;
use Swoft\Validator\Annotation\Mapping\IsInt;
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
     * @var int
     */
    protected $id;
}
