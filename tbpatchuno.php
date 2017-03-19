<?php
/**
 * Copyright (C) Mijn Presta - All Rights Reserved
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 *
 * @author    Michael Dekker <prestashopaddons@mijnpresta.nl>
 * @copyright 2015-2017 Mijn Presta
 * @license   proprietary
 * Intellectual Property of Mijn Presta
 */

if (!defined('_TB_VERSION_')) {
    return;
}

/**
 * Class TbPatchUno
 */
class TbPatchUno extends Module
{
    public $filesToPatch = [
        'classes/controller/AdminController.php'      => '1260a8d06a58820352076771e18f2e03',
        'controllers/admin/AdminThemesController.php' => '2d5d9f4acb373f8f4c95b585eecf4e54',
    ];

    /**
     * TbPatchUno constructor.
     */
    public function __construct()
    {
        $this->name = 'tbpatchuno';
        $this->tab = 'administration';
        $this->version = '1.0.1';
        $this->author = 'thirty bees';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('thirty bees patch - uno');
        $this->description = $this->l('thirty bees security/emergency patch - uno');
    }

    /**
     * Install this module
     *
     * @return bool Whether install was successful
     */
    public function install()
    {
        if (version_compare(_TB_VERSION_, '1.0.0', '=')) {
            return parent::install();
        }

        $this->context->controller->errors[] = $this->l('thirty bees patch uno is for version 1.0.0 only');

        return false;
    }

    /**
     * Load the configuration form
     *
     * @return string HTML
     *
     * @since 1.0.0
     */
    public function getContent()
    {
        if (Tools::isSubmit('patchFiles')) {
            $this->patchFiles();
        }

        $this->context->smarty->assign([
            'patchStatuses' => $this->checkPatches(),
            'notPossible' => $this->checkPermissions(),
            'everythingPatched' => $this->checkPatches(true),
            'postUrl' => $this->context->link->getAdminLink('AdminModules', true).'&'.http_build_query(array(
                'configure' => $this->name,
                'tab_module' => $this->tab,
                'module_name' => $this->name,
            )),
        ]);

        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }

    /**
     * Check if files have been patched
     *
     * @param bool $checkEveryting Check if everything is patched
     *
     * @return array|bool
     * @since 1.0.0
     */
    public function checkPatches($checkEveryting = false)
    {
        $patches = [];

        foreach ($this->filesToPatch as $file => $md5sum) {
            $patched = md5_file(_PS_ROOT_DIR_.'/'.$file) === $md5sum;
            if (!$patched && $checkEveryting) {
                return false;
            }

            $patches[$file] = $patched;
        }

        if ($checkEveryting) {
            return true;
        }

        return $patches;
    }

    /**
     * Check file permissions
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function checkPermissions()
    {
        foreach ($this->filesToPatch as $file) {
            if (!is_writable($file)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Patch the files
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function patchFiles()
    {
        foreach (array_keys($this->filesToPatch) as $file) {
            if (!@copy(__DIR__.'/files/'.$file, _PS_ROOT_DIR_.'/'.$file)) {
                return false;
            }
        }

        return true;
    }
}
