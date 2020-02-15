$(document).ready(function(){

    $('.filters').on("click", function(){
        getProducts();
    });

    $('.cena').on("blur", function(){
        getProducts();
    });

    $('.sortby').on("click", function(){
        let text = $(this).text();
        document.getElementsByClassName("sorting_text")[0].textContent = text;
        getProducts();
    });
});

function getProducts()
{
    let sort_by = document.getElementsByClassName("sorting_text")[0].textContent;
    //console.log(sort_by);

    var base_url = "http://localhost:8080/php2sajt1";
    const brands = document.getElementsByName("chb_brands");
        const categories = document.getElementsByName("chb_categories");
        let price_from = parseInt($("#p_from").val()); //500
        let price_to = parseInt($("#p_to").val()); //300

        if(!isNaN(price_from) && !isNaN(price_to)){
            if(price_from > price_to){
                const difference = price_from - price_to;
                price_from = price_to;
                price_to += difference;
            }
        }
        else{
            price_from = 0;
            price_to = 10000;
        }
        
        const arr_brands = [];
        for (const item of brands) {
            if(item.checked == true){
                arr_brands.push(item.value);
            }
        }

        const arr_categories = [];
        for (const item of categories) {
            if(item.checked == true){
                arr_categories.push(item.value);
            }
        }

        $.ajax({
            url: base_url+"/products",
            method: "post",
            data: {
                brand_ids: arr_brands,
                cat_ids: arr_categories,
                price_from: price_from,
                price_to: price_to,
                sort_by: sort_by
            },
            success: function(data, textStatus, jqXHR){
                //console.log(data);
                $('.shop_product_count').find('span').html(data.length);
                let ispis = `<div class="product_grid_border"></div>`;
                for (const item of data) {
                    ispis += `
                    <div class="product_item">
                        <div class="product_border"></div>
                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="${base_url}/app/assets/images/${item.path_small}" alt="${item.alt}"></div>
                        <div class="product_content">
                            <div class="product_price">$${item.price}</div>
                            <div class="product_name"><div><a href="${base_url}/product/${item.id}" tabindex="0">${item.brand_name+" "+item.name}</a></div></div>
                        </div>
                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                        <ul class="product_marks">
                            <li class="product_mark product_discount">-25%</li>
                            <li class="product_mark product_new">new</li>
                        </ul>
                    </div>`;
                }
                $('#products').html(ispis);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            }
        });
}