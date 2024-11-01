<?php

namespace SFAL\Repositories\AccountsRepository;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Repository\SfalBaseRepository;

class SfalAccountsRepository extends SfalBaseRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->prefix . 'sfal_accounts';
    }

    protected $primaryKey = 'id';

    public function getAllAccounts(array $columns = [])
    {
        return $this->all($columns);
    }

    public function getAccountByID(int $ID, array $columns = [])
    {
        return $this->find($ID, $columns);
    }

    public function addAccount(array $data, array $format)
    {
        return $this->store($data, $format);
    }

    public function updateAccount(int $ID, array $data, array $format = [])
    {
        return $this->update($ID, $data, $format);
    }

    public function replaceAccount(array $data, array $format = [])
    {
        return $this->replace($data, $format);
    }

    public function deleteAccount(int $ID)
    {
        return $this->delete($ID);
    }

    public function existAccount(int $ID)
    {
        return $this->findVar($this->prepare("SELECT `{$this->primaryKey}` FROM {$this->table} WHERE `{$this->primaryKey}`=%d", [ $ID ]));
    }
}
