document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("shopify-product-search");
    const productType = document.getElementById("shopify-product-type");
    const productsGrid = document.getElementById("shopify-products-grid");

    if (!searchInput || !productType || !productsGrid) {
        return;
    }

    function filterProducts() {

        const formData = new FormData();

        formData.append(
            "action",
            "shopify_filter_products"
        );

        formData.append(
            "search",
            searchInput.value
        );

        formData.append(
            "product_type",
            productType.value
        );

        productsGrid.classList.add("loading");

        fetch(
            shopify_ajax.ajax_url,
            {
                method: "POST",
                body: formData
            }
        )
        .then(response => response.text())
        .then(data => {

            productsGrid.innerHTML = data;

            productsGrid.classList.remove("loading");
        })
        .catch(error => {

            console.error(
                "Product filter error:",
                error
            );

            productsGrid.classList.remove("loading");
        });
    }

    let searchTimer;

    searchInput.addEventListener(
        "input",
        function () {

            clearTimeout(searchTimer);

            searchTimer = setTimeout(
                filterProducts,
                300
            );
        }
    );

    productType.addEventListener(
        "change",
        filterProducts
    );
});