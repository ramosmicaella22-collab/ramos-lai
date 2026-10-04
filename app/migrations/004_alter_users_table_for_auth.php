<?php

class Alter_users_table_for_auth {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
    }

    private function has_column($column)
    {
        $stmt = $this->_lava->db->raw(
            "SELECT COUNT(*) FROM information_schema.COLUMNS
             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'users' AND COLUMN_NAME = ?",
            [$column]
        );
        return (int) $stmt->fetchColumn() > 0;
    }

    public function up()
    {
        // Old rows (from earlier lab) have no password, so allow NULL
        if (!$this->has_column('password')) {
            $this->_lava->db->raw("ALTER TABLE `users` ADD COLUMN `password` VARCHAR(255) NULL AFTER `username`");
        }
        if (!$this->has_column('role')) {
            $this->_lava->db->raw("ALTER TABLE `users` ADD COLUMN `role` ENUM('admin','moderator','user') NOT NULL DEFAULT 'user'");
        }
        if (!$this->has_column('is_active')) {
            $this->_lava->db->raw("ALTER TABLE `users` ADD COLUMN `is_active` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1");
        }
        if (!$this->has_column('created_at')) {
            $this->_lava->db->raw("ALTER TABLE `users` ADD COLUMN `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
        }
        if (!$this->has_column('updated_at')) {
            $this->_lava->db->raw("ALTER TABLE `users` ADD COLUMN `updated_at` DATETIME NULL DEFAULT NULL");
        }

        // API registration doesn't send these, so give them defaults
        $this->_lava->db->raw("ALTER TABLE `users` MODIFY `firstname` VARCHAR(100) NOT NULL DEFAULT ''");
        $this->_lava->db->raw("ALTER TABLE `users` MODIFY `lastname` VARCHAR(100) NOT NULL DEFAULT ''");
    }

    public function down()
    {
        foreach (['updated_at', 'created_at', 'is_active', 'role', 'password'] as $column) {
            if ($this->has_column($column)) {
                $this->_lava->db->raw("ALTER TABLE `users` DROP COLUMN `{$column}`");
            }
        }
    }
}