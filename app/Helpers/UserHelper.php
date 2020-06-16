<?php

namespace App\Helpers;

// REGISTER ON config/app.php

class UserHelper {

    public static function get_avatar($avatar) {
        if(is_null($avatar)) return '/uploads/images/default.png';
        return '/uploads/users/photo/' . $avatar;
    }


    // GET SEX
    public static function getSex( $sex_int ) {
        if ( $sex_int == 1 ) {
            return 'Мужской';
        } else if ( $sex_int == 2 ) {
            return 'Женский';
        }
        return 'Ошибка! Пол не определен!';
    }


    // GET ONLINE ON SEX
    public static function getOnlineTime( $gender_int, $time ) {
        if ( $gender_int == 1 ) {
            return 'заходил ' . $time;
        } elseif ( $gender_int == 2 ) {
            return 'заходила ' . $time;
        }
        return $time;
    }
}