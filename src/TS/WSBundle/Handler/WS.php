<?php
/**
 * Created by TS.
 * User: ts
 * Date: 9/01/15
 * Time: 06:48 PM
 */

namespace TS\WSBundle\Handler;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\LogicException;
use TS\WSBundle\Form\Type\WsType;
use TS\WSBundle\Model\WsPeer;
use Symfony\Component\Form\FormFactoryInterface;
use TS\WSBundle\Model\WsQuery;

class WS {

    public  $repository;
    public  $formFactory;

    public function __construct(
        FormFactoryInterface $formFactory
    ) {
        $this->formFactory = $formFactory;
    }

    /**
     * @param $parameters
     * @return int|LogicException
     * @throws \Exception
     * @throws \PropelException
     */
    public function post($parameters)
    {
        $ws = new \TS\WSBundle\Model\Ws();

        $form = $this->formFactory->create(new WsType(), $ws, array('method' => 'POST'));

        $form->handleRequest($parameters);

        if (!$form->isValid()) {
            return new LogicException('Hay algun error en los datos enviados');
        }

        $ws->save();

        return $ws->getId();
    }

    /**
     * @param $numero
     * @return array
     */
    public function get($numero)
    {
        $query = WsQuery::create()
            ->select(array(WsPeer::TELEFONO, WsPeer::MARCA, WsPeer::MODELO, WsPeer::STATUS))
            ->findByTelefono($numero)
        ;

        $array = array();

        foreach ($query as $element) {
            $array[] = ['telefono' => $element[WsPeer::TELEFONO]];
            $array[] = ['marca' => $element[WsPeer::MARCA]];
            $array[] = ['modelo' => $element[WsPeer::MODELO]];
            $array[] = ['status' => $element[WsPeer::STATUS]];
        }

        return $array;
    }

    /**
     * @param $marca
     * @return mixed
     * @throws \PropelException
     */
    public function getByMarca($marca)
    {
        $query = WsQuery::create()
            ->select(array(WsPeer::TELEFONO))
            ->findByMarca($marca)
        ;
        $array = array();

        foreach ($query as $element) {
            $array[] = ['telefono' => $element];
        }

        return $array;
    }
}