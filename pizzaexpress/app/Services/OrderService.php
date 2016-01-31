<?php
/**
 * Created by PhpStorm.
 * User: ClaudioSouza
 * Date: 19/01/2016
 * Time: 18:47
 */

namespace pizzaexpress\Services;


use pizzaexpress\Models\Order;
use pizzaexpress\Repositories\CupomRepository;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\ProductRepository;

class OrderService
{
    private $orderRepository;
    private $cupomRepository;
    private $productRepository;

    function __construct(OrderRepository $orderRepository,
                         CupomRepository $cupomRepository,
                         ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        //dd($data);
        \DB::beginTransaction();
        try{
            $data['status'] = 0;

            if(isset($data['cupom_id'])){
                unset($data[cupom_id]);
            }
            if(!$data['cupom_code'] == ""){
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $idCupom = $cupom->id;
                $cupom->save();
                unset($data['cupom_code']);
            }
            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach($items as $item){
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;
            if(isset($cupom)){
                $order->total = $total - $cupom->value;
                $order->cupom_id = $idCupom;
            }
            $order->save();
            \DB::commit();
            return $order;
        }catch (\Exception $e){
            \DB::rollback();
            throw $e;
        }


    }

    public function updateStatus($id, $idDeliveryman, $status)
    {
        $order = $this->orderRepository->getByIdDeliveryman($id, $idDeliveryman);
        if($order instanceof Order){
            $order->status = $status;
            $order->save();
            return$order;
        }

        return false;
    }


}