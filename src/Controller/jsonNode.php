<?php

namespace Drupal\json_node\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Entity;
use \Drupal\node\Entity\Node;

class JsonNode extends ControllerBase {

/** Enable Serialization Module **/
  public function getJsonNode($nid) {
	  
	$serializer = \Drupal::service('serializer');
	$node_load = Node::load($nid);
	$type = $node_load->getType();
	
	$api = \Drupal::configFactory()->getEditable('system.site')->get('siteapikey');
	
	if( $type == 'page' && !empty($api)){
		$json = $serializer->serialize($node_load, 'json', ['plugin_id' => 'entity']);
    }
  else $json = 'Access Denied';
  return [
      '#type' => 'markup',
      '#markup' => $json,
    ];;
  }
}