<nav class="active" id="sidebar" >
<ul class="list-unstyled lead">

    @foreach ($products as $key => $product)
        @if ($product->quantity <= $product->alert_stock)
            <li>
                <p><i class="fa fa-exclamation" aria-hidden="true"></i>{{$product->product_name}} is low stock</p>
            </li>
        @endif
    @endforeach
        
        
    </ul>
</nav>

<style>
    #sidebar ul.lead {  
        border-bottom: 1px solid #47748b;
        width: fit-content;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
        width: 30vh;
        color: #437fc7;
    }



    #sidebar ul li a:hover {
        background: #c5c6c7;
        color: #edf6ff;
        text-decoration: none !important;
    }

    #sidebar ul li i, #sidebar ul li a {
        margin-right: 10px;
        color:  #1f2833;
    }

    #sidebar ul li.active>a,
    a[arria-expanded="true"] {
        color: #1f2833;
        background: #6daffe;
    }
</style>