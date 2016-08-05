<?php

/*
 * This file is auto-generated, do not edit
 */

namespace Recombee\RecommApi\Tests;

use Recombee\RecommApi\Exceptions as Exc;

abstract class SetValuesTestCase extends RecombeeTestCase {

    abstract protected function createRequest($entity_id,$values);

    public function testSetValues() {

         //it does not fail with existing entity and property
         $req = $this->createRequest('entity_id',['int_property' => 5]);
         $resp = $this->client->send($req);

         //it sets multiple properties
         $req = $this->createRequest('entity_id',['int_property' => 5,'str_property' => 'test']);
         $resp = $this->client->send($req);

         //it does not fail with !cascadeCreate
         $req = $this->createRequest('new_entity',['int_property' => 5,'str_property' => 'test','!cascadeCreate' => true]);
         $resp = $this->client->send($req);

         //it fails with nonexisting entity
         $req = $this->createRequest('nonexisting',['int_property' => 5]);
         try {

             $this->client->send($req);
             throw new \Exception('Exception was not thrown');
         }
         catch(Exc\ResponseException $e)
         {
            $this->assertEquals(404, $e->status_code);
         }

    }
}

?>
