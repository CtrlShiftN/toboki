<?php

namespace common\components\importsample;


use common\models\User;
use yii\base\Exception;

class SampleData
{
    /**
     * user data
     * @var array[]
     */
    protected static $userInfoArr = [
        [
            'email' => 'admin@gmail.com',
            'password_hash' => 'Iamadmin@1234',
            'name' => "Admin",
            'tel' => '0364752421',
            'username' => 'admin',
            'role' => User::ROLE_ADMIN,
        ],
        [
            'email' => 'editor@gmail.com',
            'password_hash' => 'Iameditor@1234',
            'name' => "Writer God",
            'tel' => '0334517566',
            'username' => 'editor',
            'role' => User::ROLE_MOD,
        ],
        [
            'email' => 'sale@gmail.com',
            'password_hash' => 'Iamsale@1234',
            'name' => "Sale",
            'tel' => '0345678910',
            'username' => 'sale',
            'role' => User::ROLE_MOD,
        ],
        [
            'email' => 'customer@gmail.com',
            'password_hash' => 'Iamcustomer@1234',
            'name' => "Customer",
            'tel' => '0333333333',
            'username' => 'customer',
            'role' => User::ROLE_MOD,
        ],
        [
            'email' => 'customer2@gmail.com',
            'password_hash' => 'Iamcustomer2@1234',
            'name' => "Customer2",
            'tel' => '0339583763',
            'username' => 'customer2',
            'role' => User::ROLE_MOD,
        ]
    ];

    /**
     *
     * @throws Exception
     */
    public static function insertSampleUser()
    {
        $countUsers = 0;
        foreach (self::$userInfoArr as $values) {
            $user = new User();
            $user->email = $values['email'];
            $user->setPassword($values['password_hash']);
            $user->name = $values['name'];
            $user->tel = $values['tel'];
            $user->generateAuthKey();
            $user->generatePasswordResetToken();
            $user->username = $values['username'];
            $user->referral_code = strstr($values['email'], '@', true);
            $user->role = $values['role'];
			$user->status = User::STATUS_ACTIVE;
            $user->created_at = date('Y-m-d H:m:s');
            $user->updated_at = date('Y-m-d H:m:s');
            if ($user->save()) {
                $countUsers++;
            }
        }
        echo "Inserted " . $countUsers . '/' . count(self::$userInfoArr) . ' users.' . PHP_EOL;
    }


    /**
     * @throws Exception
     */
    public static function importAllSampleData()
    {
        self::insertSampleUser();
    }
}