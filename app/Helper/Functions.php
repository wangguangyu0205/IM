<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

function user_func(): string
{
    return 'hello';
}

if (!function_exists('apiSuccess')) {

    function apiSuccess($data, $code = 0, $msg = 'Success')
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return context()->getResponse()->withData($result);
    }
}

if (!function_exists('apiValidate')) {
    /**
     * @param array $data
     * @param string $validatorName
     * @param array $fields
     * @param array $userValidators
     * @param array $unfields
     *
     * @return array
     * @throws \App\Exception\ApiException
     */
    function apiValidate(
        array $data,
        string $validatorName,
        array $fields = [],
        array $userValidators = [],
        array $unFields = []
    ): array
    {
        /* @var \Swoft\Validator\Validator $validator */
        $validator = \Swoft\Bean\BeanFactory::getBean('validator');
        try {
            return array_values($validator->validate($data, $validatorName, $fields, $userValidators, $unFields));
        }catch (\Throwable $throwable){
            throw new \App\Exception\ApiException($throwable->getMessage());
        }
    }
}
