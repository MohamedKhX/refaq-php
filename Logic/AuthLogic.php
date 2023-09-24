<?php

namespace Logic;

use entities\UserEntity;

class AuthLogic
{
    public static function login(string $name): void
    {
        $user = UserEntity::findByKey('name', $name);

        if(is_null($user)) {
            static::createUser($name);
        }

        $_SESSION['user'] = $name;

        \App::redirectTo('subjects');
    }

    public static function createUser(string $name): ?UserEntity
    {
        return UserEntity::create([
            'id' => UserEntity::getLastId() + 1,
            'name' => $name
        ]);
    }
}