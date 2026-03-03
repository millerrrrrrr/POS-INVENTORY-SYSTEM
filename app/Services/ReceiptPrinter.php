<?php

namespace App\Services;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ReceiptPrinter
{
    public static function print($order, $items)
    {
        $connector = new WindowsPrintConnector("POS-58");
        $printer = new Printer($connector);

        $lineWidth = 32;

        // ===== HEADER =====
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setTextSize(2, 2);
        $printer->text("Rhaw Motor Shop\n");  // Shop Name

        $printer->setTextSize(1, 1);
        $printer->text("TIN: 123-456-789\n");  // <-- Edit your TIN here
        $printer->text("Contact: 0912-345-6789\n");  // <-- Edit contact number
        $printer->text("Address: Purok 2 Sto. Niño, San Felipe, Zambales\n");  // <-- Edit address
        $printer->text("Official Receipt\n\n");

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

            $dots = str_repeat('.', $lineWidth - strlen($qtyPrice) - strlen($subtotal));
            $printer->text($qtyPrice . $dots . $subtotal . "\n");
        }

        $printer->text(str_repeat("-", $lineWidth) . "\n");

        // ===== TOTAL =====
        $total = $order->total;

        // Extract VAT from VAT-inclusive total
        $vatAmount = $total * (12 / 112);

        $totalLine = "PHP" . number_format($total, 2);
        $dots = str_repeat('.', $lineWidth - strlen("Total (VAT Inc.)") - strlen($totalLine));

        $printer->setEmphasis(true);
        $printer->text("Total (VAT Inc.)" . $dots . $totalLine . "\n\n");
        $printer->setEmphasis(false);

        // ===== CASH & CHANGE =====
        $cashLine = "PHP" . number_format($order->cash, 2);
        $dots = str_repeat('.', $lineWidth - strlen("Cash") - strlen($cashLine));
        $printer->text("Cash" . $dots . $cashLine . "\n");

        $changeLine = "PHP" . number_format($order->change, 2);
        $dots = str_repeat('.', $lineWidth - strlen("Change") - strlen($changeLine));
        $printer->text("Change" . $dots . $changeLine . "\n\n");

        // ===== VAT (Extracted) =====
        $vatLine = "PHP" . number_format($vatAmount, 2);
        $dots = str_repeat('.', $lineWidth - strlen("VAT (12%)") - strlen($vatLine));
        $printer->text("VAT (12%)" . $dots . $vatLine . "\n\n");

        // ===== FOOTER =====
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("VAT already included in prices\n");
        $printer->text("Thank you for your purchase!\n\n");

        $printer->cut();
        $printer->close();
    }
}