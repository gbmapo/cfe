<?php

function association_member_region()
{
  $values = [
    'FR-ARA' => 'Auvergne-Rhône-Alpes',
    'FR-BFC' => 'Bourgogne-Franche-Comté',
    'FR-BRE' => 'Bretagne',
    'FR-CVL' => 'Centre-Val de Loire',
    'FR-COR' => 'Corse',
    'FR-GES' => 'Grand Est',
    'FR-HDF' => 'Hauts-de-France',
    'FR-IDF' => 'Île-de-France',
    'FR-NOR' => 'Normandie',
    'FR-NAQ' => 'Nouvelle-Aquitaine',
    'FR-OCC' => 'Occitanie',
    'FR-PDL' => 'Pays de la Loire',
    'FR-PAC' => 'Provence-Alpes-Côte d\'Azur',
    'FR-GP' => 'Guadeloupe',
    'FR-GF' => 'Guyane',
    'FR-MQ' => 'Martinique',
    'FR-RE' => 'La Réunion',
    'FR-YT' => 'Mayotte',
  ];
  return $values;
}

function association_member_country()
{
  $countries = Drupal::service('country_manager')->getList();
  $key = 'FR';
  $data = $countries[$key];
  unset($countries[$key]);
  $countries = array_merge(array($key=>$data),$countries);
  return $countries;
}

function association_member_status()
{
  $values = [
    0 => 'Ancien adhérent',
    1 => 'Adhésion non renouvelée',
    2 => 'Adhésion en attente',
    3 => 'Adhésion renouvelée',
    4 => 'Adhérent actif',
  ];
  return $values;
}
