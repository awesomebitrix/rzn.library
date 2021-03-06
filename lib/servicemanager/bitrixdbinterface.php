<?php
/**
 * ----------------------------------------------------
 * | Автор: Андрей Рыжов (Dune) <info@rznw.ru>         |
 * | Сайт: www.rznw.ru                                 |
 * | Телефон: +7 (4912) 51-10-23                       |
 * ----------------------------------------------------
 */

namespace Rzn\Library\ServiceManager;


interface BitrixDbInterface {

    /**
     * @param \CDatabase $db
     * @return mixed
     */
    public function setDb($db);


    /**
     * \CDatabase
     * @return mixed
     */
    public function getDb();
} 