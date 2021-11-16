<nav class="active" id="sidebar" >
    <ul class="list-unstyled lead">
        <li>
            <a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a>
        </li>

        <li>
            <a href="{{ route('products.index')}}"><i class="fa fa-box fa-lg"></i>Products</a>
        </li>

        <li>
            <a href="{{ route('transactions.index')}}"><i class="fa fa-money-bill fa-lg"></i>Transactions</a>
        </li>

        <li>
            <a href="{{ route('suppliers.index')}}"><i class="fa fa-truck fa-lg"></i>Suppliers</a>
        </li>

        <!-- <li>
            <a href="{{ route('sections.index')}}"><i class="fa fa-bars fa-lg"></i>Sections</a>
        </li> -->
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