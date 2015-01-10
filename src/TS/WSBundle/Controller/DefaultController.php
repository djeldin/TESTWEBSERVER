<?php

namespace TS\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations,
    FOS\RestBundle\Controller\FOSRestController,
    FOS\RestBundle\Request\ParamFetcherInterface,
    FOS\RestBundle\View\View,
    FOS\RestBundle\View\RouteRedirectView,
    FOS\RestBundle\Util\Codes;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\Form\FormTypeInterface,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException
    ;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\Exception;

class DefaultController extends FOSRestController
{
    /**
     * @Annotations\Get("/numero/{numero}")
     *
     * @ApiDoc(
     *   section = "WS",
     *   resource = true,
     *     statusCodes = {
     *         201 = "Created",
     *         400 = "Bad Request: Errores en input"
     *     }
     * )
     *
     * @Annotations\View(
     *     statusCode = Codes::HTTP_BAD_REQUEST,
     *     templateVar = "form"
     * )
     *
     * @param $numero
     * @return Response
     */
    public function indexAction($numero)
    {
        try {
            $response = $this->container->get('ts_wsbundle.handler.ws')->get($numero);

            return new Response($response);

        } catch (Exception $e) {
            return new Response($e->getMessage());
        }
    }

    /**
     * @Annotations\Get("/marca/{marca}")
     *
     * @ApiDoc(
     *   section = "WS",
     *   resource = true,
     *     statusCodes = {
     *         201 = "Created",
     *         400 = "Bad Request: Errores en input"
     *     }
     * )
     *
     * @Annotations\View(
     *     statusCode = Codes::HTTP_BAD_REQUEST,
     *     templateVar = "form"
     * )
     *
     * @param $marca
     * @return Response
     */
    public function getByMarcaAction($marca)
    {
        try {
            $response = $this->container->get('ts_wsbundle.handler.ws')->getByMarca($marca);

            return new Response($response);

        } catch (Exception $e) {
            return new Response($e->getMessage());
        }
    }

    /**
     * @Annotations\Post("/datos")
     *
     * @ApiDoc(
     *   section = "WS",
     *   resource = true,
     *   input = "TS\WSBundle\Form\Type\WsType",
     *     statusCodes = {
     *         201 = "Created",
     *         400 = "Bad Request: Errores en input"
     *     }
     * )
     *
     * @Annotations\View(
     *     statusCode = Codes::HTTP_BAD_REQUEST,
     *     templateVar = "form"
     * )
     * @Annotations\RequestParam(name="debug", requirements="\d+", nullable=true, description="Enable debug mode response", strict=false)
     *
     * @param Request $request
     * @return Response
     */
    public function postDataAction(Request $request)
    {
        try {
            $response = $this->container->get('ts_wsbundle.handler.ws')->post($request);

            return new Response($response);

        } catch (Exception $e) {
            return new Response($e->getMessage());
        }
    }
}
