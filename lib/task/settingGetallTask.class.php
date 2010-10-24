<?php

class settingGetallTask extends sfBaseTask
{

  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace = 'setting';
    $this->name = 'get-all';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [setting:get-all|INFO] task does things.
Call it with:

  [php symfony setting:get-all|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $settings = SettingTable::getInstance()->findAll();
    $this->log(sprintf('%s records found.', count($settings)));
    foreach ($settings as $setting)
    {
      $this->logSection($setting->getSettingName(), $setting->getText());
    }
  }

}
