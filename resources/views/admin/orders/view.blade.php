<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
 
<div class="main-content">
            <h2 class="mb-4">Order List</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Services Name</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>    
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->service->name }}</td>
                            <td>
                                <span style="color: {{ $order->status == 'pending' ? 'orange' : ($order->status == 'processing' ? 'blue' : ($order->status == 'completed' ? 'green' : 'red')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>                
                            </td>           
                            <td>{{ $order->total_price }}</td>
                            <td>

                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()">
                                    @foreach (\App\Models\Order::STATUSES as $key => $label)
                                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                                                       
                            </td>
                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Order found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- resources/views/promo_code_modal.blade.php -->

<!-- Modal -->
<div class="modal fade" id="promoCodeModal" tabindex="-1" role="dialog" aria-labelledby="promoCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promoCodeModalLabel">Create Promo Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="promoCodeForm" method="POST" action="{{ url('promotions') }}">
                    @csrf
                    <div class="form-group">
                        <label for="code">Promo Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount Amount</label>
                        <input type="number" class="form-control" id="discount" name="discount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="expires_at">Expiry Date</label>
                        <input type="date" class="form-control" id="expires_at" name="expires_at" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Promo Code</button>
                </form>
            </div>
        </div>
    </div>
</div>


    
</x-app-layout>