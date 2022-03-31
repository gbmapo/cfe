<?php

namespace Drupal\association\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class MembersAndPersonsController.
 */
class MembersAndPersonsController extends ControllerBase
{

  public function export_membersformaps()
  {
    _export_association_CSV('association_members', 'rest_export_2');
    $sFileName = 'export_membersformaps.csv';
    $sFileNameWithPath = 'sites/default/files/_private/' . $sFileName;
    $response = new BinaryFileResponse($sFileNameWithPath);
    $response->setContentDisposition(
      ResponseHeaderBag::DISPOSITION_ATTACHMENT,
      $sFileName
    );
    return $response;
  }

  public function export_members()
  {
    _export_association_CSV('association_members', 'rest_export_1');
    $sFileName = 'export_members.csv';
    $sFileNameWithPath = 'sites/default/files/_private/' . $sFileName;
    $response = new BinaryFileResponse($sFileNameWithPath);
    $response->setContentDisposition(
      ResponseHeaderBag::DISPOSITION_ATTACHMENT,
      $sFileName
    );
    return $response;
  }

  public function export_persons()
  {
    _export_association_CSV('association_persons', 'rest_export_1');
    $sFileName = 'export_persons.csv';
    $sFileNameWithPath = 'sites/default/files/_private/' . $sFileName;
    $response = new BinaryFileResponse($sFileNameWithPath);
    $response->setContentDisposition(
      ResponseHeaderBag::DISPOSITION_ATTACHMENT,
      $sFileName
    );
    return $response;
  }

}
