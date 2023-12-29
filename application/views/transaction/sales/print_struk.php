<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myPos</title>
    <style type="text/css">
        html {
            font-family: "consolas";
        }
        
        .content {
            width: 70mm;
            font-size: 13px;
            /* padding: 5px; */
            /* margin-left: 0px; */
            /* font-weight: bold; */
        }

        .title {
            text-align: center;
            font-size: 16px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            /* margin-top: 5px; */
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 8px;
            /* padding-top: 10px; */
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 70mm;
                margin: 0mm;
                margin-left: 0px;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b>VISTA MART</b> <br>
            Jetak Kedungdowo RT6/5 Kaliwungu
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0" style="font-size:16px">
                <tr>
                    <td style="width:200px;">
                        <?= date('d/m/Y', strtotime($sale->date)) . " " . date('H:i', strtotime($sale->sale_created)); ?>
                    </td>
                    <td>Cashier</td>
                    <td style="text-align: center;width:12px;">:</td>
                    <td style="text-align: right;">
                        <?= ucfirst($sale->user_name); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $sale->invoice; ?>
                    </td>
                    <td>Customer</td>
                    <td style="text-align: center;">:</td>
                    <td style="text-align: right;">
                        <?= $sale->customer_id != null ? $sale->customer_id : "Umum" ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0" style="font-size: 15px;">
                <?php $arr_discount = [];
                foreach ($sale_detail as $sd) { ?>
                <tr>
                    <td colspan="4" style="text-transform: uppercase;"><?= $sd->nm_barang; ?> </td>
                </tr>
                <tr>
                        <td style="width: 10px;"><?= $sd->qty; ?> </td>
                        <td style="width: 20px;">&nbsp;<?= $sd->nm_unit; ?> </td>
                        <td style="text-align: right;width:90px;"><?= $sd->price; ?></td>
                        <td style="text-align: right;width:90px;">
                            <?= ($sd->price - $sd->discount_item) * $sd->qty; ?>
                        </td>
                </tr>
                <tr>
                    <td colspan="4"><hr style="border: 1px solid white;"></td>
                </tr>
                    <?php
                    if ($sd->discount_item > 0) {
                        $arr_discount[] = $sd->discount_item;
                    }
                }
                foreach ($arr_discount as $ad) { ?>
                    <tr>
                        <td></td>
                        <td colspan="2" style="text-align: right;">Disc. <?= $ad + 1; ?></td>
                        <td style="text-align: right;"><?= $ad; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed;padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px; text-transform: uppercase;">Total</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= $sale->total_price; ?>
                    </td>
                </tr>
                <?php if ($sale->discount > 0) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-top:5px;">Disc. Sale</td>
                        <td style="text-align: right; padding-top:5px;">
                            <?= $sale->discount; ?>
                        </td>
                    </tr>
                <?php } ?>
                <!-- <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px;">Grand Total</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= $sale->final_price; ?>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px; text-transform: uppercase;">Uang</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= $sale->cash; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; text-transform: uppercase;">Kembali </td>
                    <td style="text-align: right;">
                        <?= $sale->uang_kembalian; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
           <p style="font-size:14px"> ---Terima kasih, silahkan kembali lagi--- </p>
        </div>
    </div>
</body>

</html>