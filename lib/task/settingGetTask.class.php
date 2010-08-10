<?php

class settingGetTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addArguments(array(
       new sfCommandArgument('name', sfCommandArgument::REQUIRED, 'Setting name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'setting';
    $this->name             = 'get';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [setting:get|INFO] task does things.
Call it with:

  [php symfony setting:get|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $text = PluginSettingTable::get($arguments['name']);
      var_dump($text);
  }
}
