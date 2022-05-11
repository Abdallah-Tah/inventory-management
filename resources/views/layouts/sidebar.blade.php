<!-- siderbar -->
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Menu</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="list-group-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="list-group-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                <li class="list-group-item"><a href="{{ route('products.deleted') }}">Deleted Products</a></li>
                <li class="list-group-item"><a href="{{ route('categories.deleted') }}">Deleted Categories</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- end siderbar -->



