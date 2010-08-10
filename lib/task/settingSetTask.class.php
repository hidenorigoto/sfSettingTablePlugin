<?php

class settingSetTask extends sfBaseTask
{
  protected function configure()
  {
      $this->addArguments(array(
        new sfCommandArgument('name', sfCommandArgument::REQUIRED, 'Setting name'),
        new sfCommandArgument('text', sfCommandArgument::REQUIRED, 'Setting data text'),
        ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'setting';
    $this->name             = 'set';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [setting:set|INFO] task does things.
Call it with:

  [php symfony setting:set|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    PluginSettingTable::set($arguments['name'], $arguments['text']);
  }
}
