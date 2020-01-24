// js in product management
$(document).ready(function() {
    $("#btn-public").on("click", function() {
        $("#product_status").val("1");
    });

    $(".add-product-detail").on("click", function() {
        var count = $(".count_product_detail").val();
        var newCount = parseInt(count) + 1;
        var html = `<div id = "` + newCount + `" class="row mt-2 d-flex justify-content-center">
        <input type="text" name="product_size_` + newCount + `" id="product_size_` + newCount + `" class="form-control col-5"
            id="exampleInputEmail1" placeholder="Size...">
        <div class="col-1"></div>
        <input type="number" name="product_quantity_` + newCount + `" id="product_quantity_` + newCount + `" class="form-control col-5"
            id="exampleInputEmail1" placeholder="Số lượng...">
        <div class="col-1 d-flex align-items-center"><i class="text-danger fas fa-minus-circle remove-product-detail"></i>
        </div>
    </div>`
        $(".append-product-detail").append(html);
        $(".count_product_detail").val(newCount);
    });

    $(".append-product-detail").on("click", ".remove-product-detail", function() {
        var count = $(".count_product_detail").val();
        var getCutId = $(this).parents()[1].id;
        var nextId = parseInt(getCutId) + 1;
        $(this).parents()[1].remove()
        for (var nextId; nextId <= count; nextId++) {
            $("#" + nextId).attr("id", (parseInt(nextId) - 1));
            var a = $("#product_quantity_" + nextId).attr({ id: "product_quantity_" + (parseInt(nextId) - 1), name: ("product_quantity_" + (parseInt(nextId) - 1)) });
            var a = $("#product_size_" + nextId).attr({ id: "product_size_" + (parseInt(nextId) - 1), name: ("product_size_" + (parseInt(nextId) - 1)) });
        }
        var newCount = parseInt(count) - 1;
        $(".count_product_detail").val(newCount);
    });
});