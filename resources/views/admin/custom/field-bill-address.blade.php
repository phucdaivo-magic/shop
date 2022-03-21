@foreach ($item->billAddress as $billAddress)
<ul class="list-group" style="min-width: 400px">
    <li class="list-group-item ">
        <div class="bg-light rounded p-2">
            Tên: <strong>{{ $billAddress->name }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">Số DT: <strong>{{ $billAddress->phone }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">
            Email: <strong>{{ $billAddress->email }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">
            Tỉnh/TP: <strong>{{ $billAddress->city }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">
            Quận/Huyện: <strong>{{ $billAddress->district }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">
            Phường/Xã: <strong>{{ $billAddress->ward }}</strong>
        </div>
    </li>
    <li class="list-group-item">
        <div class="bg-light rounded p-2">
            Ghi chú: <strong>{{ $billAddress->note }}</strong>
        </div>
    </li>
</ul>
@endforeach