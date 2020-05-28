<?php
/*
 * @framework: Bycod
 * @package: View
 * @version: 0.1
 * @description: This is simple and light RBAC layer
 * @authors: ing. Antonio Membrides Espinosa
 * @made: 15/06/2012
 * @update: 15/06/2012
 * @license: GPL v3
 * @require: PHP >= 5.2.*, porter, role, user, officer
 */
    class Rbac{
        public function onConfig($assist){
            $assist->cfg['bycod']['router']['lib'][] = $assist->route("rbac")."/lib/";
            $assist->cfg['bycod']['engine']['links']['onAccess'][] = "porter";
        }
    }