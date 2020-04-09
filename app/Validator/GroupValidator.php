<?php
/**
 * @author gaobinzhan <gaobinzhan@gmail.com>
 */


namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Required;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class GroupValidator
 * @package App\Validator
 * @Validator(name="GroupValidator")
 */
class GroupValidator
{
    /**
     * @IsInt()
     * @Required()
     * @NotEmpty()
     * @var int
     */
    protected $user_id = '';

    /**
     * @IsString()
     * @Required()
     * @NotEmpty()
     * @Length(max=30)
     * @var string
     */
    protected $group_name = '';

    /**
     * @IsString()
     * @Required()
     * @NotEmpty()
     * @Length(max=30)
     * @var string
     */
    protected $avatar = '';

    /**
     * @IsString()
     * @Required()
     * @NotEmpty()
     * @Enum(values={"200","500","1000"})
     * @var string
     */
    protected $size = '';

    /**
     * @IsString()
     * @Required()
     * @NotEmpty()
     * @var string
     */
    protected  $introduction = '';

    /**
     * @IsInt()
     * @Required()
     * @NotEmpty()
     * @Enum(values={"0","1"})
     * @var int
     */
    protected $validation = '';
}
