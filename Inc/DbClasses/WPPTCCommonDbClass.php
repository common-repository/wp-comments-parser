<?php

namespace WPPTC\Inc\DbClasses;
/**
 * Class WPPTCCommonDbClass
 * @package WPPTC\Inc\DbClasses
 *Work with database
 */
class WPPTCCommonDbClass
{
    protected $parserWpdb;
    protected $table = WPPTC_DB_COMMENTS;
    protected $fields;
    protected $idName = 'id';
    
    public function __construct()
    {
        global $wpdb;
        $this->parserWpdb = $wpdb;

        $this->checkProperty();
        $this->setTable();

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $this->table = $this->parserWpdb->get_blog_prefix() . WPPTC_DB_COMMENTS;
        
    }
    
    protected function setTable()
    {
        $this->table = $this->parserWpdb->get_blog_prefix() . $this->table;
    }

    public function checkProperty()
    {
        if (is_array($this->fields)
            || count($this->fields)
            || is_string($this->table)
        ) {
            return true;
        }
        die('pleasure init class property');
    }

    public function create(array $data)
    {
        $this->parserWpdb->insert($this->table, $data, array('%s','%s','%d'));
        return $this->parserWpdb->insert_id;
    }

    public function drop()
    {
        $this->parserWpdb->query("DELETE FROM $this->table");
    }
    
    public function createTables()
    {
        $db_comments = $this->parserWpdb->get_blog_prefix() . WPPTC_DB_COMMENTS;

        $charset_collate = "DEFAULT CHARACTER SET {$this->parserWpdb->charset} COLLATE {$this->parserWpdb->collate}";

        $sql = "CREATE TABLE {$db_comments}(
                    id  INT AUTO_INCREMENT PRIMARY KEY,
                    title varchar(250) NOT NULL,
                    description varchar(2500) NOT NULL,
                    raiting int default NULL
                ){$charset_collate};";

        dbDelta($sql);
    }

    public function dropTables()
    {
        $db_comments = $this->parserWpdb->get_blog_prefix() . WPPTC_DB_COMMENTS;

        $sql = "DROP TABLE IF EXISTS $db_comments";
        $this->parserWpdb->query($sql);
    }

    public function getComments()
    {
        $query = sprintf("SELECT * FROM $this->table");
        $results = $this->parserWpdb->get_results($query, ARRAY_A);

        return $results;
    }
    
}