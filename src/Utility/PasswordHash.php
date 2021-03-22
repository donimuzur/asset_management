<?php
namespace App\Utility;

/**
 *@author Muhammad Zulfi Rusdani donimuzur@gmail.com
 */
class PasswordHash {

    const ALGORITHM = PASSWORD_BCRYPT;

    // 2^12 iterations
    const COST = 12;
    const salt = "p0L0w1J0g0S4rI1Nd035Ia";

    /**
     * Create password hash
     *
     * @param string $password Password
     * @return string
     */
    public function hash($password) {
        $options = [
            'cost' => self::COST,
            'salt'=> self::salt
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * Verify password
     *
     * @param string $password Password
     * @param string $hash Hash
     * @return boolean
     */
    public function verify($password, $hash) {
        return password_verify($password, $hash);
    }

}