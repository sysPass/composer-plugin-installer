<?php
/**
 * syspass-composer-plugin-installer
 *
 * @author    nuxsmin
 * @link      http://syspass.org
 * @copyright 2012-2018 Rubén Domínguez nuxsmin@$syspass.org
 *
 * This file is part of syspass-composer-plugin-installer.
 *
 * sysPass is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * syspass-composer-plugin-installer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with sysPass.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace SP\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class ExtensionInstallerPlugin
 *
 * @package SP\Composer
 */
final class ExtensionInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new ExtensionInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}