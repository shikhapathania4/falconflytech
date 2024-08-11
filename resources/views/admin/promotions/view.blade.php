<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
 
<div class="main-content">
            <h2 class="mb-4">PromoCode List</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#promoCodeModal">
                Create Promo Code
            </button>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Discount</th>
                        <th>Valid Date</th>
                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($promotions as $promotion)
                        <tr>

                            <td>{{ $promotion->id }}</td>
                            <td>{{ $promotion->code }}</td>
                            <td>{{ $promotion->discount_percentage }}</td>
                            <td>{{ \Carbon\Carbon::parse($promotion->expiry_date)->format('Y-m-d') }}</td>
                            <td>
                                @if ($promotion->valid_until < now())
                                    <span class="text-danger">Expired</span>
                                @else
                                    <span class="text-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <form id="logout-form" action="{{ url('promotions/' . $promotion->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                </form>                            
                            </td>
                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Promo Code found.</td>
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