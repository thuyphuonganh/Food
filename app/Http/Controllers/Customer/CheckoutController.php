<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Redis;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        try {
            $selectedProducts = json_decode($request->input('selected_products'), true);
            if (!$selectedProducts || empty($selectedProducts)) {

                return response()->json([
                    'message' => "Không có sản phẩm",
                    'checkout' => $selectedProducts,
                ], 404);
            }
            $total_amount = 0;
            foreach ($selectedProducts as $product) {
                $total_amount += $product['price'] * $product['quantity'];
            }
            return response()->json([
                'message' => "Thông tin sản phẩm cần thanh toán",
                'checkout' => $selectedProducts,
                'totalAmount' => $total_amount
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 404);
        }



        //return view('customer.checkout', compact('selectedProducts', 'total_amount'));
    }

    public function checkout(Request $request)
    {
        return view('customer.checkout', compact('total_amount'));
    }

    public function storeCod(Request $request)
    {
        try {
            $products = json_decode($request->selected_products, true);
            if (!$products || empty($products)) {
                return response()->json([
                    'message' => "Không có sản phẩm",
                    'products' => $products,
                ], 404);
            }

            $order = new Order();
            $order->id = time() . "";
            $order->fullName = $request->name;
            $order->phoneNumber = $request->phone;
            $order->address = $request->address;
            $order->description = $request->description;
            $order->status = 'pending';
            $order->total_amount = $request->total_amount;
            $order->user_id = Auth::user()->id;
            $order->save();
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_method = 'cod';
            $payment->amount_paid = $order->total_amount;
            foreach ($products as $product) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product['productId'];
                $orderDetail->price = $product['price'];
                $orderDetail->quantity = $product['quantity'];
                $orderDetail->save();
            }
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            foreach ($orderDetails as $orderDetail) {
                $cartItem = CartItem::where('product_id', $orderDetail->product_id)->first();
                if ($cartItem) {
                    $cartItem->delete();
                }
            }
            $payment->status = 'failed';
            $payment->save();
            return response()->json([
                'message' => "Đặt hàng thành công",
                'order' => $order,
                'payment' => $payment
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $products = json_decode($request->selected_products, true);
        if (!$products || empty($products)) {
            return response()->json([
                'message' => "Không có sản phẩm",
                'products' => $products,
            ], 404);
        }
        return response()->json([
            'message' => "Cac sản phẩm",
            'products' => $products,
        ], 200);

        if ($request->payment_method == 'cod') {
            $order = new Order();
            $order->id = time() . "";
            $order->fullName = $request->name;
            $order->phoneNumber = $request->phone;
            $order->address = $request->address;
            $order->description = $request->description;
            $order->status = 'pending';
            $order->total_amount = $request->total_amount;
            $order->user_id = Auth::user()->id;
            $order->save();
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_method = 'cod';
            $payment->amount_paid = $order->total_amount;
            foreach ($products as $product) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product['productId'];
                $orderDetail->price = $product['price'];
                $orderDetail->quantity = $product['quantity'];
                $orderDetail->save();
            }
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            foreach ($orderDetails as $orderDetail) {
                $cartItem = CartItem::where('product_id', $orderDetail->product_id)->first();
                if ($cartItem) {
                    $cartItem->delete();
                }
            }
            $payment->status = 'failed';
            $payment->save();
            return to_route('cart.index');
        }

        $order = new Order();
        $order->id = time() . "";
        $order->fullName = $request->name;
        $order->phoneNumber = $request->phone;
        $order->address = $request->address;
        $order->description = $request->description;
        $order->status = 'pending';
        $order->total_amount = $request->total_amount;
        $order->user_id = Auth::user()->id;
        $order->save();
        foreach ($products as $product) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['productId'];
            $orderDetail->price = $product['price'];
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->save();
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->total_amount; // Số tiền thanh toán
        $orderId = $order->id; // Mã đơn hàng, có thể là ID của đơn hàng trong hệ thống của bạn
        $redirectUrl = route('checkout.callback');
        $ipnUrl = route('checkout.notify');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        if (isset($jsonResult['payUrl'])) {
            $url = $jsonResult['payUrl'];
            return redirect()->to($url);
        } else {
            return redirect()->back()->with('error', 'Lỗi kết nối đến MoMo');
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function Callback(Request $request)
    {

        $signature = $request->input('signature');
        $orderId = $request->input('orderId');
        $amount = $request->input('amount');
        $payment = new Payment();
        $payment->order_id = $orderId;
        $payment->payment_method = 'momo';
        $payment->amount_paid = $amount;

        $data = $request->all();
        $generatedSignature = $data['signature'];
        if ($signature == $generatedSignature) {
            $status = $request->input('resultCode');
            if ($status == 0) {
                $order = Order::findOrFail($orderId);
                if ($order) {

                    $orderDetails = OrderDetail::where('order_id', $order->id)->get();
                    foreach ($orderDetails as $orderDetail) {
                        $cartItem = CartItem::where('product_id', $orderDetail->product_id)->first();
                        if ($cartItem) {
                            $cartItem->delete();
                        }
                    }

                    $payment->status = 'paid';
                    $payment->save();
                    return to_route('cart.index');
                } else {
                    $payment->status = 'failed';
                    $payment->save();
                    return "Đơn hàng không tồn tại";
                }
            } else {
                $payment->status = 'failed';
                $payment->save();
                //"Thanh toán không thành công";
                return to_route('cart.index');
            }
            $payment->status = 'failed';
            $payment->save();
            return $generatedSignature;
        }
    }

    public function Notify(Request $request)
    {
        return "Notify";
    }
}
