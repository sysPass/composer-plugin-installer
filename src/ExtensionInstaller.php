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

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class ExtensionInstaller
 *
 * @package SP\Composer
 */
final class ExtensionInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $prefix = substr($package->getPrettyName(), 0, 15);

        if ('syspass/plugin-' !== $prefix) {
            throw new \InvalidArgumentException(
                'Unable to install plugin, sysPass plugins '
                . 'should always start their package name with '
                . '"syspass/plugin-"'
            );
        }

        $extra = $package->getExtra();

        if (isset($extra['type'])) {
            $name = substr($package->getPrettyName(), 15);

            switch ($extra['type']) {
                case 'web':
                    return 'app/modules/web/' . $name;
                case 'api':
                    return 'app/modules/api/' . $name;
            }
        }

        throw new \InvalidArgumentException('Unable to guess the plugin type');
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'syspass-plugin' === $packageType;
    }
}