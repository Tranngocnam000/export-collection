<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;

use App\Http\Helper\ApiCode;
use Faker\Factory as Faker;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ApiResponse;
use Tests\PageObject\PolicyPageObject;

it('ensure application work correctly', function () {
    $response = $this->get('/');

    $response->assertStatus(Response::HTTP_OK);
});

it('when access by get method to /policy |expect response code 200', function () {
    $page = PolicyPageObject::asA('super')
        ->Iwant()->all()
        ->call();

    expect($page->status())->toBe(Response::HTTP_OK);
});

it('when fetch all by get method to /policy | expect response all data', function () {
    $page = PolicyPageObject::asA('super')
        ->Iwant()->all()
        ->call();

    expect($page->success())->toBe(true);
    expect($page->items())->toBeArray();
    expect($page->items(0)['id'])->toBe(1);
});

it('when fetch one by get method to /policy/id | expected response correctponding record', function () {
    $resource = PolicyPageObject::asA('super')
        ->Iwant()->fetchOne()
        ->withId(1)
        ->call();

    
    expect($resource->status())->toBe(Response::HTTP_OK);
    
    expect($resource->item())->toMatchArray([
        'id' => 1, 
        'name' => 'base-pay'
    ]);
});

it('when add a policy by post method /policy | expect the counting of record is increased', function () {
    $resourceAll = PolicyPageObject::asA('super')
        ->Iwant()->all()
        ->call();

    $countData = count($resourceAll->items());

    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()
    ->withFakeData()
    ->call();
    
    
    expect($resourceAdd->success())->toBe(true);

    $resourceAll = PolicyPageObject::asA('super')
        ->Iwant()->all()
        ->call();

    expect($resourceAll->success())->toBe(true);    
    expect(count($resourceAll->items()))->toBe($countData + 1);

});


it("when add a policy | expect to get it again", function () {
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()
    ->withFakeData()
    ->call();

    expect($resourceAdd->status())->tobe(Response::HTTP_CREATED);
    
    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();
    
    expect($resouceFetchOne->item())->toMatchArray($resourceAdd->getSubmittedData());
});

it('when add a policy then edit its name | expect the name has changed', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withName($newName = Faker::create()->text(10))
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_OK);

    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();

    expect($resouceFetchOne->item())->toMatchArray([
        'name' => $newName,
    ]);
});

it('when add a policy then edit its code | expect the code has changed', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withCode($newData = uniqid('fake-'))
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_OK);

    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();

    expect($resouceFetchOne->item())->toMatchArray([
        'code' => $newData,
    ]);
});

it('when add a policy then edit its valid_from | expect the valid_from has changed', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withValidFrom($newData = Faker::create()->dateTime()->format('Y-m-d H:i:s'))
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_OK);

    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();

    expect($resouceFetchOne->item())->toMatchArray([
        'valid_from' => $newData,
    ]);
});

it('when add a policy then edit its value | expect the value has changed', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withValue($newData = 1000000000.9876)
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_OK);

    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();

    expect($resouceFetchOne->item())->toMatchArray([
        'value' => $newData,
    ]);
});

it('when add a policy then edit its unit | expect the unit has changed', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withUnitValue($newData = Faker::create()->currencyCode())
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_OK);

    $resouceFetchOne = PolicyPageObject::asA('super')
    ->Iwant()->fetchOne()
    ->withId($resourceAdd->data()['last_insert_id'])
    ->call();
    
    expect($resouceFetchOne->item())->toMatchArray([
        'unit_value' => $newData,
    ]);
});

it('when add a policy without name | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData([
        'name' => null
    ])
    ->call();

    expect($resourceAdd->status())->toBe(Response::HTTP_BAD_REQUEST);
    
    expect($resourceAdd->data())->toHaveKey('name');
});

it('when add a policy without code | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData([
        'code' => null
    ])
    ->call();

    expect($resourceAdd->status())->toBe(Response::HTTP_BAD_REQUEST);
    
    expect($resourceAdd->data())->toHaveKey('code');
});

it('when add a policy without valid_from | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData([
        'valid_from' => null
    ])
    ->call();

    expect($resourceAdd->status())->toBe(Response::HTTP_BAD_REQUEST);
    
    expect($resourceAdd->data())->toHaveKey('valid_from');
});

it('when add a policy without value | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData([
        'value' => null
    ])
    ->call();

    expect($resourceAdd->status())->toBe(Response::HTTP_BAD_REQUEST);
    
    expect($resourceAdd->data())->toHaveKey('value');
});

it('when add a policy without unit_value | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData([
        'unit_value' => null
    ])
    ->call();

    expect($resourceAdd->status())->toBe(Response::HTTP_BAD_REQUEST);
    
    expect($resourceAdd->data())->toHaveKey('unit_value');
});

it('when edit a policy with so long unit_value | expect validation error', function(){
    $resourceAdd = PolicyPageObject::asA('super')
    ->Iwant()->add()->withFakeData()
    ->call();

    $resourceEdit = PolicyPageObject::asA('super')->Iwant()
    ->edit($resourceAdd->data()['last_insert_id'])
    ->withUnitValue($newData = Faker::create()->currencyCode().'456')
    ->call();

    expect($resourceEdit->status())->toBe(Response::HTTP_BAD_REQUEST);

    expect($resourceEdit->data())->toHaveKey('unit_value');
});
