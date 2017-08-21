<?php

namespace app\core\config;

use app\core\config\StorageInterface;
use Doctrine\ORM\EntityManager;

/**
 * Description of DatabaseStorage
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class DatabaseStorage implements StorageInterface {

  /**
   * @var UserAccount
   */
  private $user;

  /**
   * @var CacheManager
   */
  private $cache;

  /**
   * @var EntityManager
   */
  private $em;

  public function __construct(EntityManager $em, UserAccount $user, CacheManager $cache) {
    $this->em = $em;
    $this->cache = $cache;
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public function exists($name) {
    try {
      return (bool) $this->connection->queryRange('SELECT 1 FROM {' . $this->connection->escapeTable($this->table) . '} WHERE collection = :collection AND name = :name', 0, 1, array(
                  ':collection' => $this->collection,
                  ':name' => $name,
                      ), $this->options)->fetchField();
    } catch (\Exception $e) {
      // If we attempt a read without actually having the database or the table
      // available, just return FALSE so the caller can handle it.
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function read($name) {
    $data = FALSE;
    try {
      $raw = $this->em->getRepository('model\User')->findBy(['id_user' => $this->user->id])->getConfig()->getData();
      if ($raw !== FALSE) {
        $data = $this->decode($raw);
      }
    } catch (\Exception $e) {
      // If we attempt a read without actually having the database or the table
      // available, just return FALSE so the caller can handle it.
    }
    return $data[$name];
  }

  /**
   * {@inheritdoc}
   */
  public function readMultiple(array $names) {
    $list = array();
    foreach ($names as $key => $value) {
      $list[$key] = $this->read($key);
    }
    return $list;
  }

  /**
   * {@inheritdoc}
   */
  public function write($name, array $data) {
    $data = $this->encode($data);
    try {
      return $this->doWrite($name, $data);
    } catch (\Exception $e) {
      // If there was an exception, try to create the table.
      if ($this->ensureTableExists()) {
        return $this->doWrite($name, $data);
      }
      // Some other failure that we can not recover from.
      throw $e;
    }
  }

  /**
   * Helper method so we can re-try a write.
   *
   * @param string $name
   *   The config name.
   * @param string $data
   *   The config data, already dumped to a string.
   *
   * @return bool
   */
  protected function doWrite($name, $data) {
    $options = array('return' => Database::RETURN_AFFECTED) + $this->options;
    return (bool) $this->connection->merge($this->table, $options)
                    ->keys(array('collection', 'name'), array($this->collection, $name))
                    ->fields(array('data' => $data))
                    ->execute();
    $user = new model\User();
    $user->setConfig();
    $this->em->find('model\User', 1);
  }

  /**
   * Check if the config table exists and create it if not.
   *
   * @return bool
   *   TRUE if the table was created, FALSE otherwise.
   *
   * @throws \app\core\config\StorageException
   *   If a database error occurs.
   */
  protected function ensureTableExists() {
    try {
      if (!$this->connection->schema()->tableExists($this->table)) {
        $this->connection->schema()->createTable($this->table, static::schemaDefinition());
        return TRUE;
      }
    }
    // If another process has already created the config table, attempting to
    // recreate it will throw an exception. In this case just catch the
    // exception and do nothing.
    catch (SchemaObjectExistsException $e) {
      return TRUE;
    } catch (\Exception $e) {
      throw new StorageException($e->getMessage(), NULL, $e);
    }
    return FALSE;
  }

  /**
   * Defines the schema for the configuration table.
   */
  protected static function schemaDefinition() {
    $schema = array(
        'description' => 'The base table for configuration data.',
        'fields' => array(
            'collection' => array(
                'description' => 'Primary Key: Config object collection.',
                'type' => 'varchar_ascii',
                'length' => 255,
                'not null' => TRUE,
                'default' => '',
            ),
            'name' => array(
                'description' => 'Primary Key: Config object name.',
                'type' => 'varchar_ascii',
                'length' => 255,
                'not null' => TRUE,
                'default' => '',
            ),
            'data' => array(
                'description' => 'A serialized configuration object data.',
                'type' => 'blob',
                'not null' => FALSE,
                'size' => 'big',
            ),
        ),
        'primary key' => array('collection', 'name'),
    );
    return $schema;
  }

  /**
   * Implements app\core\config\StorageInterface::delete().
   *
   * @throws PDOException
   *
   * @todo Ignore replica targets for data manipulation operations.
   */
  public function delete($name) {
    $options = array('return' => Database::RETURN_AFFECTED) + $this->options;
    return (bool) $this->connection->delete($this->table, $options)
                    ->condition('collection', $this->collection)
                    ->condition('name', $name)
                    ->execute();
  }

  /**
   * Implements app\core\config\StorageInterface::rename().
   *
   * @throws PDOException
   */
  public function rename($name, $new_name) {
    $options = array('return' => Database::RETURN_AFFECTED) + $this->options;
    return (bool) $this->connection->update($this->table, $options)
                    ->fields(array('name' => $new_name))
                    ->condition('name', $name)
                    ->condition('collection', $this->collection)
                    ->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function encode($data) {
    return serialize($data);
  }

  /**
   * Implements app\core\config\StorageInterface::decode().
   *
   * @throws ErrorException
   *   unserialize() triggers E_NOTICE if the string cannot be unserialized.
   */
  public function decode($raw) {
    $data = @unserialize($raw);
    return is_array($data) ? $data : FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function listAll($prefix = '') {
    try {
      $query = $this->connection->select($this->table);
      $query->fields($this->table, array('name'));
      $query->condition('collection', $this->collection, '=');
      $query->condition('name', $prefix . '%', 'LIKE');
      $query->orderBy('collection')->orderBy('name');
      return $query->execute()->fetchCol();
    } catch (\Exception $e) {
      return array();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function deleteAll($prefix = '') {
    try {
      $options = array('return' => Database::RETURN_AFFECTED) + $this->options;
      return (bool) $this->connection->delete($this->table, $options)
                      ->condition('name', $prefix . '%', 'LIKE')
                      ->condition('collection', $this->collection)
                      ->execute();
    } catch (\Exception $e) {
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function createCollection($collection) {
    return new static(
            $this->connection, $this->table, $this->options, $collection
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCollectionName() {
    return $this->collection;
  }

  /**
   * {@inheritdoc}
   */
  public function getAllCollectionNames() {
    try {
      return $this->connection->query('SELECT DISTINCT collection FROM {' . $this->connection->escapeTable($this->table) . '} WHERE collection <> :collection ORDER by collection', array(
                  ':collection' => StorageInterface::DEFAULT_COLLECTION)
              )->fetchCol();
    } catch (\Exception $e) {
      return array();
    }
  }

}
