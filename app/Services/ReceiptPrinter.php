<?php

namespace App\Services;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ReceiptPrinter
{
    public static function print($order, $items)
    {
        // Change to your printer name
        $connector = new WindowsPrintConnector("POS-58");
        $printer = new Printer($connector);

        $lineWidth = 32; // Approximate characters per line for 58mm printer

        // ===== HEADER =====
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(2, 2);
        $printer->text("Rhaw Motor Shop\n");
        $printer->setTextSize(1, 1);
        $printer->text("Receipt\n\n");

        // ===== ORDER INFO =====
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Order #: {$order->id}\n");
        $printer->text("Date: {$order->order_date}\n");
        $printer->text(str_repeat("-", $lineWidth) . "\n");

        // ===== ITEMS =====
        foreach ($items as $item) {
            $printer->text($item->product->name . "\n");

            $qtyPrice = "{$item->quantity} x " . number_format($item->price, 2);
            $subtotal = "PHP" . number_format($item->subtotal, 2);

            // Add dots between label and number
            $dots = str_repeat('.', $lineWidth - strlen($qtyPrice) - strlen($subtotal));
            $printer->text($qtyPrice . $dots . $subtotal . "\n");
        }

        $printer->text(str_repeat("-", $lineWidth) . "\n");

        // ===== TOTALS =====
        $totals = [
            "Subtotal" => $order->total,
            "VAT" => $order->vat,
            "TOTAL" => $order->total_with_vat,
            "Cash" => $order->cash,
            "Change" => $order->change
        ];

        foreach ($totals as $label => $amount) {
            $num = "PHP" . number_format($amount, 2);
            $dots = str_repeat('.', $lineWidth - strlen($label) - strlen($num));
            if ($label === "TOTAL") {
                $printer->setEmphasis(true);
                $printer->text($label . $dots . $num . "\n");
                $printer->setEmphasis(false);
            } else {
                $printer->text($label . $dots . $num . "\n");
            }
        }

        // ===== FOOTER =====
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("\nThank you!\n\n");

        $printer->cut();
        $printer->close();
    }
}