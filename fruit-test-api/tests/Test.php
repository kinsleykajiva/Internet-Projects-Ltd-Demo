<?php


use App\Controller\FruitsController;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class Test extends WebTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testCreateFruitCreate()
    {
        // Create a mock EntityManagerInterface
        $entityManager = $this->createMock(EntityManagerInterface::class);

        // Create a FruitsController instance
        $controller = new FruitsController();

        // Call the create function with a mock Request object
        $request = Request::create('/fruits', 'POST', [], [], [], [], json_encode([
            'name' => 'Apple',
            'genus' => 'Malus',
            'family' => 'Rosaceae',
            'order' => 'Rosales',
            'nutritions' => [
                'carbohydrates' => 11.4,
                'protein' => 0.3,
                'fat' => 0.4,
                'calories' => 52,
                'sugar' => 10.3,
            ],
        ]));

        $response = $controller->create($request, $entityManager);

        // Assert that the response has a 200 status code
        $this->assertEquals(200, $response->getStatusCode());

        // Assert that the response data includes the ID of the newly created fruit
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('id', $responseData['data']);
    }
}
