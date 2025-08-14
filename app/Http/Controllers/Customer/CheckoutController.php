<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CheckoutController extends Controller
{
    public function index(Request $request)
{
    try {
        $selectedProducts = json_decode($request->input('selected_products'), true);

        // Nếu không có sản phẩm, quay về giỏ hàng
        if (!$selectedProducts || empty($selectedProducts)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm để thanh toán');
        }

        $products = [];
        $total_amount = 0;

        foreach ($selectedProducts as $item) {
            // Lấy lại sản phẩm từ DB để đảm bảo dữ liệu chuẩn
            $product = \App\Models\Product::find($item['productId']);

            if ($product) {
                $quantity = $item['quantity'];

                $products[] = [
                    'productId' => $product->id,
                    'name'      => $product->name,
                    'price'     => $product->price,
                    'quantity'  => $quantity,
                    'image'     => $product->image
                ];

                // Tính tổng tiền
                $total_amount += $product->price * $quantity;
            }
        }

        // Nếu không còn sản phẩm hợp lệ
        if (empty($products)) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm hợp lệ');
        }

        $user = Auth::user();
        return view('customer.checkout', [
            'selectedProducts' => $products,
            'total_amount'     => $total_amount,
            'user'             => $user
        ]);

    } catch (\Exception $e) {
        return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}



    public function storeCod(Request $request)
    {
        try {
            $products = json_decode($request->selected_products, true);
            if (!$products || empty($products)) {
                return redirect()->route('cart.index')->with('error', 'Không có sản phẩm để đặt hàng');
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

            $payment->status = 'failed'; // Chờ thanh toán khi nhận hàng
            $payment->save();

            return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công');
        } catch (Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $products = json_decode($request->selected_products, true);
        if (!$products || empty($products)) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm để đặt hàng');
        }

        // COD
        if ($request->payment_method == 'cod') {
            return $this->storeCod($request);
        }

        // Momo
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
        $amount = $request->total_amount;
        $orderId = $order->id;
        $redirectUrl = route('checkout.callback');
        $ipnUrl = route('checkout.notify');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";

        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $amount .
            "&extraData=" . $extraData .
            "&ipnUrl=" . $ipnUrl .
            "&orderId=" . $orderId .
            "&orderInfo=" . $orderInfo .
            "&partnerCode=" . $partnerCode .
            "&redirectUrl=" . $redirectUrl .
            "&requestId=" . $requestId .
            "&requestType=" . $requestType;

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
        $jsonResult = json_decode($result, true);

        if (isset($jsonResult['payUrl'])) {
            return redirect()->to($jsonResult['payUrl']);
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
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
                $orderDetails = OrderDetail::where('order_id', $order->id)->get();
                foreach ($orderDetails as $orderDetail) {
                    $cartItem = CartItem::where('product_id', $orderDetail->product_id)->first();
                    if ($cartItem) {
                        $cartItem->delete();
                    }
                }
                $payment->status = 'paid';
                $payment->save();
                return redirect()->route('cart.index')->with('success', 'Thanh toán thành công');
            } else {
                $payment->status = 'failed';
                $payment->save();
                return redirect()->route('cart.index')->with('error', 'Thanh toán thất bại');
            }
        }

        $payment->status = 'failed';
        $payment->save();
        return redirect()->route('cart.index')->with('error', 'Chữ ký không hợp lệ');
    }

    public function Notify(Request $request)
    {
        return "Notify";
    }
}
