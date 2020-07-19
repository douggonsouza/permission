<?php

namespace root\home\models;

use data\model\model;

class users extends model
{
    public $table = 'users';
    public $key   = 'user_id';
    public $dicionary = "SELECT user_id as value, CONCAT(first_name,' ',last_name) as label FROM users;";

    /**
     * Evento construtor da classe
     */
    public function __construct()
    {
        parent::__construct($this->table, $this->key);
    }

    /**
     * Informações das colunas visíveis
     *
     * @return void
     */
    public function visibleColumns()
    {
        return array(
            'table'   => 'users',
            'key'     => 'user_id',
            'columns' => array(
                'user_id' => array(
                    'label' => 'Id',
                    'pk'    => true,
                    'type'  => 'integer',
                ),
                'checkpoint_identifier' => array(
                    'label' => 'Identificador',
                    'pk'    => false,
                    'type'  => 'integer',
                ),
                'first_name' => array(
                    'label' => 'Primeiro nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'last_name' => array(
                    'label' => 'Último nome',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'email' => array(
                    'label' => 'E-mail',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'permission_roles_list' => array(
                    'label' => 'Lista de regras',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
                'data_profiles_list' => array(
                    'label' => 'Lista do perfil',
                    'pk'    => false,
                    'type'  => 'varchar',
                ),
            ),
        );
    } 

    /**
     * Cardinalidade com a tabela api_tokens
     *
     * @return object
     */
    public function apiTokens()
    {
        return $this->oneForMany(new apiTokens(), 'user_id');
    }
}