<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class maginonsmartplug extends eqLogic {
    /*     * *************************Attributs****************************** */



    /*     * ***********************Methode static*************************** */

    /*
     * Fonction exécutée automatiquement toutes les minutes par Jeedom
      public static function cron() {

      }
     */


    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {

      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {

      }
     */



    /*     * *********************Méthodes d'instance************************* */

    public function preInsert() {
        
    }

    public function postInsert() {
        
    }

    public function preSave() {
        
    }

    public function postSave() {
        $tension = $this->getCmd(null, 'tension');
        if (!is_object($tension)) {
            $tension = new maginonsmartplugCmd();
            $tension->setName(__('Tension', __FILE__));
        }
        $tension->setLogicalId('tension');
        $tension->setEqLogic_id($this->getId());
        $puissance->setUnite('V');
        $tension->setType('info');
        $tension->setSubType('numeric');
        $tension->save();

       /* $puissance = $this->getCmd(null, 'puissance');
        if (!is_object($puissance)) {
            $puissance = new maginonsmartplugCmd();
            $puissance->setName(__('Puissance', __FILE__));
        }
        $puissance->setLogicalId('puissance');
        $puissance->setEqLogic_id($this->getId());
        $puissance->setUnite('W');
        $puissance->setType('info');
        $puissance->setSubType('numeric');
        $puissance->save();	
        
        $on = $this->getCmd(null, 'on');
        if (!is_object($on)) {
            $on = new maginonsmartplugCmd();
            $on->setName(__('Allumer', __FILE__));
        }
        $on->setEqLogic_id($this->getId());
        $on->setLogicalId('on');
        $on->setType('action');
        $on->setSubType('other');
        $on->save();

        $off = $this->getCmd(null, 'off');
        if (!is_object($off)) {
            $off = new maginonsmartplugCmd();
            $off->setName(__('Eteindre', __FILE__));
        }
        $off->setEqLogic_id($this->getId());
        $off->setLogicalId('off');
        $off->setType('action');
        $off->setSubType('other');
        $off->save();*/

        $refresh = $this->getCmd(null, 'refresh');
        if (!is_object($refresh)) {
            $refresh = new maginonsmartplugCmd();
            $refresh->setName(__('Rafraichir', __FILE__));
        }
        $refresh->setEqLogic_id($this->getId());
        $refresh->setLogicalId('refresh');
        $refresh->setType('action');
        $refresh->setSubType('other');
        $refresh->save();
    }

    public function preUpdate() {
        
    }

    public function postUpdate() {
        
    }

    public function preRemove() {
        
    }

    public function postRemove() {
        
    }

    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class maginonsmartplugCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

    public function execute($_options = array()) {
        
    }

    /*     * **********************Getteur Setteur*************************** */
}


