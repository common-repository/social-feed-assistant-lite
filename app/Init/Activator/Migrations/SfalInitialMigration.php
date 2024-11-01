<?php

namespace SFAL\Init\Activator\Migrations;

use SFAL\Core\Foundation\Contracts\Database\SfalMigrationsInterface;

class SfalInitialMigration implements SfalMigrationsInterface
{
    private static $tableMigrators = [
        'createAccountTable',
        'createFeedsTable',
        'createFeedContentsTable',
        'createStreamsTable',
        'createStreamSourcesTable',
        'createStreamFiltersTable',
        'createPostsTable',
        'createCommentsTable',
    ];
    private static $tableReferences = [
        'addFeedsForeignKey',
        'addFeedContentsForeignKey',
        'addPostsForeignKey',
        'addCommentsForeignKey',
        'addStreamSourcesForeignKey',
        'addStreamFiltersForeignKey',
    ];
    private static $connection;
    private static $prefix;
    private static $charsetCollate;
    private static $sqls = [];
    public static function execute($connection)
    {
        self::$connection = $connection;
        self::$prefix = $connection->prefix;
        self::$charsetCollate = $connection->get_charset_collate();
        foreach (self::$tableMigrators as $migrator) {
            self::$sqls[] = self::{$migrator}();
        }
        dbDelta(self::$sqls);
        foreach (self::$tableReferences as $method) {
            self::{$method}();
        }
        update_option('sfal_db_initialized', true);
    }

    private static function createAccountTable()
    {
        $tableName = self::$prefix . 'sfal_accounts';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            social_type varchar(100) NOT NULL,
            title varchar(255) NOT NULL,
            options text NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY social_type (social_type)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createFeedsTable()
    {
        $tableName = self::$prefix . 'sfal_feeds';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            account_id int(11) unsigned,
            social_type varchar(100) NOT NULL,
            type varchar(100) NOT NULL,
            frequency_update int(11) NOT NULL,
            excludes TEXT,
            includes TEXT,
            last_cache int(11) NOT NULL,
            cache_error TEXT,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY account_id (account_id)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createFeedContentsTable()
    {
        $tableName = self::$prefix . 'sfal_feed_contents';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            feed_id int(100) unsigned NOT NULL,
            content varchar(100) NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY feed_id (feed_id)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createStreamsTable()
    {
        $tableName = self::$prefix . 'sfal_streams';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            options text NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createStreamSourcesTable()
    {
        $tableName = self::$prefix . 'sfal_stream_sources';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            stream_id int(11) unsigned NOT NULL,
            feed_id int(11) unsigned NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY stream_id (stream_id),
            KEY feed_id (feed_id)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createStreamFiltersTable()
    {
        $tableName = self::$prefix . 'sfal_stream_filters';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            stream_id int(11) unsigned NOT NULL,
            feed_id int(11) unsigned NOT NULL,
            feed_content int(11) unsigned NOT NULL,
            title varchar(255) NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY stream_id (stream_id),
            KEY feed_id (feed_id),
            KEY feed_content (feed_content)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createPostsTable()
    {
        $tableName = self::$prefix . 'sfal_posts';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            feed_id int(11) unsigned NOT NULL,
            feed_content int(11) unsigned NOT NULL,
            post_id varchar(100) NOT NULL,
            type varchar(50) NOT NULL,
            media_type varchar(100) NOT NULL,
            user text NOT NULL,
            text text NOT NULL,
            permalink varchar(255) NOT NULL,
            rand_order float(11) NOT NULL,
            timestamp int(11) NOT NULL,
            carousel text NOT NULL,
            media text NOT NULL,
            images text NOT NULL,
            videos text NOT NULL,
            location text NOT NULL,
            additional text NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY feed_id (feed_id),
            KEY feed_content (feed_content),
            KEY post_id (post_id),
            KEY type (type)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function createCommentsTable()
    {
        $tableName = self::$prefix . 'sfal_comments';
        $charsetCollate = self::$charsetCollate;
        return "CREATE TABLE $tableName (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            feed_id int(11) unsigned NOT NULL,
            feed_content int(11) unsigned NOT NULL,
            -- post_id int(11) unsigned NOT NULL,
            post_id varchar(100) NOT NULL,
            `from` TEXT NOT NULL,
            text text NOT NULL,
            timestamp int(11) NOT NULL,
            created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY id (id),
            KEY feed_id (feed_id),
            KEY feed_content (feed_content),
            KEY post_id (post_id)
        ) ENGINE = INNODB $charsetCollate;";
    }
    private static function addFeedsForeignKey()
    {
        $childTable = self::$prefix . 'sfal_feeds';
        $parentTable = self::$prefix . 'sfal_accounts';
        $constraintSchema = self::$connection->dbname;
        $constraint =  self::$prefix . 'sfal_fk_account_id';
        $fkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$constraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );

        (0 === (int) $fkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$constraint}` FOREIGN KEY (`account_id`) REFERENCES `{$parentTable}`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;");
    }
    private static function addFeedContentsForeignKey()
    {
        $childTable = self::$prefix . 'sfal_feed_contents';
        $parentTable = self::$prefix . 'sfal_feeds';
        $constraintSchema = self::$connection->dbname;
        $constraint =  self::$prefix . 'sfal_fk_feed_id';
        $fkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$constraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );

        (0 === (int) $fkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$constraint}` FOREIGN KEY (`feed_id`) REFERENCES `{$parentTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
    private static function addPostsForeignKey()
    {
        $childTable = self::$prefix . 'sfal_posts';
        $feedsTable = self::$prefix . 'sfal_feeds';
        $feedContentsTable = self::$prefix . 'sfal_feed_contents';
        $constraintSchema = self::$connection->dbname;
        $feedsTableConstraint =  self::$prefix . 'sfal_fk_posts_feed_id';
        $feedContentsTableConstraint =  self::$prefix . 'sfal_fk_posts_feed_content_id';
        $feedsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        $feedContentsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedContentsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );

        (0 === (int) $feedsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedsTableConstraint}` FOREIGN KEY (`feed_id`) REFERENCES `{$feedsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        (0 === (int) $feedContentsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedContentsTableConstraint}` FOREIGN KEY (`feed_content`) REFERENCES `{$feedContentsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
    private static function addCommentsForeignKey()
    {
        $childTable = self::$prefix . 'sfal_comments';
        $feedsTable = self::$prefix . 'sfal_feeds';
        $feedContentsTable = self::$prefix . 'sfal_feed_contents';
        $postsTable = self::$prefix . 'sfal_posts';
        $constraintSchema = self::$connection->dbname;
        $feedsTableConstraint =  self::$prefix . 'sfal_fk_comments_feed_id';
        $feedContentsTableConstraint =  self::$prefix . 'sfal_fk_comments_feed_content_id';
        // $postsTableConstraint = self::$prefix . 'sfal_fk_posts_post_id';
        $feedsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        $feedContentsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedContentsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        // $postsFkResult = self::$connection->get_row(
        //     "SELECT COUNT(*) AS fk_count
        //     FROM information_schema.TABLE_CONSTRAINTS
        //     WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
        //     AND CONSTRAINT_NAME = '{$postsTableConstraint}'
        //     AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        //     AND TABLE_NAME = '{$childTable}'"
        // );

        (0 === (int) $feedsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedsTableConstraint}` FOREIGN KEY (`feed_id`) REFERENCES `{$feedsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        (0 === (int) $feedContentsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedContentsTableConstraint}` FOREIGN KEY (`feed_content`) REFERENCES `{$feedContentsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        // (0 === (int) $postsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$postsTableConstraint}` FOREIGN KEY (`post_id`) REFERENCES `{$postsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
    private static function addStreamSourcesForeignKey()
    {
        $childTable = self::$prefix . 'sfal_stream_sources';
        $streamsTable = self::$prefix . 'sfal_streams';
        $feedsTable = self::$prefix . 'sfal_feeds';
        $constraintSchema = self::$connection->dbname;
        $streamsTableConstraint =  self::$prefix . 'sfal_fk_stream_sources_stream_id';
        $feedsTableConstraint =  self::$prefix . 'sfal_fk_stream_sources_feed_id';
        $streamsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$streamsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        $feedsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );

        (0 === (int) $streamsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$streamsTableConstraint}` FOREIGN KEY (`stream_id`) REFERENCES `{$streamsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        (0 === (int) $feedsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedsTableConstraint}` FOREIGN KEY (`feed_id`) REFERENCES `{$feedsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
    private static function addStreamFiltersForeignKey()
    {
        $childTable = self::$prefix . 'sfal_stream_filters';
        $streamsTable = self::$prefix . 'sfal_streams';
        $feedsTable = self::$prefix . 'sfal_feeds';
        $feedContentsTable = self::$prefix . 'sfal_feed_contents';
        $constraintSchema = self::$connection->dbname;
        $streamsTableConstraint =  self::$prefix . 'sfal_fk_stream_filters_stream_id';
        $feedsTableConstraint =  self::$prefix . 'sfal_fk_stream_filters_feed_id';
        $feedContentsTableConstraint =  self::$prefix . 'sfal_fk_stream_filters_feed_content';
        $streamsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$streamsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        $feedsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );
        $feedContentsFkResult = self::$connection->get_row(
            "SELECT COUNT(*) AS fk_count
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = '{$constraintSchema}'
            AND CONSTRAINT_NAME = '{$feedContentsTableConstraint}'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_NAME = '{$childTable}'"
        );

        (0 === (int) $streamsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$streamsTableConstraint}` FOREIGN KEY (`stream_id`) REFERENCES `{$streamsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        (0 === (int) $feedsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedsTableConstraint}` FOREIGN KEY (`feed_id`) REFERENCES `{$feedsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
        (0 === (int) $feedContentsFkResult->fk_count) && self::$connection->query("ALTER TABLE `{$childTable}` ADD CONSTRAINT `{$feedContentsTableConstraint}` FOREIGN KEY (`feed_content`) REFERENCES `{$feedContentsTable}`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
}
