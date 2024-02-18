<?php

namespace App\Jobs;

use App\Events\PdfCreate;
use App\Models\Ban;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CreatePdfForUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::get();
        $products = Product::where('user_id', $this->user->id)->get();

        $quantityUsers = User::query()->where('role', 'user')->count();
        $quantityUsersInThisMonth = User::query()->where('role', 'user')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityAdmin = User::query()->where('role', 'admin')->count();
        $quantityAdminInThisMonth = User::query()->where('role', 'admin')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityModer = User::query()->where('role', 'moderator')->count();
        $quantityModerInThisMonth = User::query()->where('role', 'moderator')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityProduct = Product::query()->count();
        $quantityProductInThisMonth = Product::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityCategory = Category::query()->count();
        $quantityCategoryInThisMonth = Category::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityBan = Ban::query()->count();
        $quantityBanInThisMonth = Ban::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $quantityChat = Chat::query()->count();
        $quantityChatInThisMonth = Chat::query()->where('created_at', '>=', Carbon::now()->subMonth())->count();


        $data = [
            'title' => "думаешь",
            'date' => date('m/d/Y'),
            'users' => $users,
            'products' => $products,
            'user' => $this->user,
            'quantityUsers' => $quantityUsers,
            'quantityUsersInThisMonth' => $quantityUsersInThisMonth,
            'quantityAdmin' => $quantityAdmin,
            'quantityAdminInThisMonth' => $quantityAdminInThisMonth,
            'quantityModer' => $quantityModer,
            'quantityModerInThisMonth' => $quantityModerInThisMonth,
            'quantityProduct' => $quantityProduct,
            'quantityProductInThisMonth' => $quantityProductInThisMonth,
            'quantityCategory' => $quantityCategory,
            'quantityCategoryInThisMonth' => $quantityCategoryInThisMonth,
            'quantityBan' => $quantityBan,
            'quantityBanInThisMonth' => $quantityBanInThisMonth,
            'quantityChat' => $quantityChat,
            'quantityChatInThisMonth' => $quantityChatInThisMonth,
            // 'user' => $user,
        ];

        $pdf = FacadePdf::loadView('pdf.usersPdf', $data);
        $fileName = 'user-pdf.pdf';
        $filePath = 'public/pdfs/';
        $file = Storage::disk('local')->put($filePath . $fileName, $pdf->output());
        $fileUrl = Storage::path($filePath);
        chmod($fileUrl, 0777);
        $fileUrl = '/pdfs/' . $fileName;

        broadcast(new PdfCreate($this->user, $fileUrl));
    }
}
