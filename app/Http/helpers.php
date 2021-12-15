<?php
function totalQty($id,$start,$end){
    $selectQuery = App\Stockin::where('product_id',$id)->sum('quantity');
    return $selectQuery;
}

function totalQtySold($id,$start,$end){
    $selectQuery = App\Order_Detail::where('product_id',$id)->sum('quantity');
    return $selectQuery;
}



