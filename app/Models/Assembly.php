<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    use HasFactory;
    protected $fillable = [

        'order_id',
        'user_id',
        'product_id',
        'admin_id',
        'assembly_package_id',
        'quantity',
        'status'
    ];



    public function orderAssemblyUser($user_id, $status = null)
    {
        $query = $this->where('user_id', $user_id);
        if (!is_null($status)) {
            $query = $query->where('status', $status);
        }
        return $query->orderBy('id', 'desc')->get();
    }

    public function orderAssemblyOrderUser($user_id)
    {
        $query = $this->where('user_id', $user_id);

        return $query->orderBy('id', 'desc')->get();
    }


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function administration()
    {
        return $this->belongsTo(Administration::class, 'admin_id');
    }

    public function assemblyPackage()
    {
        return $this->belongsTo(AssemblyPackages::class, 'assembly_package_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function assemblyAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function assemblyByAdmin($admin_id = null)
    {
        $query =  $this->orderBy('id', 'desc');
        if ($admin_id) {
            $query = $this->where('admin_id', $admin_id)->orderBy('id', 'desc');
        }
        return $query->paginate(8);
    }

    public function assmblyOrderId($order_id)
    {
        return $this->where('order_id', $order_id)->first();
    }

    public function statusAssembly()
    {
        return [
            1 => 'Đơn lắp mới',
            2 => 'Đang trong quá trình lắp ráp',
            3 => 'Hoàn thành lắp ráp',
            4 => 'Đang giao hàng',
            5 => 'Giao hàng thành công',
            6 => 'Hủy đơn lắp ráp',
        ];
    }

    public function countAssembly($employee_id)
    {
        return $this->where('employee_id', $employee_id)->count();
    }

    public function filterAssembly($status_id)
    {
        if ($status_id == 'all') {
            return $this->orderBy('id', 'desc')->paginate(8);
        }

        return $this->where('status', $status_id)->paginate(8);
    }

    public function countAssemblyPack($assembly_package_id)
    {
        return $this->where('assembly_package_id', $assembly_package_id)->count();
    }

    public function searchAssembly($filter_name, $filter_packages, $filter_status)
    {
        $query = $this->query();

        // Kiểm tra và áp dụng điều kiện lọc tên nhân viên
        if (!is_null($filter_name) && $filter_name !== '') {
            $query->where('admin_id', '=', (int)$filter_name);
        }

        // Kiểm tra và áp dụng điều kiện lọc gói lắp ráp
        if (!is_null($filter_packages) && $filter_packages !== '') {
            $query->where('assembly_package_id', '=', (int)$filter_packages);
        }

        // Kiểm tra và áp dụng điều kiện lọc trạng thái
        if (!is_null($filter_status) && $filter_status !== 'all') {
            $query->where('status', '=', (int)$filter_status);
        }

        // Trả về kết quả đã lọc
        return $query->paginate(10);
    }


    public function countAssemblyUser($user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    public function countAssemblyAdmin($admin_id)
    {
        return $this->where('admin_id', $admin_id)->count();
    }
}
