<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\AvailableLink;
use App\Models\UserLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Mockery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class AvailableLinkMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_middleware_passes_with_available_link()
    {
        $request = $this->createRequestWithUserLink($this->createMockUserLink(false, false));

        $response = (new AvailableLink())->handle($request, function() {
            return new Response(status: Response::HTTP_OK);
        });
        $this->assertEquals( Response::HTTP_OK, $response->getStatusCode());
    }

    public function test_middleware_block_with_expired_link()
    {
        $request = $this->createRequestWithUserLink($this->createMockUserLink(false, true));

        $this->expectException(NotFoundHttpException::class);
        (new AvailableLink())->handle($request, function() {
            return new Response(status: Response::HTTP_OK);
        });
    }

    public function test_middleware_block_with_deleted_link()
    {
        $request = $this->createRequestWithUserLink($this->createMockUserLink(true, false));

        $this->expectException(NotFoundHttpException::class);
        (new AvailableLink())->handle($request, function() {
            return new Response(status: Response::HTTP_OK);
        });
    }

    protected function createMockUserLink(bool $isDeleted, bool $isExpired): UserLink
    {
        $userLink = Mockery::mock(UserLink::class);
        $userLink->shouldReceive('isDeleted')->andReturn($isDeleted);
        $userLink->shouldReceive('isExpired')->andReturn($isExpired);
        return $userLink;
    }

    protected function createRequestWithUserLink(UserLink $userLink): Request
    {
        $request = Request::create('/test');

        $route = new Route('GET', '/test', []);
        $route->bind($request);
        $route->setParameter('userLink', $userLink);
        $request->setRouteResolver(fn() => $route);

        return $request;
    }

}
