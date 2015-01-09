<?php

namespace TS\WSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;

class DefaultController extends Controller
{
    /**
     * @Annotations\Post("/crear_persona")
     *
     * @ApiDoc(
     *   section = "WS",
     *   resource = true,
     *   input = "Servir\WSConexionFactorhBundle\Form\Type\PersonalType",
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
     * @return array
     */
    public function indexAction(Request $request)
    {
        try {
            $response = $this->container->get('servir_ws_conexion_factorh.handler.personal')->post(
                $request->request->all()
            );

            return new Response($response);

        } catch (InvalidFormException $e) {
            return new Response($e->getForm());
        }
    }
}
