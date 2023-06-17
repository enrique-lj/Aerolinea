<?php
namespace App\Controller\Apis;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Types\Types;
use App\Entity\Asiento;
use App\Controller\Json;
use App\Repository\AsientoRepository;
use App\Repository\TarifablesRepository;
use App\Repository\VueloRepository;


#[Route('/apiasiento', name: 'apiasiento')]
class ApiAsientoController extends AbstractController
{

    private $ar;
    private $tr;
    private $vr;

    public function __construct(private ManagerRegistry $doctrine,AsientoRepository $ar,TarifablesRepository $tr,VueloRepository $vr)
    {
        $this->ar=$ar;
        $this->tr=$tr;
        $this->vr=$vr;
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dameasiento', name: 'dameasiento',methods:"GET")]
    public function dameasiento(int $idasiento)
    {
        $asiento = $this->ar->find($idasiento);

        $data = [
            'id' => $asiento->getId(),
            'avion' => $asiento->getAvion()->getModelo(),
            'fila' => $asiento->getFila(),
            'columna' => $asiento->getColumna(),
            'clase' => $asiento->getClase(),
            'ocupado' => $asiento->isOcupado(),
            'vuelo' => $asiento->getVuelo()->getId(),
        ];


     $response = new JsonResponse();

    if ($data===[]) {

        $response->setContent(json_encode(array(
            'success' => false,
        )));
        $response->setStatusCode('202');
        return $response;
    }
    else
    {
        $response->setContent(json_encode(array(
            'success' => true,
            'data' => $data,
        )));
        $response->setStatusCode('200');
        return $response;
    }
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dameasientos/{idvuelo}', name: '/admin/dameasientos',methods:"GET")]
    public function dameasientosDelVuelo(int $idvuelo)
    {
                $asientos = $this->ar->createQueryBuilder('c')
                ->andWhere('c.vuelo = :vueloId')
                ->setParameter('vueloId', $idvuelo)
                ->getQuery()
                ->getResult()
            ;
            $data=[];

            foreach ($asientos as $asiento) {

                $data[] = [
                    'id' => $asiento->getId(),
                    'avion' => $asiento->getAvion()->getId(),
                    'fila' => $asiento->getFila(),
                    'columna' => $asiento->getColumna(),
                    'clase' => $asiento->getClase(),
                    'ocupado' => $asiento->isOcupado(),
                    'vuelo' => $asiento->getVuelo()->getId(),
                ];
             }

             $response = new JsonResponse();

            if ($data===[]) {

                $response->setContent(json_encode(array(
                    'success' => false,
                )));
                $response->setStatusCode('202');
                return $response;
            }
            else
            {
                $response->setContent(json_encode(array(
                    'success' => true,
                    'data' => $data,
                )));
                $response->setStatusCode('200');
                return $response;
            }
    }



    /**
     * @Route("/nuevares", name="nuevares", methods={"POST"})
     */
    public function nuevares(Request $request): JsonResponse
    {

        $vueloida=$request->request->get('vueloidaid');
        $tarifa=$request->request->get('tarifa');
        $asiento=$request->request->get('asientoid');

        // $preciototal=floatval($vueloida->getPrecioBase())+floatval($tarifa->getPrecio());
        // $preciototal=number_format($preciototal, 2);

        // $html =  $this->renderView('resumenpedido.html.twig', [
        //     'vueloida' => $vueloida,
        //     'tarifa' =>  $tarifa,
        //     'asientoelegidoIda' => $asiento,
        //     'preciototal' => $preciototal,
        // ]);
        $response=new JsonResponse();
        if ($request->request->get('vueloidaid'))
        {
            $response->setContent(json_encode(array(
                'success' => false,
                'data' => ['enlace' => "/elegirasiento3/".$vueloida."/".$tarifa."/".$asiento] ,
            )));
            $response->setStatusCode('202');
            return $response;
        }
        else
        {
            $response->setContent(json_encode(array(
                'success' => true,
                'data' => ['enlace' => "/elegirasiento3/".$vueloida."/".$tarifa."/".$asiento] ,
                        )));
            $response->setStatusCode('200');
            return $response;

        }

    }

    /**
     * @Route("/nuevares2", name="nuevares2", methods={"POST"})
     */
    public function nuevares2(Request $request): JsonResponse
    {

        $vueloidaid=$request->request->get('vueloidaid');
        $tarifa=$request->request->get('tarifa');
        $asientoidaid=$request->request->get('asientoidaid');
        $vuelovueltaid=$request->request->get('vuelovueltaid');
        $asientovueltaid=$request->request->get('asientovueltaid');

        $response=new JsonResponse();
        if ($request->request->get('vueloidaid'))
        {
            $response->setContent(json_encode(array(
                'success' => false,
                'data' => ['enlace' => "/elegirasiento4/".$vueloidaid."/".$asientoidaid."/".$tarifa."/".$vuelovueltaid."/".$asientovueltaid] ,
            )));
            $response->setStatusCode('202');
            return $response;
        }
        else
        {
            $response->setContent(json_encode(array(
                'success' => true,
                'data' => ['enlace' => "/elegirasiento4/".$vueloidaid."/".$asientoidaid."/".$tarifa."/".$vuelovueltaid."/".$asientovueltaid] ,
                        )));
            $response->setStatusCode('200');
            return $response;

        }

    }

}
?>