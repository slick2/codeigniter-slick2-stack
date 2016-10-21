<?php
/*
  DROP TABLE IF EXISTS `categories`;
  CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) unsigned NOT NULL,
  `cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;
 * 
 */

class Migration_Install_cart extends CI_Migration {

	public function up()
	{
		/** start categories * */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '3',
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'description' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE
			),
			'createdon' => array(
				'type' => 'DATETIME'
			),
			'updatedon' => array(
				'type' => 'DATETIME'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('categories');
		/** end categories * */
		/** start products * */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'constraint' => '11'
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'price' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			),
			'description' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'quantity' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => TRUE
			),
			'status' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'null' => TRUE
			),
			'createdon' => array(
				'type' => 'DATETIME'
			),
			'updatedon' => array(
				'type' => 'TIMESTAMP'
			)
		));

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('products');
		/** end products * */
		/** start product images * */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
			),
			'product_id' => array(
				'type' => 'INT',
				'constraint' => '11'
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'featured_image' => array(
				'type' => 'TINYINT',
				'constraint' => '1'
			),
			'createdon' => array(
				'type' => 'DATETIME'
			),
			'updatedon' => array(
				'type' => 'TIMESTAMP'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('product_images');
		/** end product images **/
			  
	}

	public function down(){
		$this->dbforge->drop_table('categories');
		$this->dbforge->drop_table('products');
		$this->dbforge->drop_table('product_images');
	}
}
