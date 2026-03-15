<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;





class UtilitiyController extends Controller
{
    public function index()
    {



        return view('utilities.index');
    }

    public function productArchive()
    {

        $products = Product::onlyTrashed()->paginate(8);

        return view('utilities.productArchive', compact('products'));
    }

    public function productRestore($id)
    {

        $restore = Product::onlyTrashed()->findOrFail($id)->restore();

        if ($restore) {
            return back()->with('success', 'Restored Successfully');
        }
    }

    public function productForceDelete($id)
    {
        // Find the product by ID
        $product = Product::withTrashed()->findOrFail($id);

        // Delete the image from storage if it exists
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        // Permanently delete the product from database
        $product->forceDelete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product permanently deleted.');
    }




    public function orderArchive()
    {


        $order = Order::onlyTrashed()->paginate(10);

        return view('utilities.orderArchive', compact('order'));
    }

    public function viewDeletedOrder($id)
    {
        // Include soft-deleted orders
        $order = Order::withTrashed()->with('items.product')->findOrFail($id);

        return view('utilities.viewDeletedOrder', compact('order'));
    }

    public function restoreOrder($id)
    {
        $order = Order::withTrashed()->with('items')->findOrFail($id);
        foreach ($order->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
        $order->restore();
        return back()->with('success', 'Order restored and stock deducted.');
    }

    public function forceDeleteOrder($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();
        return back()->with('success', 'Order permanently deleted.');
    }


    // BACK UP



   public function backupIndex(Request $request)
{
    $backupPath = storage_path('backups');
    if (!File::exists($backupPath)) {
        File::makeDirectory($backupPath, 0755, true);
    }

    $files = collect(File::files($backupPath))->sortByDesc(fn($file) => $file->getCTime());

    // Pagination
    $perPage = 8;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $files->slice(($currentPage - 1) * $perPage, $perPage)->values();

    $backups = new LengthAwarePaginator(
        $currentItems,
        $files->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('utilities.backupIndex', compact('backups'));
}

    // public function backupDatabase()
    // {
    //     $database = config('database.connections.mysql.database');
    //     $username = config('database.connections.mysql.username');
    //     $password = config('database.connections.mysql.password');
    //     $host = config('database.connections.mysql.host');

    //     $backupPath = storage_path('backups');
    //     if (!file_exists($backupPath)) {
    //         mkdir($backupPath, 0755, true);
    //     }

    //     $filename = $backupPath . "/backup-" . date('Y-m-d_H-i-s') . ".sql";

    //     // Run mysqldump to create backup
    //     $command = "mysqldump --user={$username} --password='{$password}' --host={$host} {$database} > {$filename}";
    //     system($command);

    //     return redirect()->route('backupIndex')->with('success', 'Backup created successfully!');
    // }



    public function backupDatabase()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password'); // might be empty
        $host = config('database.connections.mysql.host');

        $backupPath = storage_path('backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $filename = $backupPath . "/backup-" . date('Y-m-d_H-i-s') . ".sql";

        // Build mysqldump command safely
        $command = "mysqldump --user={$username} ";

        // Only include password if it's not empty
        if (!empty($password)) {
            $command .= "--password='{$password}' ";
        }

        $command .= "--host={$host} {$database} > {$filename} 2>&1";

        // Execute the command
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        // Check for errors
        if ($return_var !== 0) {
            return back()->with('error', 'Backup failed: ' . implode("\n", $output));
        }

        return redirect()->route('backupIndex')->with('success', 'Backup created successfully!');
    }



    public function downloadBackup($filename)
    {
        $path = storage_path('backups/' . $filename);

        if (!file_exists($path)) {
            abort(404, "Backup file not found.");
        }

        return response()->download($path);
    }

    public function deleteBackup($filename)
    {
        $path = storage_path('backups/' . $filename);

        if (file_exists($path)) {
            unlink($path);
            return back()->with('success', 'Backup deleted successfully.');
        }

        return back()->with('error', 'Backup not found.');
    }
}
