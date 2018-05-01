<?php
use Composer\Script\Event;
class ComposerHelper
{
  public static function checkAssetInstaller(Event $event)
  {
    // Check if fxp/composer-asset-plugin is installed,
    // if it is not, then exclude any bower-asset packages temporarily,
    // so that the installation does not fail and other packages can be installed
    $composer = $event->getComposer();
    try {
      $lockedrepo = $composer->getLocker()->getLockedRepository(true)->getPackages();
      foreach ($lockedrepo as $package) {
        if ($package->getName() == 'fxp/composer-asset-plugin') {
          // composer-asset-plugin is installed, no need to exclude the bower-asset packages below
          return;
        }
      }
    } catch (LogicException $e) {
      // If there is no lock file, then a LogicException is thrown
    }
    $requires['req'] = $composer->getPackage()->getRequires();
    $requires['dev'] = $composer->getPackage()->getDevRequires();
    foreach ($requires as $type_key => $type) {
      foreach ($type as $key => $value) {
        // delete every bower-asset requirement
        if (preg_match('/bower-asset\/.*/', $key)) {
          unset($requires[$type_key][$key]);
        }
      }
    }
    $composer->getPackage()->setRequires($requires['req']);
    $composer->getPackage()->setDevRequires($requires['dev']);
  }
}
