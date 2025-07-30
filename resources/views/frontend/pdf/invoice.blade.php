<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DNZ Invoice</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 17cm;
            /* height: 21.7cm; */
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
            line-height: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table .table-left-block {
            text-align: left;
            padding: 4px;
        }

        .product-specification-block .table tbody tr th {
            border: 1px solid #ccc;
            padding: 10px 5px;
            font-weight: 600;
            color: #000;
        }

        .product-specification-block .table tbody tr td {
            border: 1px solid #ccc;
            text-align: left;
            padding: 9px 5px;
        }

        table th {
            padding: 5px 20px;
            color: #000000;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            color: #F70000;
            font-weight: 550;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img alt="logo" src="{{ env('APP_URL').'/assets/img/new-logo.png' }}" />
        </div>
        <h1
            style="text-transform: uppercase; background-color: #f4dd89; color: #fff; padding: 6px 0px; font-size: 20px; margin-bottom: 10px;">
            INVOICE #{{ $order->order_id ?? '-' }}</h1>

        <div class="payment-staus-block" style="text-align: center">
            <h4
                style="text-transform: uppercase; color:{{ $order->payment_status == '1' ? '#f82426' : '#f4dd89' }}; padding: 6px 0px; font-size: 20px; margin: 6px 0px">
                <span style= "color:#000;">Payment Status :</span> {{ $order->payment_status == '1' ? 'Pending' : 'Complete' }}</h4>
        </div>

        <div id="company" class="clearfix" style="padding-left: 20px; padding-right: 20px;">
            <h4>Billing Address</h4>
            <div>{{ ucfirst($order->billingAddress->first_name) ?? '' }}
                {{ ucfirst($order->billingAddress->last_name) ?? '' }}</div>
            <div>{{ $order->billingAddress->email ?? '' }}</div>
            <div>{{ $order->billingAddress->mobile ?? '' }}</div>
            <div>{{ ucfirst($order->billingAddress->address) ?? '' }}</div>
            <div>{{ ucfirst($order->billingAddress->city) ?? '' }}</div>
            <div>{{ ucfirst($order->billingAddress->state) ?? '' }}, {{ $order->billingAddress->zipcode ?? '' }}</div>
        </div>
        <div id="project" style="padding-right: 20px; padding-left: 20px;">
            <h4>Shipping Address</h4>
            <div>{{ ucfirst($order->shippingAddress->first_name) ?? '' }}
                {{ ucfirst($order->shippingAddress->last_name) ?? '' }}</div>
            <div>{{ $order->shippingAddress->email ?? '' }}</div>
            <div>{{ $order->shippingAddress->mobile ?? '' }}</div>
            <div>{{ ucfirst($order->shippingAddress->address) ?? '' }}</div>
            <div>{{ ucfirst($order->shippingAddress->city) ?? '' }}</div>
            <div>{{ ucfirst($order->shippingAddress->state) ?? '' }}, {{ $order->shippingAddress->zipcode ?? '' }}
            </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr style="background-color: #555555;">
                    <th class="service" style="color: #fff; padding:12px 20px;">ORDER ITEM</th>
                    <th style="text-align: right; color: #fff; padding:12px 20px;">PRICE</th>
                    <th style="text-align: right; color: #fff; padding:12px 20px;">QTY</th>
                    <th style="text-align: right; color: #fff; padding:12px 20px;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order['orderItems'] as $key => $item)
                    <tr>
                        <td class="service"><span
                                style="font-weight:400; font-size: 20px;">{{ ucfirst($item->product->name) ?? '-' }}</span>
                            <div class="product-specification-block" style="margin-top: 16px;">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        @if ($item['productVariation'])
                                            <tr>
                                                <th class="table-left-block">Attribute</th>
                                                <th class="table-left-block">Variation</th>
                                            </tr>
                                            {{-- @if --}}
                                            @foreach ($item['productVariation']['variation'] as $attrKey => $attrVal)
                                                <tr>
                                                    <td class="table-left-block">
                                                        {{ $attrVal['allAttribute']['name'] ?? '-' }}
                                                    </td>

                                                    <td>
                                                        {{ $attrVal['name'] ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td class="unit" style="vertical-align: top">
                            {{ '₹' . number_format($item->sell_price, 2) ?? '-' }}</td>
                        <td class="qty" style="vertical-align: top">{{ $item->quantity ?? '-' }} Item</td>
                        <td class="total" style="vertical-align: top">
                            {{ '₹' . number_format($item->sell_price * $item->quantity, 2) ?? '-' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3">SUB TOTAL</td>
                    <td class="total">${{ number_format(collect($order['orderItems'])->sum('total_amount'), 2) }}</td>
                </tr>
                @if (count($order['orderCharges']))
                    @foreach ($order['orderCharges'] as $charge)
                        <tr>
                            <td colspan="3">
                                {{ strtoupper($charge['type']) ?? 'NA' }} ({{ $charge['name'] }})
                            </td>
                            <td class="total">
                                {{ $charge['type'] == 'coupon' ? '- ' : '' }}${{ isset($charge['charge']) ? number_format($charge['charge'], 2) : 0 }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">TAX</td>
                        <td class="total">$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3">COUPON</td>
                        <td class="total">$0.00</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="3" class="grand total">GRAND TOTAL</td>
                    <td class="grand total">${{ number_format($order['amount'], 2) }}</td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
