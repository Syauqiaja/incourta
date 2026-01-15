<?php

namespace App\Utils;

class PermissionDictionary
{
    /**
     * KETERANGAN
     *
     * name => untuk nama permission yang akan di gunakan di sistem untuk pengecekkan
     * menu => untuk nama menu. ditandai dengan hanya memuat satu nama permission. seperti Customer Database dan Marketing Activity
     * group => untuk menandai jenis permission masuk ke group akses apa [api, web, admin]
     * type => untuk menandai jenis permission masuk type permission apa menggunakan format integer [1:read, 2:create, 3:edit, 4:delete, 5:approve/publish/action]
     */
    const PERMISSION = [
        ['name' => 'admin>home>read', 'menu' => 'Dashboard Admin', 'group' => 'admin', 'type' => 1],
        ['name' => 'admin>user>read', 'menu' => 'User', 'group' => 'admin', 'type' => 1],
        ['name' => 'admin>user>create', 'menu' => 'User', 'group' => 'admin', 'type' => 2],
        ['name' => 'admin>user>edit', 'menu' => 'User', 'group' => 'admin', 'type' => 3],
        ['name' => 'admin>user>delete', 'menu' => 'User', 'group' => 'admin', 'type' => 4],
        ['name' => 'admin>event>read', 'menu' => 'Event Tournament', 'group' => 'admin', 'type' => 1],
        ['name' => 'admin>event>create', 'menu' => 'Event Tournament', 'group' => 'admin', 'type' => 2],
        ['name' => 'admin>event>edit', 'menu' => 'Event Tournament', 'group' => 'admin', 'type' => 3],
        ['name' => 'admin>event>delete', 'menu' => 'Event Tournament', 'group' => 'admin', 'type' => 4],
        ['name' => 'admin>fixture>read', 'menu' => 'Matchmaking Tournament', 'group' => 'admin', 'type' => 1],
        ['name' => 'admin>fixture>create', 'menu' => 'Matchmaking Tournament', 'group' => 'admin', 'type' => 2],
        ['name' => 'admin>fixture>edit', 'menu' => 'Matchmaking Tournament', 'group' => 'admin', 'type' => 3],
        ['name' => 'admin>fixture>delete', 'menu' => 'Matchmaking Tournament', 'group' => 'admin', 'type' => 4],
    ];
    public static function allPermissions()
    {
        return self::PERMISSION;
    }
}
