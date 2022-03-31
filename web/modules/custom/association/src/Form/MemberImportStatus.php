<?php

namespace Drupal\association\Form;

use Drupal;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\migrate\MigrateExecutable;
use Drupal\migrate\MigrateMessage;
use Drupal\file\Entity\File;

/**
 * Class MemberImportStatus.
 */
class MemberImportStatus extends FormBase
{

  public function getFormId()
  {
    return 'member_import_status';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $form['file_to_import'] = [
      '#type'              => 'managed_file',
      '#upload_location'   => 'private://',
      '#upload_validators' => [
        'file_validate_extensions' => ['csv'],
      ],
      '#title'             => $this->t('File to import'),
      '#description'       => $this->t('Select the file to import'),
      '#weight'            => '0',
    ];

    $form['submit'] = [
      '#type'   => 'submit',
      '#name'   => 'submit',
      '#value'  => $this->t('Submit'),
      '#weight' => '0',
    ];

    $form['cancel'] = [
      '#type'   => 'submit',
      '#name'   => 'cancel',
      '#value'  => $this->t('Cancel'),
      '#weight' => '10',
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {

    parent::validateForm($form, $form_state);

    if ($form_state->getTriggeringElement()['#name'] == 'submit') {
      if (!$form_state->getValue('file_to_import')) {
        $form_state->setErrorByName('file_to_import', $this->t('Please select a file.'));
      }
    }

  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {

    if ($form_state->getTriggeringElement()['#name'] == 'submit') {

      $fileId = $form_state->getValue('file_to_import')[0];
      $file = File::load($fileId);
      $filename = $file->filename->value;

      $uri = $file->uri->value;
      $filenamenew = 'migration_UpdateMembers.csv';
      $urinew = 'private://migration_UpdateMembers.csv';
      $file->setFilename($filenamenew);
      $file->setFileUri($urinew);
      $file->save();
      rename($uri, $urinew);

      $migration_id = 'migration_updatemembers';
      $migration = Drupal::service('plugin.manager.migration')->createInstance($migration_id);
      $executable = new MigrateExecutable($migration, new MigrateMessage());
      $executable->import();

      $file->delete();
    }

    $form_state->setRedirect('view.association_members.page_1');

  }

}
