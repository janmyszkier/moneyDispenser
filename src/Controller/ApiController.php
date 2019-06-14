<?php

namespace App\Controller;

use App\Service\MoneyDispenser;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
/**
 * @Route("api/money")
 */
class ApiController
{
    /**
     * @Route("/get/{amount}", name="api_money_get", methods={"GET"})
     * @SWG\Get(
     *     tags={"money"},
     *     @SWG\Parameter(
     * 			name="amount",
     * 			in="path",
     * 			required=true,
     * 			type="integer",
     * 			description="Amount to retrieve",
     * 	   ),
     *     @SWG\Response(
     *         response=200,
     *         description="List of bank notes"
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Invalid Argument. Returned for negative and incorrect values"
     *     )
     * )
     */
    public function getAction(Request $request, MoneyDispenser $moneyDispenser)
    {
        $requestedAmount = (int) $request->get('amount');
        try {
            $collection = $moneyDispenser->retrieveAmount($requestedAmount);
        } catch (MoneyDispenser\InvalidArgumentException $e){

            /**
             * @see: https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/422
             */
            return new JsonResponse([],422);
        }
        $bankNotes = [];
        foreach($collection->getIterator() as $bankNote){
            $bankNotes[] = (string) $bankNote;
        }
        return new JsonResponse($bankNotes,200);
    }
}